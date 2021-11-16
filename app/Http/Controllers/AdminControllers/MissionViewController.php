<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonControllers\ImageController;
use App\Models\Category;
use App\Models\Mission;
use App\Models\MissionUser;
use App\Models\Cycle;
use App\Models\MissionPool;
use App\Models\MissionPoolTemp;
use App\Models\Post;
use App\Models\Report;
use PHPUnit\TextUI\XmlConfiguration\Group;

class MissionViewController extends Controller
{
    private $TARGET;

    function __construct()
    {
        $this->TARGET = collect([
            ['적은 산책량'], ['추격 본능'], ['낮은 혈액순환'],['실내견'],['분리불안'], ['강한 호기심'], ['12개월 이하'], ['급한 성격'], ['통제 불가'], ['낮은 사회성'], ['모든 강아지'], ['속털 많은귀'], ['사료가 주식'], ['주로 실내활동'], ['폭풍 털갈이'], ['유대감 부족'], ['잦은 공격성'], ['외향적 성격'], ['사회화 시기'], ['활발한 성격'], ['무기력한 성격'], ['집중력 결핍'], ['질주 본능'], ['약한 치아'], ['다이어트'], ['소심한 성격'], ['복종훈련'], ['낮은 사회성'], ['잦은 공격성'], ['짖음 증상'], ['강한 경계심'], ['접힌 귀'], ['높은 식탐'], ['예민한 피부'], ['강한 고집'], ['적은 운동량'], ['예민한 성격'], ['많은 치태치석'], ['덤벙대는 성격'], ['심혈관 질환']
        ]);
    }

    /******************** 스토리 미션 ********************/
    public function getStoryMissionList(Request $request)
    {
        $total = MissionPool::where('category','스토리미션')->count();
        $g0_total = MissionPool::where('group', 0)->where('category','스토리미션')->count();
        $g1_total = MissionPool::where('group', 1)->where('category','스토리미션')->count();
        $g2_total = MissionPool::where('group', 2)->where('category','스토리미션')->count();
        $data = MissionPool::where('category','스토리미션')->with('precede')->paginate(40);

        if($request->group !== null)
        {
            $query = MissionPool::where('category','스토리미션')->orderBy('created_at', 'desc');
            $query =  $query->where('group', '=', $request->group);
            $data = $query->paginate(20);
        }

        return view('admin.mission_manage.story', ['data' => $data , 'total' => $total, 'g0_total' => $g0_total, 'g1_total' => $g1_total, 'g2_total' => $g2_total]);
    }

    public function getStoryMissionModify(Request $request)
    {

        $mission_list = MissionPool::select('idx','title')->get();
        $idx = $request->idx;
        $data = MissionPool::where('idx',$idx)->with('precede')->first();
        if($request->idx)
        {
            $user_target = explode(',',$data->target);
            return view('admin.mission_manage.story_modify', ['data' => $data, 'mission_list' => $mission_list, 'type' => '/admin/mission_manage/story/update', 'title' => '수정', 'target' =>$this->TARGET, 'user_target'=>$user_target ]);
        }else{
            return view('admin.mission_manage.story_modify', ['data' => $data, 'mission_list' => $mission_list, 'type' => '/admin/mission_manage/story/insert', 'title' => '신규추가', 'target' =>$this->TARGET, 'user_target'=> array('0') ]);
        }
    }

    public function getStoryMissionDetail(Request $request)
    {
        $mission_list = MissionPool::select('idx','title')->get();
        $idx = $request->idx;
        $data = MissionPool::where('idx',$idx)->with('precede')->first();
        if($request->idx)
        {
            return view('admin.mission_manage.story_detail', ['data' => $data, 'mission_list' => $mission_list, 'type' => '/admin/mission_manage/story/update', 'title' => '상세보기'])->with(['noti','페이지가 없습니다.']);
        }else{
            return redirect('/admin/mission_manage/story')->with(['noti','페이지가 없습니다.']);
        }
    }

