<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use App\Http\Controllers\CommonControllers\UserLevelController;
use App\Http\Controllers\CommonControllers\UserTreatController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Files;
use App\Models\Mission;
use App\Models\MissionBookmark;
use App\Models\MissionPool;
use App\Models\Pets;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Treat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMissionController extends Controller
{
    function insertPost(Request $request){

    }

    /**
     * 미션 완료
     */
    function setUserMission(Request $request)
    {


    }

    function deletePost(Request $request){

    }
    function getUserPostList(Request $request){

    }
    /**
     * 사용자 미션 리스트
     */
    function getUserMissionList(Request $request){

        //print_r($request->session()->get('idx'));die();

        $user_idx = Auth::id();

        // 전체 미션 리스트
        $mission = Mission::
        select('mission_tbl.idx as mission_idx', 'mission_pool_tbl.*')
        ->addSelect(DB::raw('(SELECT count(mission_idx) FROM post_tbl WHERE status = 2 AND mission_idx = mission_tbl.idx AND user_idx = '.$user_idx.' AND deleted_at IS NULL) as post'))
        ->addSelect(DB::raw('(SELECT max(created_at) FROM post_tbl WHERE status = 2 AND mission_idx = mission_tbl.idx AND user_idx = '.$user_idx.' AND deleted_at IS NULL) AS user_mission_datetime'))
        ->addSelect(DB::raw('(SELECT count(idx) FROM mission_bookmark_tbl WHERE is_daily = IF(mission_pool_tbl.category = "일일미션", 1, 0 ) AND mission_idx = IF(mission_pool_tbl.category = "일일미션", mission_pool_tbl.idx, mission_tbl.idx ) AND user_idx = '.$user_idx.' AND deleted_at IS NULL) AS user_bookmark'))
        ->addSelect(DB::raw('(SELECT if(count(idx)!="0", true, false) from post_tbl where user_idx = '.$user_idx.' AND mission_idx = (select idx from mission_tbl where mission_pool_idx = mission_pool_tbl.precede_idx)) as is_precede'))
        ->where([
            ['mission_tbl.startdate', '<', date('Y-m-d H:i:s')],
            ['mission_tbl.enddate', '>', date('Y-m-d H:i:s')]
        ])
        ->join('mission_pool_tbl', 'mission_pool_tbl.idx', '=', 'mission_tbl.mission_pool_idx')
       // ->with('missionPool')
        ->get();

        $sorted = $mission->sortBy(function ($val, $key) {
            if($val['category'] == '자유미션') return 3;
            else if($val['category'] == '주간미션') return 2;
            else return 1;
        });

        // 찜한 미션 확인
        if($request->type == 1)
        {
            $sorted = $sorted->filter(function ($value, $key) {
                return $value->user_bookmark != 0;
            });
        }

        $result = $sorted->groupBy('category', true);


        // 스토리미션
        // 유저가 스토리진행 미션 타입을 선택했는지와 스토리퀘스트를 완료 했는지 확인한다.
        $user = User::select('story_mission_type', 'is_story_mission_complete')->where('idx', $user_idx)->first();
        $story_mission = '';
        //스토리퀘스트를 완료하지 않았다면 스토리 퀘스트를 불러옴
        if($user->is_story_mission_complete != 1){
            // 스토리미션타입을 설정하지 않았을 경우 설정할수 있는 미션을 내려보내줌
            if($user->story_mission_type === null){
                $story_mission = Mission::select('mission_tbl.idx as mission_idx', 'mission_pool_tbl.*')
                                        ->where('mission_pool_idx', 1)
                                        ->join('mission_pool_tbl', 'mission_pool_tbl.idx', '=', 'mission_tbl.mission_pool_idx')
                                        ->first();
            }else{
                // 스토리타입을 결정했을 경우 해당 스토리미션을 내려줌
                $story_mission = DB::select('SELECT * FROM
                (SELECT
                    `mission_tbl`.`idx` AS mission_idx,
                    `mission_pool_tbl`.*,
                    (SELECT
                            COUNT(mission_idx)
                        FROM
                            post_tbl
                        WHERE
                            status = 2
                                AND mission_idx = mission_tbl.idx
                                AND user_idx = ?
                                AND deleted_at IS NULL) AS post
                FROM
                    `mission_tbl`
                        INNER JOIN
                    `mission_pool_tbl` ON `mission_pool_tbl`.`idx` = `mission_tbl`.`mission_pool_idx`
                WHERE
                    `mission_pool_tbl`.`group` = ?
                    AND `mission_pool_tbl`.`category` = "스토리미션"
                    AND `mission_tbl`.`deleted_at` IS NULL) AS t1 WHERE t1.post = 0 ORDER BY idx ASC LIMIT 1', [$user_idx,  $user->story_mission_type]);

                if($story_mission) $story_mission = $story_mission[0];
            }
        }


       // print_r ($story_mission);die;
        return view('main.mission.mission', ['missions' => $result, 'story_mission' => $story_mission, 'user_stary_mission' => $user]);
    }
    /**
     * 미션 찜하기 API
     * 파라미터 요청값
     * @param mission_idx
     * @param is_daily
     * *** 데일리 미션일 경우 mission_pool_idx를 보내야함
    */
    function setMissionBookMark(Request $request)
    {
        $user_idx = Auth::id();

        $mission_idx = $request->mission_idx;
        $is_daily = $request->is_daily;


        if($mission_idx && $user_idx)
        {
            $is_check = MissionBookmark::where(['user_idx' => $user_idx, 'is_daily' => $is_daily, 'mission_idx' => $mission_idx])->withTrashed()->count();

            if($is_check)
            {
                DB::update('update `mission_bookmark_tbl` set `deleted_at` = if( deleted_at IS NULL, NOW(), NULL) where (`user_idx` = ? and `is_daily` = ? and `mission_idx` = ?) limit 1', [$user_idx, $is_daily, $mission_idx]);
            }else{
                DB::insert('insert into `mission_bookmark_tbl` (`user_idx`, `is_daily`, `mission_idx`) values (?, ?, ?)', [$user_idx, $is_daily, $mission_idx]);
            }

        }else
        {
            return response()->json([
                'status' => '500',
                'msg' => '로그인이 필요합닌다.'
            ]);
        }

        return response()->json([
            'status' => '200',
        ]);
    }

    function setUserStoryType(Request $request)
    {
        if($request->mission_idx){
            $user_idx = Auth::id();
            $user = User::find($user_idx);
            $user->story_mission_type = $request->story_mission_type;
            $user->story_mission_pet = $request->pet_idx;
            $user->save();

            $post = new Post;
            $post->user_idx = $user_idx;
            $post->mission_idx = $request->mission_idx;
            $post->status = 2;
            $post->is_public = 0;
            $post->save();

           // 바로 다음 스토리 퀘스트 url
            $next_url = '';
            $story_mission = DB::select('SELECT
                `mission_tbl`.`idx` AS mission_idx,
                `mission_pool_tbl`.*
            FROM
                `mission_tbl`
                    INNER JOIN
                `mission_pool_tbl` ON `mission_pool_tbl`.`idx` = `mission_tbl`.`mission_pool_idx`
            WHERE
                `mission_pool_tbl`.`group` = ?
                AND `mission_pool_tbl`.`category` = "스토리미션"
                AND `mission_tbl`.`deleted_at` IS NULL ORDER BY idx ASC LIMIT 1', [$user->story_mission_type]);

            if($story_mission){
                $next_url = $story_mission[0]->mission_idx;
            }
            return redirect('/mission')->with('confirm','완료되었습니다! 다음 스토리미션으로 이동하시겠습니까?')->with('next_url','/mission_detail?idx='.$next_url);
        }
    }

    function getUserMissionPostPage(Request $request){

        // 미션을 할수있는지 여부 확인 ( 참여 가능횟수 확인)

        $user_idx = Auth::id();
        $mission_idx = $request->mission_idx;

        if(!$mission_idx){ return redirect('/mission'); }
        $mission = Mission::where('idx',$mission_idx)->with('missionPool')->first();
        // 스토리미션일경우 선택펫 하나만
        $pet = Pets::where('user_idx', $user_idx)->get();
        $user = User::find($user_idx);
        if($mission->missionPool->category == '스토리미션' &&  $user->story_mission_pet)
        {
            $pet = Pets::where('idx', $user->story_mission_pet )->get();
        }
        // 진행중인 미션이 있는지 확인
        $post = Post::where('user_idx', $user_idx)->where('mission_idx', $mission_idx)->where('status', 1)->with('files')->latest()->first();
        if(!$post && $mission_idx)
        {
            $post = new Post;
            $post->user_idx = $user_idx;
            $post->mission_idx = $mission_idx;
            $post->status = 1;
            $post->save();
        }
        return view('main.mission.mission_post', ['data'=>$mission, 'post' => $post, 'pet' => $pet]);
    }

    function setUserMissionPost(Request $request)
    {
        $user_idx = Auth::id();
        if($request->post_idx)
        {
            $total_point = 0;
             // 태그 변환
            $content = $this->getTagChange($request->content);
            // 포스트 저장
            $post = Post::find($request->post_idx);
            $pet_idx = implode( ', ', $request->pet_idx);
            $post->pet_idx = $pet_idx;
            $post->content = $content;
            $post->status = 2;
            $post->save();


            /************** 미션에 따른 포인트 처리**********************************************/
            $mission = Mission::find($post->mission_idx);
            $mission_pool = MissionPool::find($mission->mission_pool_idx);
            $event_text = '';

            // 기본 트릿 적립
            $default_mission_treat_proportion = Config::where('key','def_mis_treat')->value('value'); // 기본 미션 획특 비율 기본값 1
            $default_mission_treat_proportion != 1 ? $event_text = '('.$default_mission_treat_proportion.'배 이벤트 적용)':'';
            $user_treat =  $mission_pool->point * $default_mission_treat_proportion;  // 유저 기본 트릿 + 이벤트
            $total_point += $user_treat;

            $userTreatController = new UserTreatController;
            $userTreatController->insertUserTreat($user_idx,$user_treat, $mission_pool->title.' : '.$mission_pool->category.' 완료 보상 '.$event_text);

            // 참여 가능 횟수 모두 완료시에 주는 보상 트릿 success_point에 값이 있을때만 실행
            if($mission_pool->success_point)
            {
                $post_count = Post::where([
                    ['mission_idx', $mission->idx],
                    ['status', 2],
                    ['user_idx', $user_idx]
                ])->count();                                        // 해당미션 완료한 횟수
                if($mission_pool->participation_count <= $post_count)
                {
                    $user_treat = $mission_pool->success_point * $default_mission_treat_proportion;
                    $total_point += $user_treat;
                    $userTreatController->insertUserTreat($user_idx,$user_treat, $mission_pool->title.' : '.$mission_pool->category.' 참여 횟수 완료 보상 '.$event_text);
                }
            }
            // 일일미션 연속보상
            if($mission_pool->category == '일일미션'){ $total_point += $this->bonusTreat($mission_pool, $user_idx); }
            /************** 미션에 따른 포인트 처리**********************************************/

            // 경험치 처리
            $userLevelController = new UserLevelController;
            $userLevelController->setUserLevel($user_idx, $mission_pool->exp, $mission_pool->title);

            // 기본 태그
            $mission_tag = explode(', ',$mission_pool->tag);
            foreach($mission_tag as $val)
            {
                Tag::insertOrIgnore([['tag' => $val, 'post_idx' => $post->idx]]);
            }
            // 회원이 단 태그
            $tags = $this->getUserPostTag($request->content);
            foreach($tags as $val)
            {
                Tag::insertOrIgnore([['tag' => $val, 'post_idx' => $post->idx]]);
            }

            // 맨션 알림 처리
            $this->userMention($request->content, $user_idx, $post->idx);

            $text = '';
            //스토리 미션일 경우 마지막 완료시 스토리미션 완료 처리
            if($mission_pool->category == '스토리미션')
            {
                $user = User::find($user_idx);
                $story_mission = DB::select('SELECT * FROM
                (SELECT
                    `mission_tbl`.`idx` AS mission_idx,
                    `mission_pool_tbl`.*,
                    (SELECT
                            COUNT(mission_idx)
                        FROM
                            post_tbl
                        WHERE
                            status = 2
                                AND mission_idx = mission_tbl.idx
                                AND user_idx = ?
                                AND deleted_at IS NULL) AS post
                FROM
                    `mission_tbl`
                        INNER JOIN
                    `mission_pool_tbl` ON `mission_pool_tbl`.`idx` = `mission_tbl`.`mission_pool_idx`
                WHERE
                    `mission_pool_tbl`.`group` = ?
                    AND `mission_pool_tbl`.`category` = "스토리미션"
                    AND `mission_tbl`.`deleted_at` IS NULL) AS t1 WHERE t1.post = 0 ORDER BY idx ASC LIMIT 1', [$user_idx,  $user->story_mission_type]);

                if(!$story_mission){
                    $user->is_story_mission_complete = 1;
                    $user->save();
                    $text = '\n축하드립니다! 스토리미션을 모두 완료했습니다.';
                }
            }

            return redirect('/mission')->with('alert','미션제출을 완료하였습니다! \n총 획득트릿 :'.$total_point.'트릿 '.$text. $event_text);
        }

    }

    function bonusTreat($mission_pool, $user_idx)
    {
        $bonus_treat = 0;
        $duration = DB::select('SELECT user_idx,
                            created_at,
                            MIN(created_at) AS from_date,
                            MAX(created_at) AS to_date ,
                            COUNT(*) - 1 AS duration
                    FROM
                    (SELECT T1.*, @rownum := @rownum + 1 AS rownum,
                            DATE_SUB(DATE_FORMAT(created_at, "%Y-%m-%d"), INTERVAL @rownum day) AS group_date
                    FROM
                    (SELECT p.*
                    FROM   post_tbl as p
                    inner join mission_tbl as m
                    on
                    m.idx = p.mission_idx, (SELECT @rownum:=0) r
                    WHERE p.user_idx = ?
                    and mission_pool_idx = ?
                    and status = 2
                    AND DATE_FORMAT(p.created_at, "%Y-%m-%d") <= "'.date('Y-m-d').'"
                    GROUP BY DATE_FORMAT(p.created_at, "%Y-%m-%d")
                    ORDER BY p.created_at) as T1 ) AS T2 GROUP BY group_date ORDER BY created_at desc', [$user_idx, $mission_pool->idx]);

        if(count($duration) != 0)
        {
            // 첫번째 인덱스의 duration값이 0일이 아닐경우에만 포인트 적용
            if($duration[0]->duration != 0){
                $consecutive_booster = Config::where('key','consecutive_booster')->value('value');  // 부스터 기간
                $consecutive_point_before = Config::where('key','consecutive_point_before')->value('value');  // 부스터 기간 이전 포인트
                $consecutive_point_after = Config::where('key','consecutive_point_after')->value('value');  // 부스터 기간 이후 포인트
                $duration[0]->duration < $consecutive_booster ? $bonus_treat = $consecutive_point_before : $bonus_treat = $consecutive_point_after;

                $userTreatController = new UserTreatController;
                $userTreatController->insertUserTreat($user_idx,$bonus_treat,$mission_pool->title.' : '.$mission_pool->category.' '.($duration[0]->duration + 1).'일 연속 보상');
            }
        }
        return $bonus_treat;
    }

    function getUserPostTag($text)
    {
        preg_match_all('/((?<=#)[\d|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣|\_]+)/', $text ,$matches);
        return $matches[0];
    }

    function getTagChange($text)
    {
        $result = preg_replace('/#([\d|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣|\_]+)/' , '<a href="/newsfeed?tag[]=${1}" class="hash-tag">${1}</a>', $text);
        return $result;
    }

    function userMention($text, $sender_idx, $post_idx)
    {
        preg_match_all('/(?<=data-item-id=")[0-9]*/', $text , $matches);
        if(count($matches[0]))
        {
            foreach($matches[0] as $val)
            {
                $alarm = collect();
                $alarm->user_idx = $val;
                $alarm->sender_idx = $sender_idx;
                $alarm->url = '/post_detail?post_idx='.$post_idx;
                $alarm->text = '';
                $appPushControllers = new AppPushControllers;
                $appPushControllers->sendSingleAppPush($alarm, 'mention');
            }
        }
    }
    // 일상
    function setUserDailyLifePost(Request $request)
    {
        $user_idx = Auth::id();
        if($request->post_idx)
        {
            $total_point = 0;
             // 태그 변환
            $content = $this->getTagChange($request->content);
            // 포스트 저장
            $post = Post::find($request->post_idx);
            $pet_idx = implode( ', ', $request->pet_idx);
            $post->pet_idx = $pet_idx;
            $post->content = $content;
            $post->status = 2;
            $post->save();

            // 기본 태그
            Tag::insertOrIgnore([['tag' => '일상', 'post_idx' => $post->idx]]);

            // 회원이 단 태그
            $tags = $this->getUserPostTag($request->content);
            foreach($tags as $val)
            {
                Tag::insertOrIgnore([['tag' => $val, 'post_idx' => $post->idx]]);
            }

            // 맨션 알림 처리
            $this->userMention($request->content, $user_idx, $post->idx);
        }
        return redirect('/myfeed')->with('alert','업로드하였습니다.');
    }
    // 일상
    function getUserDailyLifePost(Request $request){

        $user_idx = Auth::id();
        $pet = Pets::where('user_idx', $user_idx)->get();
        // 기존에 작성했던 일상이 있는지 확인하고 삭제
        $post = Post::where('user_idx', $user_idx)->where('mission_idx', null)->where('status', 1)->with('files')->latest()->first();
        if($post){
            Files::where([
                ['user_idx', $user_idx],
                ['table_name', 'post_tbl'],
                ['table_idx', $post->idx],
            ])->delete();
            $post->delete();
        }

        $post = new Post;
        $post->user_idx = $user_idx;
        $post->status = 1;
        $post->save();
        return view('main.mypage.mypost', ['post' => $post, 'pet' => $pet]);
    }

    // 포스트 수정
    function updatePost(Request $request){

        $user_idx = Auth::id();

        // 회원 포스트가 존재하는지 확인
        $post = Post::where('user_idx', $user_idx)->where('idx', $request->idx)->where('is_public', 1)->with('files')->with('mission')->first();
        //dd($post );
        if($post && $request->idx){
            $pet = Pets::where('user_idx', $user_idx)->get();
            return view('main.mypage.mypost_update', ['data' => $post, 'pet' => $pet]);
        }else{
            return redirect('/')->with('alert','삭제되거나 차단된 게시물 입니다.');
        }
    }

    // 첫번째 스토리미션 미션
    function storyFirst(Request $request)
    {
        $user_idx = Auth::id();
        $pets = Pets::where('user_idx',$user_idx)->get();
        if(count($pets) == 0)
        {
            die('<script>alert("등록된 반려견이 없습니다."); location.href="/mission"; </script>');
        }
        return view('main.mission.story_mission_first', ['pets' => $pets]);
    }

}
