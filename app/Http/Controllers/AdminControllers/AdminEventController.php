<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\CommonControllers\ImageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Event;
use App\Models\EventJoin;
use App\Models\EventReview;

class AdminEventController extends Controller
{
    function getExchangeShopList(Request $request)
    {
        $total = Event::count(); // 총 상품수
        $today_event = Event::where('created_at','>=', date('Y-m-d').' 00:00:00' )->count();/// 오늘 등록된 상품 수
        $today_join_event = EventJoin::where('created_at','>=', date('Y-m-d').' 00:00:00' )->count();/// 오늘 응모 횟수
        $today_join_event2 = EventJoin::where('status', 1)->where('created_at','>=', date('Y-m-d').' 00:00:00' )->count();// 오늘 당첨된사람
        $event = Event::with('eventJoinCount')->orderBy('created_at', 'desc')->paginate(20);
        $default_event_perc =  Config::where('key', 'default_event_perc')->first(); //기본 이백트 당첨 확률 (비율)
        if($request->input())
        {
            $query = Event::orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $event = $query->paginate(20);
        }
        return view('admin.board.exchange', ['data' => $event, 'total' => $total, 'today_event' => $today_event, 'today_join_event' => $today_join_event, 'today_join_event2' => $today_join_event2, 'default_event_perc' => $default_event_perc ]);
    }

    function getExchangeShopDetail(Request $request)
    {
        if($request->idx)
        {
            $event = Event::where('idx',$request->idx)->with('eventReview')->with('eventJoin')->first();
            $event_join = EventJoin::where('event_idx', $request->idx)->with('user')->orderBy('created_at', 'desc')->paginate(15,['*'],'j_page');
            $event_review = EventReview::where('event_idx', $request->idx)->with('user')->orderBy('created_at', 'desc')->paginate(15,['*'],'r_page');
           // dd($event_review);
            return view('admin.board.exchange_detail', ['data' => $event, 'event_join'=>$event_join, 'event_review'=>$event_review,]);
        }
        return redirect('/admin/board_event/exchange');
    }

    function getExchangeShopModify(Request $request)
    {
        if($request->idx)
        {
            $event = Event::where('idx',$request->idx)->with('eventReview')->with('eventJoin')->first();
            return view('admin.board.exchange_modify', ['data' => $event, 'type' => '수정', 'url'=>'/api/admin/exchange/update']);
        }else{
            $event = new Event;
            return view('admin.board.exchange_modify', ['data' => $event, 'type' => '추가', 'url'=>'/api/admin/exchange/insert']);
        }
    }

    // 생성
    public function setExchangeShopInsert(Request $request){

        $user_idx = $request->session()->get('idx');
        $event = new Event;

        $event->user_idx = $user_idx;
        $event->category = '교환소';
        $event->title = $request->title;
        $event->preview = $request->preview;
        $event->content = $request->content;
        $event->is_public = $request->is_public;
        $event->startdate = $request->startdate;
        $event->order = $request->order;
        $event->enddate = $request->enddate;
        $event->participation_count = $request->participation_count;
        $event->participation_point = $request->participation_point;
        $event->perc = $request->perc;
        $event->stock = $request->stock;
        $event->save();

        // 파일 업로드
        $imageController = new ImageController;
        $thum_file_idx = $imageController->insertImageWithTable($request->file('thum_file'), $user_idx, 'event_tbl', $event->idx);
        $main_file_idx = $imageController->insertImageWithTable($request->file('main_file'), $user_idx, 'event_tbl', $event->idx);

        $event->thum_file_idx = $thum_file_idx;
        $event->main_file_idx = $main_file_idx;

        $event->save();

        return redirect('/admin/board_event/exchange_detail?idx='.$event->idx)->with('alert','추가되었습니다.');
    }
    public function setExchangeShopUpdate(Request $request){

        $user_idx = $request->session()->get('idx');
        $event = Event::find($request->idx);

        $event->user_idx = $user_idx;
        $event->category = '교환소';
        $event->title = $request->title;
        $event->preview = $request->preview;
        $event->content = $request->content;
        $event->is_public = $request->is_public;
        $event->order = $request->order;
        $event->startdate = $request->startdate;
        $event->enddate = $request->enddate;
        $event->participation_count = $request->participation_count;
        $event->participation_point = $request->participation_point;
        $event->perc = $request->perc;
        $event->stock = $request->stock;
        $event->save();

        // 파일 업로드
        $imageController = new ImageController;
        if($request->file('thum_file'))
        {
            $thum_file_idx = $imageController->updateImageWithTable($request->file('thum_file'), $user_idx, 'event_tbl', $event->idx, $event->thum_file_idx);
            $event->thum_file_idx  = $thum_file_idx;
        }
        if($request->file('main_file'))
        {
            $main_file_idx = $imageController->updateImageWithTable($request->file('main_file'), $user_idx, 'event_tbl', $event->idx, $event->main_file_idx);
            $event->main_file_idx  = $main_file_idx;
        }

        $event->save();

        return redirect('/admin/board_event/exchange_detail?idx='.$event->idx)->with('alert','변경되었습니다.');
    }
    // 삭제
    public function setExchangeShopDelete(Request $request)
    {
        $event = Event::find($request->idx);
        $event->delete();
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
                        if( $value == 'count'){
                            $query->selectRaw(' count(post_idx) as count ')->groupBy('post_idx')->having('count', '=', $request['text']);
                        }else if($value == 'event_title'){
                            $events = Event::selectRaw(' group_concat(idx) as idxs')->where('title', 'like', '%'.$request['text'].'%')->first();
                            $query->whereIn('idx' , explode(',',$events->idxs));
                        }else{
                            $text = '%'.$request['text'].'%';
                            if( $request['text'] )
                            {
                                $query->where($value, 'like' , $text);
                            }
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


    // 리뷰 삭제
    function deleteReivew(Request $request)
    {
        $review = EventReview::find($request->idx);
        $review->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }

    // 리뷰 업데이트
    function updateReivew(Request $request, $id)
    {
        $review = EventReview::find($request->idx);
        $review->$id = $request->$id;
        $review->save();
        return response()->json([
            'msg' => '수정되었습니다.',
            'status' => 200,
        ], 200);
    }

    public function getReviewList(Request $request)
    {
        $review = EventReview::with('event')->with('user')->orderBy('created_at','desc')->paginate(20);
        $total = EventReview::count();
        $today = EventReview::count();
        if($request->input())
        {
            $query = EventReview::orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $review = $query->paginate(20);
        }
        return view('admin.board.review', ['data' => $review, 'total'=>$total, 'today'=>$today]);
    }

}
