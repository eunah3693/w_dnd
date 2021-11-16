<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Banner;
use App\Models\Config;
use App\Models\Event;
use App\Models\EventJoin;
use App\Models\EventReview;
use App\Models\Order;
use App\Models\Treat;
use Illuminate\Support\Facades\Auth;

class Eventcontroller extends Controller
{
    public function getEventList()
    {
        $banner_top = Banner::where([
            ['page', '=' ,'shop'],
            ['position', '=' ,'top'],
            ['is_public', '=' ,'1'],
            ['startdate', '<', date('Y-m-d H:i:s')],
            ['enddate', '>', date('Y-m-d H:i:s')]
        ])
        ->orderBy('order', 'asc')
        ->get();

        $event = Event::where([
            ['category', '=' ,'교환소'],
            ['is_public', '=' ,'1'],
            ['startdate', '<', date('Y-m-d H:i:s')],
            ['enddate', '>', date('Y-m-d H:i:s')]
        ])
        ->orderByRaw('ISNULL(`order`) ASC')
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc')
        ->with('file')
        ->with('eventJoinCount')
        ->get();

        return view('main.shop.shop_lists', ['data' => $event, 'banner' => $banner_top ]);
    }

    public function getEventDetail(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $user_treat = Treat::where('user_idx',$user_idx)->sum('treat');
        $event = Event::where('idx', $request->idx)
        ->with('file')
        ->with('eventJoinCount')
        ->first();

        $event_review = EventReview::where('event_idx', $request->idx)->with('user')->get();
       // dd($event );
        return view('main.shop.shop_detail', ['data' => $event, 'user_treat' => $user_treat, 'event_review'=>$event_review ]);
    }

    /**
     * 응모 요청
     * @param event_idx
     */
    public function joinEvent(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $default_event_perc = Config::where('key', 'default_event_perc')->value('value');   // 기본 이벤트 당첨 비율 1
        $event = Event::find($request->event_idx);
        $perc = $event->perc * $default_event_perc;                                         // $event->perc 백분율 * 기본비율 = 총 당첨확률
        // 참여 가능 횟수가 있을 경우
        if($event->participation_count)
        {
            $count = EventJoin::where([['event_idx',$event->idx],['user_idx',$user_idx]])->count();
            if($event->participation_count <= $count){
                return response()->json([ 'msg' => '참여가능 횟수를 초과했습니다.', 'status' => 202 ] , 200);
            }
        }
        // 트릿이 유효한지 확인한다,
        $user_treat = Treat::where('user_idx',$user_idx)->sum('treat');
        if($user_treat < $event->participation_point)
        {
            return response()->json([ 'msg' => '트릿이 부족합니다.', 'status' => 202 ] , 200);
        }
        // 현재까지의 당첨자를 확인한다
        $count = EventJoin::where([['event_idx',$event->idx],['status',1]])->count();
        if($count >= $event->stock)
        {
            return response()->json([ 'msg' => '재고가 부족합니다.', 'status' => 202 ] , 200);
        }

        // 트릿 사용
        $treat = new Treat;
        $treat->user_idx = $user_idx;
        $treat->treat = '-'.$event->participation_point;
        $treat->memo = '['.$event->title.'] 교환소 사용';
        $treat->save();

        // 당첨여부 확인
        $status = $this->probability($perc);
        // 참여 내역에 추가
        $event_join = new EventJoin;
        $event_join->user_idx = $user_idx;
        $event_join->event_idx = $event->idx;
        $event_join->status = $status;
        $event_join->save();

        // 당첨되었을때 알람 및 오더데이터 생성
        if($status)
        {
            // 오더테이블에 회원 배송정보 받을 데이터 생성
            $order = new Order;
            $order->user_idx = $user_idx;
            $order->event_idx = $event->idx;
            $order->status = '배송지미입력';
            $order->total_amount = $event->participation_point;
            $order->save();

            // 당첨 알림
            $alarm = collect();
            $alarm->user_idx = $user_idx;
            $alarm->sender_idx = 0;
            $alarm->text = '';
            $alarm->url = '/adress?idx='.$order->idx;
            $appPushControllers = new AppPushControllers;
            $appPushControllers->sendSingleAppPush($alarm, 'event');
            return response()->json([ 'msg' => '당첨되었습니다.', 'url' => '/adress?idx='.$order->idx, 'status' => 200 ] , 200);
        }else{
            return response()->json([ 'msg' => '탈락입니다.', 'status' => 202 ] , 200);
        }

    }

    function getOrderWithEvent(Request $request)
    {
        $user_idx = Auth::id();
        $order = Order::where('idx',$request->idx)->with('event')->first();
        // 주소 정보
        $addr = Address::where('user_idx', $user_idx)->get();
        // 메인 주소 정보
        $main_addr = Address::where('user_idx', $user_idx)->orderBy('updated_at','desc')->first();
        if($order)
        {
            // 기본배송지가 있고 , 배송지 정보가 입력되어있지 않을때 기본배송지를 적어준다
            if($main_addr && $order->addr1 == '')
            {
                $order->name = $main_addr->name;
                $order->tel = $main_addr->tel;
                $order->zip = $main_addr->zip;
                $order->addr1 = $main_addr->addr1;
                $order->addr2 = $main_addr->addr2;
                $order->msg = $main_addr->msg;
            }
            return view('main.shop.adress', ['data' => $order, 'addr' => $addr ]);
        }else{
            return redirect('/myhistory')->with('alert','없는 정보입니다.');
        }
    }
    function getAddress(Request $request)
    {
        if($request->idx)
        {
            return response()->json([
                'status' => '200',
                'data' => Address::find($request->idx),
                'msg' => ''
            ]);
        }
        return response()->json([
            'status' => '500',
            'msg' => '에러입니다.'
        ]);
    }
    function setOrderWithEvent(Request $request)
    {
        $user_idx = Auth::id();
        if($request->addr_save == 'Y')
        {
            $addr = new Address;
            $addr->user_idx = $user_idx;
            $addr->name = $request->name;
            $addr->tel = $request->tel;
            $addr->zip = $request->zip;
            $addr->addr1 = $request->addr1;
            $addr->addr2 = $request->addr2;
            $addr->msg = $request->msg;
            $addr->save();
        }
        $order = Order::find($request->idx);
        $order->name = $request->name;
        $order->status = '상품준비중';
        $order->tel = $request->tel;
        $order->zip = $request->zip;
        $order->addr1 = $request->addr1;
        $order->addr2 = $request->addr2;
        $order->msg = $request->msg;
        $order->save();

        return redirect('/myshipping?idx='.$order->idx)->with('alert','배송지 주소가 저장되었습니다.');
    }
    /**
     * 확률 구하는 함수
     * @param 퍼센트
     */
    function probability($perc) {
        $n = 0;
        $t = 0;
        $c = 0;
        $n = $perc * 10000;
        if ($n > 1000000) $n = 1000000;
        if ($n < 1) $n = 0;
        $t = mt_rand(0, 1000000);
        if ($t <= $n) $c = 1;
        return $c;

    }
}
