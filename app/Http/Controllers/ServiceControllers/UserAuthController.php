<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DeviceInfo;
use Illuminate\Contracts\Session\Session;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    public function login(Request $request){
        return view('main.login');
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        //$credentials = $request->only('id', 'password');
        if (Auth::attempt(['id' => $request->id, 'password' => $request->password, 'status' => 'Y'], true))
        {
            // Authentication passed...
            $user = User::where('id', $request->id)->first();
            $user->last_login_date = date('Y-m-d H:i:s');
            $user->save();
            $request->session()->put('idx', $user->idx);
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('level', $user->level);
            $request->session()->put('nickname', $user->nickname);

            if($user->is_password_change == 1) { $request->session()->put('change_pw', '임시비밀번호 입니다. 비밀번호를 변경해주세요.'); return redirect('/setting_pw');}

           // return redirect()->intended('/');
           return redirect('/');
        }
        else
        {
            $request->session()->flash('status', '아이디 혹은 비밀번호가 다릅니다.');
            return view('main.login');
        }
    }
    /**
     * 비밀번호 수정요청
     */
    function updateMyPassword(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        if($request->pw != $request->rpw)
        {
            return redirect()->back()->with('alert','비밀번호가 서로 다릅니다.');
        }else{
            User::where('idx',$user_idx)->update(['password' => bcrypt($request->pw), 'last_password_change'=>date('Y-m-d H:i'), 'is_password_change' => 0]);
            $request->session()->forget('password_hash_web');
            return redirect('/setting_account')->with('alert', '비밀번호가 변경되었습니다.');
        }
    }
    function updatePassword(Request $request)
    {
        $user_idx = $request->idx;
        if($request->pw != $request->rpw)
        {
            return redirect()->back()->with('alert','비밀번호가 서로 다릅니다.');
        }else{
            User::where('idx',$user_idx)->update(['password' => bcrypt($request->pw)]);
            $request->session()->forget('password_hash_web');
            return redirect('/login')->with('alert', '비밀번호가 변경되었습니다.');
        }
    }

    function findPasswordWithTel(Request $request)
    {
        $tel = '';
        // 인증 여부 체크
        session_start();
        if(!isset($_SESSION['phone_no']) && !isset($_SESSION['kcp_auth'])){
            return redirect()->back()->with('alert','인증이 정상적으로 처리되지 않았습니다.');
        }else{
            unset( $_SESSION['kcp_auth'] );
            $tel =  $_SESSION['phone_no'];
            // sns 아닌계정만 보여준다.
            $user = User::where('tel',$tel)->where('status','=','Y')->first();
            if($user)
            {
                if($user->is_sns == 1)
                {
                    return response()->json([
                        'msg' => 'SNS로 가입된 계정입니다.',
                        'status' => 201,
                    ], 200);
                }
                return response()->json([
                    'idx' => $user->idx,
                    'id' => $user->id,
                    'status' => 200,
                ], 200);
            }else{
                return response()->json([
                    'msg' => '가입된계정이없습니다.',
                    'status' => 201,
                ], 200);
            }

        }
    }
    function getFindPassword(Request $request)
    {
        return view('main.find_pw');
    }

    // 회원가입 요청
    public function join(Request $request){
        $nickname = $request->nickname;
        $email = $request->email;
        $password = $request->password;
        $sms_agree = $request->sms_agree ? 'Y':'N';
        $email_agree = $request->email_agree ? 'Y':'N';
        $push_agree = $request->push_agree ? 'Y':'N';
        $alimtalk_agree = $request->alimtalk_agree ? 'Y':'N';

        // 인증 여부 체크
        session_start();
        if(!isset($_SESSION['kcp_auth'])){
            return redirect()->back()->with('alert','인증이 정상적으로 처리되지 않았습니다.');
        }else{
            unset( $_SESSION['kcp_auth'] );
        }

        if(sizeof(User::where('email',$email)->get())<1) {
            User::create([
                'id' => $email,
                'nickname' => $nickname,
                'email' => $email,
                'password' => bcrypt($password),
                'sms_agree' => $sms_agree,
                'email_agree' => $email_agree,
                'push_agree' => $push_agree,
                'alimtalk_agree' => $alimtalk_agree,
                'tel' => $request->tel,
                'sex' => $request->sex,
                'name' => $request->name,
                'birth' => $request->birth
            ]);

            if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 'Y'], true))
            {
                $user = User::where('id', $email)->first();

                $alarm = collect();
                $alarm->user_idx = $user->idx;
                $alarm->sender_idx = 0;
                $alarm->url = '/my';
                $alarm->text = '';
                $appPushControllers = new AppPushControllers;
                $appPushControllers->sendSingleAppPush($alarm, 'join');

                $request->session()->put('idx', $user->idx);
                $request->session()->put('id', $user->id);
                $request->session()->put('name', $user->name);
                $request->session()->put('level', $user->level);
                $request->session()->put('nickname', $user->nickname);
                $request->session()->put('join', 1);
                return redirect('/');
            }
        }else{
            return redirect()->back()->with('alert','이미 등록된 아이디입니다.');
        }
    }
    // 앱 & 간편 회원가입
    public function joinApp(Request $request, $id){

        $sms_agree = $request->sms_agree ? 'Y':'N';
        $email_agree = $request->email_agree ? 'Y':'N';
        $push_agree = $request->push_agree ? 'Y':'N';
        $alimtalk_agree = $request->alimtalk_agree ? 'Y':'N';
        $user = User::find($id);
        if($user && $user->is_sns == 1)
        {
            // 로그인처리
            Auth::loginUsingId($user->idx,true);

            // 정보 업데이트
            $user->sms_agree = $sms_agree;
            $user->email_agree = $email_agree;
            $user->push_agree = $push_agree;
            $user->alimtalk_agree = $alimtalk_agree;
            $user->save();

            // 회원가입 축하 알림톡
            $alarm = collect();
            $alarm->user_idx = $user->idx;
            $alarm->sender_idx = 0;
            $alarm->url = '/my';
            $alarm->text = '';
            $appPushControllers = new AppPushControllers;
            $appPushControllers->sendSingleAppPush($alarm, 'join');

            $request->session()->put('idx', $user->idx);
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('level', $user->level);
            $request->session()->put('nickname', $user->nickname);
            $request->session()->put('join', 1);
            return redirect('/');
        }
        return redirect('login')->with('alert','등록된 SNS계정이 없습니다.');
    }
    public function authSessionCheck(Request $request)
    {
        // 인증 여부 체크
        return response()->json([
            'data' => $request->session()->get('user_auth'),
            'status' => 200,
        ], 200);
    }
    // 웹 카카오 로그인
    public function kakaoLogin()
    {
        return Socialite::driver('kakao')->redirect();
    }
    // 세션처리
    public function setUserSession()
    {

    }

    // 웹 카카오 로그인 콜백
    public function kakaoLoginCallback(Request $request)
    {
        $token = $this->getToken($request->code);

        // 회원 있는지 체크
        $return_url = '/';
        //  print_r($request->all());
        // print_r($request->access_token);
        if(!isset($token->access_token)){die('<script>alert("토큰이 없습니다."); location.href="/login"; </script>');}
        $user_t = $this->curl($token->access_token);

        $user_t->gender = isset($user_t->kakao_account->gender) ? $user_t->kakao_account->gender:'';
        $user_t->birthday = isset($user_t->kakao_account->birthday)  ? $user_t->kakao_account->birthday:'';
        $user_t->birthyear =  isset($user_t->kakao_account->birthyear)  ? $user_t->kakao_account->birthyear:'';
        $user_t->phone_number = isset($user_t->kakao_account->phone_number)  ? $user_t->kakao_account->phone_number:'';
        $user_t->email = isset($user_t->kakao_account->email)  ? $user_t->kakao_account->email:null;
        $name =isset($user_t->properties->nickname)  ? $user_t->properties->nickname:'';
      //  dd($user_t);
        $user = User::where('id', $user_t->id)->first();
        if($user)
        {
            if($user->status != 'Y')
            {
                die('<script>alert("정지계정이거나 탈퇴처리된 계정입니다."); location.href="/login"; </script>');
            }
            // 로그인 처리 & 세선 처리
            Auth::loginUsingId($user->idx, true);
            $request->session()->put('idx', $user->idx);
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('level', $user->level);
            $request->session()->put('nickname', $user->nickname);

            return redirect('/');
        }
        else
        {
            if(!$user_t->phone_number){ die('<script>alert("전화번호가 없습니다."); location.href="/login"; </script>');}
            // 전화번호로 가입한 유저가 있는지 체크
            $phone_number = str_replace(array("+82", "-", " "),  array("0", "", ""), $user_t->phone_number);
            $user_count = User::where('tel', $phone_number)->count();
            if($user_count != 0)
            {
                die('<script>alert("이미 가입된 전화번호입니다."); location.href="/login"; </script>');
            }
            //회원이 없을경우 신규 추가
            $user = new User;
            $user->id = $user_t->id;
            $user->email =$user_t->email;
            $user->name = $name;
            $user->nickname = $name;
            $user->sex = $user_t->gender == 'male' ? 'M':'F';
            $user->birth = $user_t->birthyear.$user_t->birthday;
            $user->tel = $phone_number;
            $user->is_sns = 1;
            $user->sns_type = 'K';
            $user->save();

            $return_url = '/join/social/'.$user->idx; //
            return redirect($return_url);
        }
    }
    function getToken($code)
    {
        $url = 'https://kauth.kakao.com/oauth/token';
        $headers = array('application/x-www-form-urlencoded;charset=utf-8');
        $body['grant_type'] = 'authorization_code';
        $CLIENT_ID = '11957eb969b57c54768c4fb033eaa8f8';
        $REDIRECT_URI = "https://dndlifecare.com/login/kakao/callback";
        $data = array(
            'grant_type'=>'authorization_code',
            'client_id'=>$CLIENT_ID,
            'redirect_uri'=>$REDIRECT_URI,
            'code'=>$code,
        );
        $data = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //POST로 보낼 데이터 지정하기
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res);
    }

    function curl($token)
    {
        $url = 'https://kapi.kakao.com/v2/user/me';
        $headers = array('Authorization:Bearer '.$token,'application/x-www-form-urlencoded;charset=utf-8');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res);
    }
    // 앱 로그인 (사용안함)
    public function getAppLogin($request)
    {
         // 회원 있는지 체크
        $return_url = '/';
      //  print_r($request->all());
       // print_r($request->access_token);
        $user_t = $this->curl($request->access_token);


        $user_t->gender = isset($user_t->user['kakao_account']['gender']) ? $user_t->user['kakao_account']['gender']:'';
        $user_t->birthday = isset($user_t->user['kakao_account']['birthday'])  ? $user_t->user['kakao_account']['birthday']:'';
        $user_t->birthyear =  isset($user_t->user['kakao_account']['birthyear'])  ? $user_t->user['kakao_account']['birthyear']:'';
        $user_t->phone_number = isset($user_t->user['kakao_account']['phone_number'])  ? $user_t->user['kakao_account']['phone_number']:'';

        $user = User::where('id', $user_t->id)->first();
        if($user)
        {
            // 로그인 처리 & 세선 처리
            Auth::loginUsingId($user->idx, true);
            $request->session()->put('idx', $user->idx);
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('level', $user->level);
            $request->session()->put('nickname', $user->nickname);
            return redirect('/');
        }
        else
        {
            // 전화번호로 가입한 유저가 있는지 체크
            $phone_number = str_replace(array("+82", "-", " "),  array("0", "", ""), $user_t['phone_number']);
            $user_count = User::where('tel', $phone_number)->count();
            if($user_count != 0)
            {
                die('<script>alert("이미 가입된 전화번호입니다."); location.href="/login"; </script>');
            }
            //회원이 없을경우 신규 추가
            $user = new User;
            $user->id = $user_t['id'];
            $user->email = $user_t['email'];
            $user->name = $user_t['name'];
            $user->nickname = $user_t['nickname'];
            $user->sex = $user_t['gender'] == 'male' ? 'M':'F';
            $user->birth = $user_t['birthyear'].$user_t['birthday'];
            $user->tel = $phone_number;
            $user->is_sns = 1;
            $user->sns_type = 'K';
            $user->save();

            $return_url = '/join/social/'.$user->idx; //
            return redirect($return_url);
        }
    }



    function deleteUser()
    {

    }

    // 로그아웃
    public function logout(Request $request)
    {
        $idx = $request->session()->get('idx');
        if($idx)
        {
            $user = User::find($idx);
            if($user->remember_token){
                $user->remember_token = null;
            }
            //로그아웃시 매핑되어있던 fcm 토큰 제거
            if($user->fcm_token){
                $fcm = DeviceInfo::where('fcm',$user->fcm_token)->first();
                if($fcm)
                {
                    $fcm->user_id = null;
                    $fcm->save();
                }
                $user->fcm_token = null;
            }
            $user->save();
        }

        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }

    function validCheck(Request $request, $id)
    {
        if($id)
        {
            $key = $id;
            $val = $request->input($key);
            $res =  User::where($key, $val)->count();
            return response()->json([
                'data' => $res,
                'status' => 200,
            ], 200);
        }
    }
}
