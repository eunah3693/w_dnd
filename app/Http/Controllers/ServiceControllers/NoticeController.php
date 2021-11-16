<?php

namespace App\Http\Controllers\ServiceControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;

class NoticeController extends Controller
{
    function getTermList()
    {
        $board = Board::where('category','이용약관')->orderBy('idx','desc')->get();
        return view('main.mypage.terms_of_service', ['data'=>$board]);
    }

    function getPolicyList()
    {
        $board = Board::where('category','개인정보처리방침')->orderBy('idx','desc')->get();
        return view('main.mypage.policy', ['data'=>$board]);
    }

    function getTerm(Request $request)
    {
        if($request->type)
        {
            $data = Board::where('category',$request->type)->orderBy('created_at','desc')->first();
            return response()->json([
                'data' =>$data,
                'status' => 200,
            ], 200);
        }
    }

    function getNoticeList()
    {
        $board = Board::where('category','공지사항')->where('hidden','N')->orderBy('top_fixed', 'desc')->latest()->paginate(10);
        $board->setPath('');
        return view('main.notice.notice', ['data'=>$board]);
    }
    function getNoticeDetail(Request $request)
    {
        if($request->idx)
        {
            $board = Board::find($request->idx);
            return view('main.notice.notice_detail', ['data'=>$board]);
        }
    }
    function getGuideList()
    {
        $board = Board::where('category','이용안내')->where('hidden','N')->orderBy('top_fixed', 'desc')->latest()->paginate(10);
        $board->setPath('');
        return view('main.guide.guide', ['data'=>$board]);
    }
    function getGuideDetail(Request $request)
    {
        if($request->idx)
        {
            $board = Board::find($request->idx);
            return view('main.guide.guide_detail', ['data'=>$board]);
        }
    }
    function getEventList(Request $request){
        $status = $request->type;
        if($status == 1)
        {
            //종료된이벤트
            $board = Board::where([
                ['category', '=' ,'이벤트'],
                ['enddate', '<', date('Y-m-d H:i:s')]
            ])
            ->where('hidden','N')
            ->orderBy('enddate', 'asc')
            ->get();

        }else{
            // 진행중, 예정인 이벤트
            $board = Board::where([
                ['category', '=' ,'이벤트'],
                ['enddate', '>', date('Y-m-d H:i:s')]
            ])
            ->where('hidden','N')
            ->orderBy('startdate', 'asc')
            ->orderBy('idx', 'desc')
            ->get();
        }
        return view('main.event.event_lists', ['data'=>$board]);
    }

    function getEventDetail(Request $request){
        $board = Board::find($request->idx);
        return view('main.event.event_detail', ['data'=>$board]);
    }

    function getFaqList(){
        $board = Board::where('category','자주하는질문')->where('hidden','N')->latest()->get();
        return view('main.mypage.faq', ['data'=>$board]);
    }

    function getFaqDetail(Request $request){
        if($request->idx){
            $board = Board::find($request->idx);
            return view('main.mypage.faq_answer', ['data'=>$board]);
        }
    }
}
