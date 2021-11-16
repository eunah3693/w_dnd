<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    function getPost(Request $request)
    {
        $post_count = Post::where('status','2')->count();
        $today_mission_count = Post::where('status','2')->whereNull('parent_idx')->whereNotNull('mission_idx')->whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();
        $today_life_count = Post::where('status','2')->whereNull('parent_idx')->whereNull('mission_idx')->whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();
        $post = Post::
                select('post_tbl.*')
                ->addSelect(DB::raw('group_concat(tag) as tag'))
                ->addSelect(DB::raw('(SELECT COUNT(idx) FROM like_tbl WHERE post_idx = post_tbl.idx AND deleted_at IS NULL) as like_count'))
                ->whereNull('parent_idx')
                ->where('status','2')
                ->leftJoin('tag_tbl', 'post_tbl.idx', '=', 'tag_tbl.post_idx')
                ->groupBy('post_tbl.idx')
                ->with('like:idx,user_idx')
                ->with('files')
                ->with('mission')
                ->with('user:idx,nickname,file_idx,id')
                ->with('reply')
                ->orderBy('created_at', 'desc');
        // 검색
        $user_idx = '';
        $tag = '';
        $text = $request->post_idx ? $request->post_idx:'';

        if($request->category){
            $tag = $request->category;
        }

        if($request->search == 'user_id')
        {
            $user_idx = User::where('id',$request->text)->value('idx');
        }else if($request->text){
            $tag = $request->text;
        }

        //포스트 인덱스
        if($request->post_idx)
        {
            $post->where('post_tbl.idx', $request->post_idx);
        }

        // 태그 검색 배열
        if($tag){
            $post->where('tag_tbl.tag', $tag);
        }


        // 유저 인덱스 검색
        if($user_idx){
            $post->where('post_tbl.user_idx', $user_idx);
        }

        // 페이징 10개씩
        $post =  $post->paginate(10);
        $post->setPath('');
        // 페이지 링크에 현재 쿼리 스트링 추가
        $post->withQueryString()->links();

        return view('admin.mission_manage.member_mission_list', ['post' => $post, 'post_count' => $post_count,'today_mission_count' => $today_mission_count,'today_life_count' => $today_life_count,]);
    }


    function getPostDetail(Request $request)
    {
        //포스트 인덱스
        if($request->post_idx)
        {
            $post = Post::find($request->post_idx);

            $post = Post::
                select('post_tbl.*')
                ->addSelect(DB::raw('group_concat(tag) as tag'))
                ->addSelect(DB::raw('(SELECT COUNT(idx) FROM like_tbl WHERE post_idx = post_tbl.idx AND deleted_at IS NULL) as like_count'))
                ->where('status','2')
                ->leftJoin('tag_tbl', 'post_tbl.idx', '=', 'tag_tbl.post_idx')
                ->groupBy('post_tbl.idx')
                ->with('like:idx,user_idx')
                ->with('files')
                ->with('mission')
                ->with('user:idx,nickname,file_idx,id')
                ->where('post_tbl.idx', $request->post_idx)
                ->with('reply')->first();

            $report = Report::where('post_idx', $request->post_idx)->get();

                return view('admin.mission_manage.member_mission_detail', ['post' => $post, 'report'=>$report  ]);
        }


        return redirect('/admin/mission_manage/member_mission_list');


    }
}