    public function insertStroyMission(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $mission_pool = new MissionPool;
        // 파일 업로드
        $imageController = new ImageController;

        $mission_pool->precede_idx  = $request->precede_idx;
        $mission_pool->is_public  = $request->is_public;
        $mission_pool->user_idx  = $user_idx;
        $mission_pool->category  = $request->category;
        $mission_pool->title  = $request->title;
        $mission_pool->sub_title  = $request->sub_title;
        $mission_pool->content  = $request->content;
        $mission_pool->youtube  = $request->youtube;
        $mission_pool->difficulty  = $request->difficulty;
        $mission_pool->goal  = $request->goal;
        $mission_pool->how  = $request->how;
        $mission_pool->tips  = $request->tips;
        $mission_pool->tips2  = $request->tips2;
        $mission_pool->preview  = $request->preview;
        $mission_pool->point  = $request->point;
        if($request->target){ $mission_pool->target = implode(",",$request->target);}
        $mission_pool->success_point  = $request->success_point;
        $mission_pool->tag  = $request->tag;
        $mission_pool->exp  = $request->exp;
        $mission_pool->participation_count  = $request->participation_count;
        $mission_pool->cooldown  = $request->cooldown;
        $mission_pool->startdate  = $request->startdate;
        $mission_pool->enddate  = $request->enddate;
        $mission_pool->save();


        $thum_file_idx = $imageController->insertImageWithTable($request->file('thum_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx);
        $main_file_idx = $imageController->insertImageWithTable($request->file('main_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx);

        $mission_pool->thum_file_idx  = $thum_file_idx;
        $mission_pool->main_file_idx  = $main_file_idx;
        $mission_pool->save();

        $mission = new Mission;
        $mission->mission_pool_idx = $mission_pool->idx;
        $mission->save();

        return redirect('/admin/mission_manage/story')->with('status', '신규 추가 되었습니다.');
    }

    public function updateStroyMission(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $mission_pool = MissionPool::find($request->idx);
        // 파일 업로드
        $imageController = new ImageController;
        if($request->file('thum_file'))
        {
            $thum_file_idx = $imageController->updateImageWithTable($request->file('thum_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx, $mission_pool->thum_file_idx);
            $mission_pool->thum_file_idx  = $thum_file_idx;
        }
        if($request->file('main_file'))
        {
            $main_file_idx = $imageController->updateImageWithTable($request->file('main_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx, $mission_pool->main_file_idx);
            $mission_pool->main_file_idx  = $main_file_idx;
        }

        $mission_pool->precede_idx  = $request->precede_idx;
        $mission_pool->is_public  = $request->is_public;
        $mission_pool->user_idx  = $user_idx;
        $mission_pool->category  = $request->category;
        $mission_pool->title  = $request->title;
        $mission_pool->sub_title  = $request->sub_title;
        $mission_pool->content  = $request->content;
        $mission_pool->youtube  = $request->youtube;
        $mission_pool->difficulty  = $request->difficulty;
        $mission_pool->goal  = $request->goal;
        $mission_pool->how  = $request->how;
        $mission_pool->tips  = $request->tips;
        if($request->target){ $mission_pool->target = implode(",",$request->target);}
        $mission_pool->tips2  = $request->tips2;
        $mission_pool->preview  = $request->preview;
        $mission_pool->point  = $request->point;
        $mission_pool->success_point  = $request->success_point;
        $mission_pool->tag  = $request->tag;
        $mission_pool->exp  = $request->exp;
        $mission_pool->participation_count  = $request->participation_count;
        $mission_pool->cooldown  = $request->cooldown;
        $mission_pool->startdate  = $request->startdate;
        $mission_pool->enddate  = $request->enddate;
        $mission_pool->save();

        return redirect('/admin/mission_manage/story')->with('status', '변경 되었습니다.');
    }

    public function updateStroyMissionTemp(Request $request)
    {
        $user_idx = $request->session()->get('idx');

        $mission_pool = MissionPoolTemp::find($request->idx);
        if(!$mission_pool){
            $mission_pool = new MissionPoolTemp;
        }
        if($request->idx)$mission_pool->idx = $request->idx;
        if($request->thum_file_idx) $mission_pool->thum_file_idx = $request->thum_file_idx;
        if($request->main_file_idx) $mission_pool->main_file_idx = $request->main_file_idx;
        // 파일 업로드
        $imageController = new ImageController;
        if($request->file('thum_file'))
        {
            $thum_file_idx = $imageController->updateImageWithTable($request->file('thum_file'), $user_idx, 'mission_pool_temp_tbl', $mission_pool->idx, $mission_pool->thum_file_idx);
            $mission_pool->thum_file_idx  = $thum_file_idx;
        }
        if($request->file('main_file'))
        {
            $main_file_idx = $imageController->updateImageWithTable($request->file('main_file'), $user_idx, 'mission_pool_temp_tbl', $mission_pool->idx, $mission_pool->main_file_idx);
            $mission_pool->main_file_idx  = $main_file_idx;
        }
        $mission_pool->precede_idx  = $request->precede_idx;
        $mission_pool->is_public  = $request->is_public;
        $mission_pool->user_idx  = $user_idx;
        $mission_pool->category  = $request->category;
        $mission_pool->title  = $request->title;
        if($request->group)$mission_pool->group  = $request->group;
        $mission_pool->sub_title  = $request->sub_title;
        $mission_pool->content  = $request->content;
        $mission_pool->youtube  = $request->youtube;
        $mission_pool->difficulty  = $request->difficulty;
        $mission_pool->goal  = $request->goal;
        $mission_pool->how  = $request->how;
        $mission_pool->tips  = $request->tips;
        if($request->target){ $mission_pool->target = implode(",",$request->target);}
        $mission_pool->tips2  = $request->tips2;
        $mission_pool->preview  = $request->preview;
        $mission_pool->point  = $request->point;
        $mission_pool->success_point  = $request->success_point;
        $mission_pool->tag  = $request->tag;
        $mission_pool->exp  = $request->exp;
        $mission_pool->participation_count  = $request->participation_count;
        $mission_pool->cooldown  = $request->cooldown;
        $mission_pool->startdate  = $request->startdate;
        $mission_pool->enddate  = $request->enddate;
        $mission_pool->save();

        return response()->json([
            'msg' => '임시저장되었습니다.',
            'idx' =>  $mission_pool->idx,
            'status' => 200,
        ], 200);

    }

    public function deleteStroyMission(Request $request)
    {
        if($request->idx)
        {
            MissionPool::find($request->idx)->delete();
        }
        return redirect()->back()->with('status', '변경 되었습니다.');
    }

    /******************** 전체 미션 ********************/
    public function getMissionPoolList(Request $request)
    {
        $total = MissionPool::where('category', '!=','스토리미션')->count();
        $daily = MissionPool::where('category','일일미션')->count();
        $weekly = MissionPool::where('category','주간미션')->count();
        $free = MissionPool::where('category','자유미션')->count();
        $data = MissionPool::where('category', '!=','스토리미션')->with('precede','mission')->orderBy('category','desc')->orderBy('created_at','desc')->paginate(20);
       // echo $data; die();
       if($request->input())
        {
            $query = MissionPool::select('*')->where('category', '!=','스토리미션')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $data = $query->paginate(20);
        }
        return view('admin.mission_manage.mission', ['data' => $data, 'total' => $total, 'daily' => $daily, 'weekly' => $weekly, 'free' => $free]);
    }

    public function getMissionPoolModify(Request $request)
    {
        $mission_list = MissionPool::select('idx','title')->with('mission')->get();
        $idx = $request->idx;
        $data = MissionPool::where('idx',$idx)->with('precede')->first();
        if($request->idx)
        {
            $user_target = explode(',',$data->target);
            return view('admin.mission_manage.mission_modify', ['data' => $data, 'mission_list' => $mission_list, 'type' => '/admin/mission_manage/mission/update', 'title' => '상세보기 및 수정', 'target' =>$this->TARGET, 'user_target'=>$user_target]);
        }else{
            return view('admin.mission_manage.mission_modify', ['data' => $data, 'mission_list' => $mission_list, 'type' => '/admin/mission_manage/mission/insert', 'title' => '신규추가', 'target' =>$this->TARGET, 'user_target'=>[]]);
        }
        //return view('admin.mission_manage.mission_detail', ['data' => '']);
    }
    public function getMissionPoolDetail(Request $request)
    {
        $mission_list = MissionPool::select('idx','title')->with('mission')->get();
        $idx = $request->idx;
        $data = MissionPool::where('idx',$idx)->with('precede')->first();
        if($request->idx)
        {
            return view('admin.mission_manage.mission_detail', ['data' => $data, 'mission_list' => $mission_list, 'type' => '/admin/mission_manage/mission/update', 'title' => '상세보기 및 수정']);
        }else{
            return redirect('/admin/mission_manage/story')->with('status', '페이지가 없습니다.');
        }
        //return view('admin.mission_manage.mission_detail', ['data' => '']);
    }

    public function insertPoolMission(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $mission_pool = new MissionPool;
        // 파일 업로드
        $imageController = new ImageController;

        $mission_pool->precede_idx  = $request->precede_idx;
        $mission_pool->is_public  = $request->is_public;
        $mission_pool->user_idx  = $user_idx;
        $mission_pool->category  = $request->category;
        $mission_pool->title  = $request->title;
        $mission_pool->sub_title  = $request->sub_title;
        $mission_pool->content  = $request->content;
        $mission_pool->youtube  = $request->youtube;
        $mission_pool->difficulty  = $request->difficulty;
        $mission_pool->goal  = $request->goal;
        $mission_pool->how  = $request->how;
        $mission_pool->tips  = $request->tips;
        $mission_pool->tips2  = $request->tips2;
        $mission_pool->preview  = $request->preview;
        $mission_pool->point  = $request->point;
        if($request->target){ $mission_pool->target = implode(",",$request->target);}
        $mission_pool->success_point  = $request->success_point;
        $mission_pool->tag  = $request->tag;
        $mission_pool->exp  = $request->exp;
        $mission_pool->participation_count  = $request->participation_count;
        $mission_pool->cooldown  = $request->cooldown;
        $mission_pool->startdate  = $request->startdate;
        $mission_pool->enddate  = $request->enddate;
        $mission_pool->save();

        if($request->file('thum_file') && $request->file('main_file') )
        {
            $thum_file_idx = $imageController->insertImageWithTable($request->file('thum_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx);
            $main_file_idx = $imageController->insertImageWithTable($request->file('main_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx);

            $mission_pool->thum_file_idx  = $thum_file_idx;
            $mission_pool->main_file_idx  = $main_file_idx;
            $mission_pool->save();
        }

        //미션 바로 발급할경우
        if($request->category == '자유미션')
        {
            $mission = new Mission;
            $mission->mission_pool_idx = $mission_pool->idx;
            $mission->startdate = $request->mission_startdate;
            $mission->enddate = $request->mission_enddate;
            $mission->save();
        }

        return redirect('/admin/mission_manage/mission')->with('status', '신규 추가 되었습니다.');
    }
    //  발급미션 시간수정
    public function updateMissionDate(Request $request, $id)
    {
        $mission = Mission::find($id);
        $mission->startdate = $request->startdate;
        $mission->enddate = $request->enddate;
        $mission->save();

        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);

    }

    public function insertMissionDate(Request $request, $id)
    {
        $mission = new Mission;
        $mission->mission_pool_idx = $id;
        $mission->startdate = $request->startdate;
        $mission->enddate = $request->enddate;
        $mission->save();

        return response()->json([
            'msg' => '신규발급되었습니다.',
            'status' => 200,
        ], 200);

    }
    public function updatePoolMission(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $mission_pool = MissionPool::find($request->idx);
        // 파일 업로드
        $imageController = new ImageController;
        if($request->file('thum_file'))
        {
            $thum_file_idx = $imageController->updateImageWithTable($request->file('thum_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx, $mission_pool->thum_file_idx);
            $mission_pool->thum_file_idx  = $thum_file_idx;
        }
        if($request->file('main_file'))
        {
            $main_file_idx = $imageController->updateImageWithTable($request->file('main_file'), $user_idx, 'mission_pool_tbl', $mission_pool->idx, $mission_pool->main_file_idx);
            $mission_pool->main_file_idx  = $main_file_idx;
        }

        $mission_pool->precede_idx  = $request->precede_idx;
        $mission_pool->is_public  = $request->is_public;
        $mission_pool->user_idx  = $user_idx;
        $mission_pool->category  = $request->category;
        $mission_pool->title  = $request->title;
        $mission_pool->sub_title  = $request->sub_title;
        $mission_pool->content  = $request->content;
        $mission_pool->youtube  = $request->youtube;
        $mission_pool->difficulty  = $request->difficulty;
        $mission_pool->goal  = $request->goal;
        $mission_pool->how  = $request->how;
        $mission_pool->tips  = $request->tips;
        $mission_pool->tips2  = $request->tips2;
        $mission_pool->preview  = $request->preview;
        if($request->target){ $mission_pool->target = implode(",",$request->target);}
        $mission_pool->point  = $request->point;
        $mission_pool->success_point  = $request->success_point;
        $mission_pool->tag  = $request->tag;
        $mission_pool->exp  = $request->exp;
        $mission_pool->participation_count  = $request->participation_count;
        $mission_pool->cooldown  = $request->cooldown;
        $mission_pool->startdate  = $request->startdate;
        $mission_pool->enddate  = $request->enddate;
        $mission_pool->save();

        return redirect('/admin/mission_manage/mission_detail?idx=' . $mission_pool->idx)->with('status', '변경 되었습니다.');
    }

    public function deletePoolMission(Request $request)
    {
        return view('admin.mission_manage.mission', ['data' => '']);
    }

    /******************** 발급 미션 ********************/
    public function getMissionList(Request $request)
    {
        $total = Mission::count();
        $today = Mission::whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();// 금일 팻 등록수
        $mission = Mission::with('missionPool')->orderBy('created_at','desc')->paginate(20);
        //print_r($mission);die();
        return view('admin.mission_manage.accepted_mission', ['data' => $mission, 'total' => $total, 'today'=>$today ]);
    }

    public function getMission(Request $request)
    {
        return view('admin.mission_manage.accepted_mission', ['data' => '']);
    }

    public function insertMission(Request $request)
    {
        return view('admin.mission_manage.accepted_mission', ['data' => '']);
    }

    public function updateMission(Request $request)
    {
        return view('admin.mission_manage.accepted_mission', ['data' => '']);
    }

    public function deleteMission(Request $request)
    {
        return view('admin.mission_manage.accepted_mission', ['data' => '']);
    }

    /******************** 회원 미션 내역 ********************/
    public function getUserMissionList(Request $request)
    {
        return view('admin.mission_manage.member_mission_list', ['data' => '']);
    }

    public function getUserMission(Request $request)
    {
        return view('admin.mission_manage.member_mission_detail', ['data' => '']);
    }

    public function insertUserMission(Request $request)
    {
        return view('admin.mission_manage.member_mission_list', ['data' => '']);
    }

    public function updateUserMission(Request $request)
    {
        return view('admin.mission_manage.member_mission_list', ['data' => '']);
    }

    public function deleteUserMission(Request $request)
    {
        return view('admin.mission_manage.member_mission_list', ['data' => '']);
    }

    /******************** 신고 관리 ********************/
    public function getPostReportList(Request $request)
    {
        $total_count = Report::count();
        $today_count = Report::whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();
        $data = Report::with('user')->orderBy('created_at', 'desc')->paginate(20);
        if($request->input())
        {
            $query = Report::select('*')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $data = $query->paginate(20);
        }
        return view('admin.mission_manage.report', ['data' => $data , 'total' => $total_count, 'today' => $today_count ]);
    }

    public function getPostReport(Request $request)
    {
        if($request->post_idx)
        {
            return redirect('/admin/mission_manage/member_mission_detail?post_idx='.$request->post_idx);
        }
        return redirect('/admin/mission_manage/report');
    }

    public function insertPostReport(Request $request)
    {
        return view('admin.mission_manage.report', ['data' => '']);
    }

    public function updatePostReport(Request $request)
    {
        return view('admin.mission_manage.report', ['data' => '']);
    }

    public function deletePostReport(Request $request)
    {
        $report = Report::find($request->report_idx);
        $report->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }

    /******************** 댓글 관리 ********************/
    public function getPostReplyList(Request $request)
    {
        $total_count = Post::whereNotNull('parent_idx')->count();
        $today_count = Post::whereNotNull('parent_idx')->whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();
        $data = Post::whereNotNull('parent_idx')->with('user')->paginate(20);
        return view('admin.mission_manage.reply', ['data' => $data , 'total' => $total_count, 'today' => $today_count]);
    }

    public function insertPostReply(Request $request)
    {
        return view('admin.mission_manage.reply', ['data' => '']);
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
}
