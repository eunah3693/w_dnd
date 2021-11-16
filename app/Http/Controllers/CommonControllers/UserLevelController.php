<?php

namespace App\Http\Controllers\CommonControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\LogExp;
use App\Models\User;

class UserLevelController extends Controller
{
    function setUserLevel($user_idx, $exp, $mission_title)
    {
        $user = User::find($user_idx);
        $user_level = $user->level;                                               // 유저레벨
        $user_exp = $user->exp;                                                 // 기존 획득한 경험치
        $event_exp = Config::where('key','default_exp_proportion')->value('value');   // (경험치 이벤트) 획득 확률
        $total_exp = $user_exp + ($exp * $event_exp);                             // 기존획득 경험치 +(기본경험치 * 이벤트) = 총 획득한 경험치

        $fix_level = Config::where('key','fix_exp_level')->value('value');  // 경험치 최대 레벨
        $start_exp = Config::where('key','default_start_exp')->value('value');  // 최초 시작 경험치
        $level_exp_prop = Config::where('key','level_exp_proportion')->value('value'); // 경험치 증가비율

        // 설정값에 지정해둔 경험치 최대레벨에 도달하면 경험치는 일정하게 유지
        if($user_level > $fix_level){ $user_level = $fix_level; }

        $level_total_exp = floor($start_exp * pow($level_exp_prop , $user_level - 1));   // 해당레벨의 총경험치

        // 회원의 경험치가 해당레벨의 경험치보다 크거나 같을경우 레벨업시키고 나머지 값을 반환한다
        if($total_exp >= $level_total_exp)
        {
            $user->level = $user->level + 1;
            $total_exp = $total_exp - $level_total_exp;

            // 레벨업을 했을경우 알람메시지 보내기
            $alarm = collect();
            $alarm->user_idx = $user_idx;
            $alarm->sender_idx = 0;
            $alarm->url = '/my';
            $alarm->text = '현재레벨 Lv.'. $user->level;
            $appPushControllers = new AppPushControllers;
            $appPushControllers->sendSingleAppPush($alarm, 'level_up');
        }

        $user->exp = $total_exp;
        $user->save();

        $log_exp = new LogExp;
        $log_exp->user_idx = $user_idx;
        $log_exp->exp = $exp * $event_exp;
        $log_exp->memo = '[' .$mission_title .'] 미션 완료 보상 ';
        $log_exp->save();
    }
}
