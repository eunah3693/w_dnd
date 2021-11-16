<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;

class UserOrderController extends Controller
{
    private $ORDER_STATUS;

    function __construct()
    {
        $this->ORDER_STATUS = collect([
            ['배송지미입력'],
            ['상품준비중'],
            ['배송준비중'],
            ['배송진행중'],
            ['배송완료'],
            ['교환신청'],
            ['반품신청'],
            ['교환완료'],
            ['반품완료'],
            ['취소신청'],
            ['취소신청완료']
        ]);
    }
    // 오더 리스트
    public function getOrder(Request $request)
    {
        $order = Order::with('event')->with('user')->orderBy('created_at', 'desc')->paginate(20);
        $total_order = Order::count();
        $today_order = Order::whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();// 금일 팻 등록수
        $addr = Order::where('status','배송지미입력')->count();
        //dd(DB::getQueryLog());
        if($request->input())
        {
            $query = Order::select('*')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $order = $query->paginate(20);
        }
        return view('admin.member.delivery', ['order' => $order, 'total_order' => $total_order, 'today_order' => $today_order, 'status' =>$this->ORDER_STATUS,'addr'=>$addr ]);
    }

    // 상세
    public function getOrderDetail(Request $request)
    {
        if($request->order_idx)
        {
            $order = Order::with('event')->with('user')->where('idx',$request->order_idx)->first();

            return view('admin.member.delivery_detail', ['order' => $order]);
        }
        return redirect('admin.member.delivery');
    }

    // 수정
    public function getOrderModify(Request $request)
    {
        if($request->order_idx)
        {
            $order = Order::with('event')->with('user')->where('idx',$request->order_idx)->first();

            return view('admin.member.delivery_modify', ['order' => $order, 'type' => '수정', 'url'=>'/api/admin/order/update','status' =>$this->ORDER_STATUS]);
        }else{
            $order = new Order;
            return view('admin.member.delivery_modify', ['order' => $order, 'type' => '추가', 'url'=>'/api/admin/order/insert','status' =>$this->ORDER_STATUS]);
        }
    }

    // 생성 및 수정
    public function setOrderInsert(Request $request){
        if($request->order_idx)
        {
            $order = Order::find($request->order_idx);
        }else{
            $order = new Order;
        }
        $order->delivery_num = $request->delivery_num;
        $order->status = $request->status;
        $order->name = $request->name;
        $order->tel = $request->tel;
        $order->email = $request->email;
        $order->msg = $request->msg;
        $order->zip = $request->zip;
        $order->addr1 = $request->addr1;
        $order->addr2 = $request->addr2;
        $order->save();
        return redirect('/admin/member/delivery_detail?order_idx='.$order->idx)->with('alert','변경/추가되었습니다.');
    }
    // 삭제
    public function setOrderDelete(Request $request)
    {
        $order = Order::find($request->order_idx);
        $order->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }
    public function getDynamicQuery($query, $request)
    {
        foreach($request as $key => $value)
        {
            if($value)
            {
                switch ( $key )
                {
                    case 'page' :
                        break;
                    case 'date' :
                        if( $request['startdate'] || $request['enddate'])
                        {
                            $query->whereBetween($value, [$request['startdate'], $request['enddate']]);
                        }
                        break;
                    case 'search':
                        $text = '%'.$request['text'].'%';
                        if( $request['text'] )
                        {
                            $query->where($value, 'like' , $text);
                        }
                        break;
                    case 'startdate':
                    case 'enddate':
                    case 'text':
                        break;
                    default :
                        $query->where($key, '=', $value);
                }

            }
        }
        return $query;
    }

    public function getAddress(Request $request)
    {
        $data = Address::orderBy('idx', 'desc')->paginate(20);
        return view('admin.member.address', ['data'=> $data]);
    }

    public function getAddressModify(Request $request,$idx)
    {
        if($idx)
        {
            $data = Address::find($idx);
            return view('admin.member.address_modify',  ['data'=> $data]);
        }
    }

    public function getAddressDetail(Request $request,$idx)
    {
        if($idx)
        {
            $data = Address::find($idx);
            return view('admin.member.address_detail',  ['data'=> $data]);
        }
    }

    public function updateAddress(Request $request, $idx)
    {
        if($idx)
        {
            $data = Address::find($idx);
            $data->name = $request->name;
            $data->tel = $request->tel;
            $data->zip = $request->zip;
            $data->addr1 = $request->addr1;
            $data->addr2 = $request->addr2;
            $data->msg = $request->msg;
            $data->save();
            return redirect('/admin/member/address')->with('alert','변경 되었습니다');
        }
    }

    public function deleteAddress(Request $request, $idx)
    {
        if($idx)
        {
            $data = Address::find($idx);
            $data->delete();
            return response()->json([
                'msg' => '삭제되었습니다.',
                'status' => 200,
            ], 200);
        }
    }
}
