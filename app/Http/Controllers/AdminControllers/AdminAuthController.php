<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        // $request->user_idx = 1;
        // $request->sender_idx = 6;
        // $request->url = '/';
        // $appPushControllers = new AppPushControllers;
        // $appPushControllers->sendSingleAppPush($request, 'post_reply');
        if (Auth::attempt(['id' => $request->id , 'password' => $request->password, 'is_admin' => 1]))
        {
            // Authentication passed...
            $admin = User::where('id', $request->id)->first();

            $request->session()->put('idx', $admin->idx);
            $request->session()->put('id', $admin->id);
            $request->session()->put('name', $admin->name);
            $request->session()->put('nickname', $admin->nickname);
            $request->session()->put('level', $admin->access_level);
            $request->session()->put('is_admin', true);

            if($admin->status != 'Y'){
                return redirect('/admin')->with('status', '정지 혹은 탈퇴 회원입니다. 관리자에게 문의하세요.');
            }
            if($admin->is_password_change == 1) return redirect('/admin/user/pw');

            return redirect('/admin/index');
        }
        else
        {
            return redirect('/admin')->with('status', '아이디 혹은 비밀번호를 확인해주세요.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/admin');
    }

    public function register(Request $request)
    {
        return view('admin.main');
    }
}
