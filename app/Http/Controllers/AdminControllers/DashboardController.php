<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\EventJoin;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function getTodayJoinCount()
    {
        $total_users = User::where('is_admin', 0)->orderBy('created_at', 'desc')->count();// 총회원수
        $today_join = User::where('is_admin', 0)->whereDate('created_at','>=', date('Y-m-d').' 00:00:00' )->orderBy('created_at', 'desc')->count();// 금일 가입수
        $today_login = User::where('is_admin', 0)->where('last_login_date','>=', date('Y-m-d').' 00:00:00' )->orderBy('created_at', 'desc')->count();/// 금일 접속자수
        $total_deactivate = User::where('is_admin', 0)->where('status','D')->orderBy('created_at', 'desc')->count();/// 탈퇴자수
        $post = Post::where('status', 2)->whereNull('parent_idx')->whereDate('created_at','>=', date('Y-m-d').' 00:00:00' )->count();

        $total_post = Post::where('status', 2)->whereNull('parent_idx')->count();
        $post_list = DB::select("SELECT count(*) as count, date_format(created_at, '%m-%d') as date FROM dndlifecare.post_tbl where status = 2 and parent_idx is null and deleted_at is null group by date_format(created_at, '%Y-%m-%d') order by date asc");
        $join_list = DB::select("SELECT count(*) as count, date_format(created_at, '%m-%d') as date FROM dndlifecare.user_tbl where is_admin = 0 and deleted_at is null group by date_format(created_at, '%Y-%m-%d') order by date asc");

        return view('admin.index', [
            'total_users' => $total_users ,
            'today_join' => $today_join,
            'today_login' => $today_login,
            'post' => $post,
            'post_list' => $post_list,
            'join_list' => $join_list,
            'total_post' => $total_post
            ]);
    }

    function getAdminAlarm(Request $request)
    {
        $date = date('Y-m-d', strtotime('-1 day'));
        $data = array();
        $data['post'] = Post::where('status', 2)->whereNull('parent_idx')->whereDate('created_at','>=', date('Y-m-d').' 00:00:00' )->count(); // 금일포스트수
        $data['reply'] = Post::where('status', 2)->whereNotNull('parent_idx')->whereDate('created_at','>=', date('Y-m-d').' 00:00:00' )->count(); // 금일 댓글수
        $data['report'] = Report::whereDate('created_at','>=', $date.' 00:00:00' )->count(); // 어제 ~ 오늘 피드 신고수
        $data['event'] = EventJoin::where('status', 1)->whereDate('created_at','>=', $date.' 00:00:00' )->count(); // 어제 ~ 오늘 당첨자
        $data['board'] = Board::where('category', '이용문의')->whereNull('answered_at')->count(); // 1:1문의 미답변 갯
//dd($data);
        return response()->json([
            'data' =>  $data,
            'msg' => '',
            'status' => 200,
        ], 200);
    }

}
