<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\MissionPool;
use App\Models\MissionPoolTemp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionContoller extends Controller
{
    //
    function getMissionDetailWithIdx(Request $request){

        $user_idx = $request->session()->get('idx') != '' ? $request->session()->get('idx'):'null';
        if($request->mission_pool){$mission_idx = Mission::where('mission_pool_idx', $request->mission_pool)->orderBy('idx', 'desc')->first();$request->idx =$mission_idx->idx;}
        if($request->idx)
        {
            $mission = Mission::
            select('*')
            ->addSelect(DB::raw('(SELECT count(mission_idx) FROM post_tbl WHERE status = 2 AND mission_idx = mission_tbl.idx AND user_idx = '.$user_idx.' AND deleted_at IS NULL) as post'))
            ->addSelect(DB::raw('(SELECT max(created_at) FROM post_tbl WHERE status = 2 AND mission_idx = mission_tbl.idx AND user_idx = '.$user_idx.' AND deleted_at IS NULL) AS user_mission_datetime'))
            ->where('idx',$request->idx)->with('missionPool')->first();
            //print_r($mission);die();
            if(!$mission) return redirect('/mission')->with('alert', '잘못된 요청입니다.');
            $target = explode(',',$mission->missionPool->target);
            $content = '';
            $user = User::where('idx',$user_idx)->with('storyPet')->first();
            if($user && isset($user->storyPet->name))
            {
                $content = preg_replace("/벨라/", $user->storyPet->name, $mission->missionPool->content);
                $content = $this->proc_josa($content);
                $mission->missionPool->content = $content;
            }

            return view('main.mission.mission_detail', ['mission' => $mission, 'target' => $target, 'user' => $user]);
        }
        return redirect('/mission')->with('alert', '잘못된 요청입니다.');
    }

    function getAdminMissionDetailWithIdx(Request $request){

        $user_idx = $request->session()->get('idx') != '' ? $request->session()->get('idx'):'null';
        if($request->tidx)
        {
            $mission = MissionPoolTemp::
            select('*')
            ->where('idx',$request->tidx)->first();
        }
        if($request->idx)
        {
            $mission = MissionPool::
            select('*')
            ->where('idx',$request->idx)->first();
        }

        //print_r($mission);die();
        if(!$mission) return redirect('/mission')->with('alert', '잘못된 요청입니다.');
        $target = explode(',',$mission->target);
        $content = '';
        $user = User::where('idx',$user_idx)->with('storyPet')->first();
        if($user && isset($user->storyPet->name))
        {
            $content = preg_replace("/벨라/", $user->storyPet->name, $mission->content);
            $content = $this->proc_josa($content);
            $mission->content = $content;
        }

            return view('main.mission.mission_detail_admin', ['mission_pool' => $mission, 'target' => $target, 'user' => $user]);

      //  return redirect('/mission')->with('alert', '잘못된 요청입니다.');
    }

    function proc_josa($ex) {
        $pps = ["은(는)","이(가)","이(랑)","을(를)","과(와)"];
        foreach( $pps as $pp ) {
            $ex = preg_replace_callback("/(.)".preg_quote($pp)."/u",
                    function($matches) use($pp) {
                        $ch = $matches[1];
                        $has_jongsung = true;
                        if(preg_match('/[가-힣]/',$ch)) {
                            $code = (ord($ch[0])&0x0F)<<12 | (ord($ch[1])&0x3F)<<6 | (ord($ch[2])&0x3F);
                            $has_jongsung = ( ($code-16)%28 != 0 );
                        }
                        else if(preg_match('/[2459]/', $ch)) $has_jongsung = false;
                        return $ch.mb_substr($pp,($has_jongsung?0:2),1).(preg_match('/이\(랑\)/', $pp) && $has_jongsung?'랑':null);
                    }, $ex);
        }
        return $ex;
    }
}
