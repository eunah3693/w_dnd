<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Models\Alarm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlarmController extends Controller
{
    // 알람 리스트 뷰 리턴
    function getUserAlarmList(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $alarm = collect();
        if($user_idx)
        {
            $alarm = Alarm::where('user_idx', $user_idx)
                    ->with('sender')
                    ->latest()
                    ->paginate(10);
            $alarm->setPath('');
            // $alarm->sender->file();
        }
        return view('main.notification.notification', ['data'=>$alarm]);
    }

    // 안읽은 알람 있는지 체크 json 리턴
    function getCheckUserAlarm(Request $request)
    {
        $idx = $request->session()->get('idx');
        $count = Alarm::where('user_idx', $idx)
        ->where('is_check', 0)
        ->count();
        return response()->json([
            'is_check' => $count != 0 ? true:false,
            'status' => 200,
        ], 200);
    }

    // 알람 확인 체크 json 리턴
    function setCheckUserAlarm(Request $request)
    {
        $user_idx = Auth::id();
        Alarm::where('user_idx', $user_idx)->update(['is_check' => 1]);
    }
}
