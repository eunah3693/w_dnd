<?php

namespace App\Http\Controllers\CommonControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alarm;
use App\Models\Config;
use App\Models\Like;
use App\Models\Post;
use App\Models\Treat;
use Illuminate\Support\Facades\DB;

class UserTreatController extends Controller
{
    /**
     * 좋아요 눌렀을때 트릿 업데이트
     * @param request->post_idx
     */
    public function updateUserTreatOfLike($user_idx, $post_idx)
    {
        $config_post_like_treat = Config::where('key','post_like_treat')->value('value');   // 좋아요를 눌렀을때 주는 트릿 수
        $config_post_like_limit = Config::where('key','post_like_limit')->value('value');   // 하루에 좋아요를 눌러 트릿을 받을수 있는 횟수
        //print_r($config_post_like_treat);die();
        // 오늘 포스트에 좋아요 누른 횟수 (그 날 좋아요 누른 갯수 좋아요 취소도 포함) 댓글좋아요 포함 X
        $like = Like::where('user_idx', $user_idx)
                    ->where('created_at', 'like', date('Y-m-d').'%')
                    ->whereExists(function ($query) use ($user_idx){
                        $query->select(DB::raw(1))
                            ->from('post_tbl')
                            ->whereRaw('like_tbl.post_idx = post_tbl.idx')->whereNull('post_tbl.parent_idx');
                    })
                    ->withTrashed()
                    ->count();
        $post = Post::find($post_idx);
        if($config_post_like_limit >= $like && $post->user_idx != $user_idx)
        {
            $this->insertUserTreat($user_idx, $config_post_like_treat, '피드 좋아요 적립');
        }
    }

    /**
     * 미션 완료 했을때 트릿 업데이트
     */
    public function updateUserTreatOfMission()
    {

    }

    /**
     * 트릿 업데이트
     * @param user_idx
     * @param treat
     * @param memo
     */
    public function insertUserTreat($user_idx, $point, $memo)
    {
        $treat = new Treat;
        $treat->user_idx = $user_idx;
        $treat->treat = $point;
        $treat->memo = $memo;
        $treat->save();

        $alarm = new Alarm;
        $alarm->user_idx = $user_idx;
        $alarm->sender_idx = 0;
        $alarm->title = '트릿';
        $alarm->content = $memo;
        $alarm->related_url = '/mytreat';
        $alarm->type = 'treat';
        $alarm->save();
    }

}
