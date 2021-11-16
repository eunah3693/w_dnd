<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param os, uuid, fcm
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
    {
    	$os = $request->os;
    	$uuid = $request->uuid;
    	$fcm = $request->fcm;

    	$device = DeviceInfo::updateOrCreate(
    			['uuid' => $uuid],
    			['uuid' => $uuid, 'fcm' => $fcm, 'os' => $os]
    	);

    	return response()->json([
    			'result' => $device,
    	], 200);
    }

    public function getUUID(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        // fcm 토큰 저장 및 uuid fcm userid 매핑
        if($user_idx && $request->uuid){
            $user = User::find($user_idx);
            $device = DeviceInfo::where('uuid', $request->uuid)->first();
            if($device && $user)
            {
                $device->user_id = $user->id;
                $device->save();            //디바이스에 저장

                $user->fcm_token = $device->fcm;
                $user->save();

                return response()->json([
                    'msg' => '정보저장성공',
                    'status' => 201,
                ], 200);
            }             // 유저에 토큰 저장
        }elseif(!$user_idx && $request->uuid){
            // 자동로그인
            $device = DeviceInfo::where('uuid', $request->uuid)->first();
            if(!$device)
            {
                return response()->json([
                    'msg' => 'uuid 없음',
                    'status' => 201,
                ], 200);
            }
            $user = User::where('id',$device->user_id)->first();
            if($user && $user->remember_token)
            {
                Auth::loginUsingId($user->idx, true);
                $request->session()->put('idx', $user->idx);
                $request->session()->put('id', $user->id);
                $request->session()->put('name', $user->name);
                $request->session()->put('level', $user->level);

                return response()->json([
                    'msg' => '로그인성공',
                    'status' => 200,
                ], 200);

            }
            return response()->json([
                'msg' => '아이디가 없거나, 기억하지 않음',
                'status' => 201,
            ], 200);
        }else{
            return response()->json([
                'msg' => '세션&ID 존재 하지 않음',
                'status' => 201,
            ], 200);
        }
    }
}
