<?php

namespace App\Http\Controllers\CommonControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alarm;
use App\Models\AppPush;
use App\Models\DeviceInfo;
use App\Models\LogAppPush;
use App\Models\User;
use Illuminate\Support\Arr;

class AppPushControllers extends Controller
{
    /**
     * @param type
     * post_like, post_reply, reply_mention, reply_like, event
     * @param request
     * user_idx, sender_idx, text($2 내용), url
     */
    // 개별 앱푸쉬
    function sendSingleAppPush($request, $type)
    {
        // 유저정보 호출
        $user = User::find($request->user_idx);

        $sender = '';
        if($request->sender_idx)
        {
            $sender = User::where('idx',$request->sender_idx)->first();
            $sender = $sender->nickname;
        }
        // 본인이 보낸 알람은 안가도록
        if($request->user_idx == $request->sender_idx)
        {
            return false;
        }

        // 알람 메시지정보 호출
        $appPush = AppPush::where('key', $type)->first();
        $push_column = $appPush->push_column;

        $msg = array();
        $msg['title'] = $appPush->title;
        $str = $appPush->body;
        $str = str_replace('$1', $sender, $str);                  // 보낸사람 닉네임 치환
        $str = str_replace('$2', $request->text, $str);           // 내용 치환


        $msg['body'] = $str;

        $alarm = new Alarm;
        $alarm->user_idx = $request->user_idx;
        $alarm->sender_idx = $request->sender_idx;
        $alarm->type = $type;
        $alarm->title = $msg['title'];
        $alarm->content = $msg['body'];
        $alarm->related_url = $request->url;
        $alarm->save();

        // 앱푸쉬 동의 및 토큰이 있을경우 퓌쉬 전송
        $user_fcm = DeviceInfo::where('user_id', $user->id)->orderBy('updated_at','desc')->first();
        //dd($user_fcm);
        if($user->push_agree == 'Y' && $user_fcm)
        {
            if($user[$push_column] != 'Y') return false;
            $tokens = array();
            $tokens[0] = $user_fcm->fcm;
            $fields = array('registration_ids' => $tokens, 'notification' => $msg);
            $res = $this->curl($fields);
            if($res)
            {
                $logAppPush = new LogAppPush;
                $logAppPush->is_single = 1;
                $logAppPush->user_idx = $request->user_idx;
                $logAppPush->sender_idx = $request->sender_idx;
                $logAppPush->request = json_encode($fields);
                $logAppPush->response = $res;
                $res = json_decode($res);
                $logAppPush->success = $res->success;
                $logAppPush->fail = $res->failure;
                $logAppPush->save();
            }
        }

        return true;
    }

    // 관리자 앱푸쉬
    function sendAdminAppPush($user_id, $msg, $mark_idx)
    {
        $user = User::where('id', $user_id)->first();

        if($user)
        {
            $user_fcm = DeviceInfo::where('user_id', $user->id)->orderBy('updated_at','desc')->first();
            $alarm = new Alarm;
            $alarm->user_idx = $user->idx;
            $alarm->sender_idx = 0;
            $alarm->type = 'event';
            $alarm->title = $msg['title'];
            $alarm->content = $msg['body'];
            $alarm->related_url = '/';
            $alarm->save();

            if($user->push_agree == 'Y' && $user_fcm)
            {
                $tokens = array();
                $tokens[0] = $user_fcm->fcm;
                $fields = array('registration_ids' => $tokens, 'notification' => $msg);
                $res = $this->curl($fields);
                if($res)
                {
                    $logAppPush = new LogAppPush;
                    $logAppPush->is_single = 1;
                    $logAppPush->user_idx = $user->idx;
                    $logAppPush->sender_idx = '';
                    $logAppPush->request = json_encode($fields);
                    $logAppPush->response = $res;
                    $logAppPush->mar_idx = $mark_idx;
                    $res = json_decode($res);
                    $logAppPush->success = $res->success;
                    $logAppPush->fail = $res->failure;
                    $logAppPush->save();
                }
            }
        }
    }
    function curl($fields)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $key = 'AAAAwA6_-r8:APA91bFUeRXYwuz3avGmPP8VZc4HXuPaDSSSnI8rmkp73jc_XaYzXFvjQwsrUHG4vx2vLiOczLMvE5rO_GIobU1cYMOuvNbxVMO9nCmvycsXxbDL485xahgNyzCC2SxvHqMxyvH1Mjm6';
        $headers = array('authorization:key='.$key,'Content-Type:application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

}
