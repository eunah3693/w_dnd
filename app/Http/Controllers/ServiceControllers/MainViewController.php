<?php

namespace App\Http\Controllers\ServiceControllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Models\Banner;
use App\Models\Board;
use App\Models\Event;
use App\Models\Mission;
use App\Models\Popup;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class MainViewController extends Controller
{

    public function getMain(Request $request)
    {

        // 배너
        $banner_top = Banner::where([
            ['page', '=' ,'main'],
            ['position', '=' ,'top'],
            ['is_public', '=' ,'1'],
            ['startdate', '<', date('Y-m-d H:i:s')],
            ['enddate', '>', date('Y-m-d H:i:s')]
        ])
        ->orderBy('order', 'asc')
        ->get();
        // 배너 하단
        $banner_bottom = Banner::where([
            ['page', '=' ,'main'],
            ['position', '=' ,'bottom'],
            ['is_public', '=' ,'1'],
            ['startdate', '<', date('Y-m-d H:i:s')],
            ['enddate', '>', date('Y-m-d H:i:s')]
        ])
        ->orderBy('order', 'asc')
        ->get();
        // 팝업
        $popup = Popup::where([
                    ['page', '=' ,'main'],
                    ['is_public', '=' ,'1'],
                    ['startdate', '<', date('Y-m-d H:i:s')],
                    ['enddate', '>', date('Y-m-d H:i:s')]
                ])
                ->get();

        $user = new User;
        // 로그인 했을경우
        Auth::viaRemember();
        if (Auth::check()) {
            $user = Auth::user();
            $request->session()->put('idx', $user->idx);
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('level', $user->level);
            $request->session()->put('nickname', $user->nickname);
        }

        // 첫번째 스토리미션
        $first_story_mission = Mission::select('mission_tbl.idx as mission_idx', 'mission_pool_tbl.*')
                                        ->where('mission_pool_idx', 1)
                                        ->join('mission_pool_tbl', 'mission_pool_tbl.idx', '=', 'mission_tbl.mission_pool_idx')
                                        ->first();
        // 기본 스토리미션 타입
        $story_mission_type = 1;    //성견
        $story_mission_next_index = 0; // 스토리미션 다음단계 부분
        $mission_list = collect();
        $mission_title = '스토리미션';
        if($user->story_mission_type !== null)  $story_mission_type = $user->story_mission_type; // 유저가 스토리진행 미션 타입을 선택했는지와 스토리퀘스트를 완료 했는지 확인한다.

        if($user->is_story_mission_complete === 1 && $user) {
            $mission_title = '도전미션';
            $mission_list = DB::select('SELECT * FROM
            (SELECT
                `mission_tbl`.`idx` AS mission_idx,
                `mission_pool_tbl`.*,
                (SELECT
                        COUNT(mission_idx)
                    FROM
                        post_tbl
                    WHERE
                        status = 2
                            AND user_idx = ?
                            AND mission_idx = mission_tbl.idx
                            AND deleted_at IS NULL) AS post
            FROM
                `mission_tbl`
                    INNER JOIN
                `mission_pool_tbl` ON `mission_pool_tbl`.`idx` = `mission_tbl`.`mission_pool_idx`
            WHERE
                `mission_pool_tbl`.`category` in ("일일미션","주간미션","자유미션")
                AND `mission_tbl`.`startdate` < ?
                AND `mission_tbl`.`enddate` > ?
                AND `mission_tbl`.`deleted_at` IS NULL) AS t1 ORDER BY FIELD(category,"주간미션","일일미션") DESC', [$user->idx,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);
        }else{
            $mission_list = DB::select('SELECT * FROM
            (SELECT
                `mission_tbl`.`idx` AS mission_idx,
                `mission_pool_tbl`.*,
                (SELECT
                        COUNT(mission_idx)
                    FROM
                        post_tbl
                    WHERE
                        status = 2
                            AND user_idx = ?
                            AND mission_idx = mission_tbl.idx
                            AND deleted_at IS NULL) AS post
            FROM
                `mission_tbl`
                    INNER JOIN
                `mission_pool_tbl` ON `mission_pool_tbl`.`idx` = `mission_tbl`.`mission_pool_idx`
            WHERE
                `mission_pool_tbl`.`group` = ?
                AND `mission_pool_tbl`.`category` = "스토리미션"
                AND `mission_tbl`.`deleted_at` IS NULL) AS t1 ORDER BY idx ASC', [$user->idx,$story_mission_type]);

            foreach($mission_list as $k => $v)
            {
                $story_mission_next_index = $k + 1;
                if($v->post == 0)break;
            }
            //dd($story_mission_next_index);

            $mission_list2 = DB::select('SELECT * FROM
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
                            AND deleted_at IS NULL) AS post
            FROM
                `mission_tbl`
                    INNER JOIN
                `mission_pool_tbl` ON `mission_pool_tbl`.`idx` = `mission_tbl`.`mission_pool_idx`
            WHERE
                `mission_pool_tbl`.`category` in ("일일미션","주간미션")
                AND `mission_tbl`.`startdate` < ?
                AND `mission_tbl`.`enddate` > ?
                AND `mission_tbl`.`deleted_at` IS NULL) AS t1 ORDER BY FIELD(category,"주간미션","일일미션") DESC', [date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

            foreach($mission_list2 as $v){array_push($mission_list, $v);}
           // dd($mission_list);
        }

        // 인기 뉴스피드
        $post = Post::
                select('post_tbl.*')
                ->addSelect(DB::raw('(SELECT COUNT(idx) FROM like_tbl WHERE post_idx = post_tbl.idx AND deleted_at IS NULL) as like_count'))
                ->whereNull('parent_idx')
                ->whereNotNull('content')
                ->where('content', '!=', '')
                ->where('is_public','1')->where('status','2')
                ->groupBy('post_tbl.idx')
                ->with('files')
                ->with('reply')
                ->orderBy('like_count', 'desc')->latest()->limit(5)->get();
        foreach($post as $key => $val)
        {
            $c_reply = 0;
            foreach($val->reply as $key2){ $c_reply += $key2->reply2_count; }
            $post[$key]->sub_reply_count = $c_reply;
        }
        // 교환소 재고 남은걸로 ..
        $shop = DB::select('SELECT * FROM
        (SELECT
           *, (SELECT count(idx) FROM event_join_tbl WHERE event_idx = event_tbl.idx AND status =1 ) as count
        FROM
        event_tbl) as T1 WHERE T1.count < T1.stock AND is_public = 1 ORDER BY ISNULL(`order`), `order` ASC,created_at DESC LIMIT 5');
        //dd($event);
        // 이벤트
        $event = Board::where([
            ['category','이벤트'],
            ['startdate', '<', date('Y-m-d H:i:s')],
            ['enddate', '>', date('Y-m-d H:i:s')],
        ])->orderBy('created_at', 'desc')->limit(5)->get();

        // 공지사항 고정, 생성 순
        $notice = Board::where([
            ['category','공지사항'],
        ])->orderBy('top_fixed', 'desc')->orderBy('created_at', 'desc')->limit(3)->get();

        return view('main.main', [
            'users' => $user,
            'banner_top' => $banner_top,
            'banner_bottom' => $banner_bottom,
            'popups' => $popup,
            'first_story_mission' => $first_story_mission,
            'story_mission' => $mission_list,
            'mission_title' => $mission_title,
            'story_mission_next_index' => $story_mission_next_index,
            'post' => $post,
            'event' => $event,
            'shop' => $shop,
            'notice' => $notice
        ]);
    }
}
