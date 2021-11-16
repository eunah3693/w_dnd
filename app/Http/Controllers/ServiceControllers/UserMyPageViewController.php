<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Order;
use App\Models\Pets;
use App\Models\Post;
use App\Models\Treat;
use App\Models\User;
use App\Models\Breed;
use App\Models\Config;
use App\Models\EventReview;
use Illuminate\Support\Facades\Auth;

class UserMyPageViewController extends Controller
{
    /**
     * 유저 정보, 펫정보 요청
     */
    function getUser(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $user = User::where('idx', $user_idx)->with('pets')->first();

        // 경험치 퍼센트
        $start_exp = Config::where('key','default_start_exp')->value('value');  // 최초 시작 경험치
        $level_exp_prop = Config::where('key','level_exp_proportion')->value('value'); // 경험치 증가비율
        $level_total_exp = floor($start_exp * pow($level_exp_prop , $user->level - 1));   // 해당레벨의 총경험치
        $user_exp = $user->exp / $level_total_exp * 100;
        $user_treat = Treat::where('user_idx',$user_idx)->sum('treat');
        return view('main.mypage.mypage', ['data' => $user, 'treat' => $user_treat, 'exp' => $user_exp ]);
    }

    function updateMyPageUserView(Request $request){
        $user_idx = $request->session()->get('idx');
        $user = User::where('idx', $user_idx)->with('pets')->first();
        return view('main.mypage.user_account.setting_account', ['data' => $user]);
    }

    function updateMyPagePWView(){

    }

    function getUserEventList(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $order = Order::where('user_idx', $user_idx)->with('event')->latest()->get();
        return view('main.mypage.myevent', ['data' => $order]);
    }

    function getUserEvent(Request $request)
    {
        $order_idx = $request->order_idx;
        $user_idx = $request->session()->get('idx');
        $order = Order::where('idx', $order_idx)->with('event')->first();
        return view('main.mypage.myorder', ['data' => $order]);
    }

    function getUserQnaList(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $qna = Board::where('user_idx',$user_idx)->where('category','이용문의')->latest()->get();
        return view('main.mypage.qna', ['data' => $qna]);
    }

    function getUserQna(Request $request)
    {
        $order_idx = $request->order_idx;
        $qna = Board::where('idx',$order_idx)->where('category','이용문의')->first();
        return view('main.mypage.qna', ['data' => $qna]);
    }

    function getMyBookMarkPost(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $post = Post::
                whereNull('parent_idx')
                ->where('is_public','1')
                ->with(['bookMark' => function ($query) use($user_idx){
                    $query->where('user_idx' ,$user_idx);
                }])
                ->with('files')->get();
        return view('main.mypage.bookmart', ['data' => $post]);
    }

    function getMyPet(Request $request)
    {
        $data = new Pets;
        $breeds = Breed::where('visible', 'Y')->orderBy('breed', 'asc')->get();
        if($request->idx)
        {
            $data = Pets::find($request->idx);
            return view('main.mypage.pet_account.my_pet', ['data' => $data,'breeds' => $breeds, 'action' => '/api/my/pet/update']);
        } else {
            return view('main.mypage.pet_account.my_pet', ['data' => $data, 'breeds' => $breeds, 'action' => '/api/my/pet/insert']);
        }

    }

    function getMytreatList(Request $request){
        $user_idx = $request->session()->get('idx');
        $data = Treat::where('user_idx',$user_idx )->latest()->get();
        $user_treat = Treat::where('user_idx',$user_idx)->sum('treat');
        return view('main.mypage.my_treat.my_treat_lists', ['data' => $data, 'total_treat' => $user_treat]);
    }

    function getMyQna(Request $request){
        $user_idx = $request->session()->get('idx');
        $data = Board::where([
            ['category','이용문의'],
            ['user_idx', $user_idx]
        ])->whereNull('parent_idx')->with('reply')->latest()->get();
        return view('main.mypage.my_qna.my_qna', ['data' => $data]);
    }

    function getMyQnaDetail(Request $request){
        $user_idx = $request->session()->get('idx');
        if($request->idx)
        {
            $data = Board::where('idx',$request->idx)->where('user_idx',$user_idx)->first();
            return view('main.mypage.my_qna.my_qna_answer', ['data' => $data]);
        }
        return redirect('/');
    }

    function setMyQna(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $board = new Board;
        $board->category = '이용문의';
        $board->user_idx = $user_idx;
        $board->title = $request->title;
        $board->content = $request->content;
        $board->save();
        return redirect('/myqna')->with('alert','문의를 남겼습니다.');
    }

    function getMyConfig(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $data = User::find($user_idx);
        return view('main.mypage.setting_notification', ['data' => $data]);
    }

    function setMyConfig(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $request->key;
        $request->val;
        $type_str = $request->val == 'Y' ? ' 수신동의':' 수신거부';
        $msg = ' 변경되었습니다.';
        switch ($request->key) {
            case 'push_like':
            case 'push_reply':
            case 'push_event':
                User::where('idx',$user_idx)->update([$request->key => $request->val]);
                break;
            case 'push_agree':
                User::where('idx',$user_idx)->update(
                    [$request->key => $request->val, $request->key.'_date' => date('Y-m-d H:i:s'), 'push_like' => $request->val, 'push_reply' => $request->val, 'push_event' => $request->val],
                );
                $msg = $type_str.' 하였습니다.  \n변경일시 : '.date('Y-m-d H:i:s').'\n제공자: 지유월드와이드';
                break;
            default:
                User::where('idx',$user_idx)->update(
                    [$request->key => $request->val, $request->key.'_date' => date('Y-m-d H:i:s')],
                );
                $msg = $type_str.'하였습니다. \n변경일시 : '.date('Y-m-d H:i:s').'\n제공자: 지유월드와이드';
                break;
        }
        return response()->json([
            'msg' => $msg,
            'status' => 200,
        ], 200);
    }

    function getMyHistory(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $order = Order::selectRaw('*, (SELECT COUNT(idx) FROM event_review_tbl WHERE order_idx = order_tbl.idx AND user_idx = order_tbl.user_idx) as count')->where('user_idx', $user_idx)->latest()->with('event')->get();

        return view('main.mypage.my_history.my_history_lists', ['data'=>$order]);
    }

    function getMyReview(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $order = Order::find($request->order_idx);


        $review = EventReview::where('order_idx', $order->idx)->where('user_idx', $user_idx)->first();

        return view('main.mypage.my_history.my_history_review', ['data'=>$order, 'review'=>$review]);
    }

    function getMyShipping(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        if(!$request->idx){
            return redirect('/myhistory')->with('alert','당첨내역이 없습니다.');
        }
        $order = Order::where('idx',$request->idx)->with('event')->first();
        return view('main.mypage.my_history.my_history_shipping', ['data'=>$order]);
    }

    //회원 탈퇴페이지
    function deleteUser(Request $request)
    {
        $user_idx = Auth::id();
        $user = User::find($user_idx);
        return view('main.mypage.secession', ['user' => $user]);
    }
}
