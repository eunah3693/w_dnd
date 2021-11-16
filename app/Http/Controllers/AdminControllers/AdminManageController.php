<?php


namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AppPush;
use App\Models\Board;
use App\Models\Config;
use App\Models\Google2faSecret;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\Border;

class AdminManageController extends Controller
{

    function getAdminList(Request $request)
    {
        $user = User::where('is_admin', 1)->get();

        return view('admin.manage.manage' , ['data' => $user]);
    }
    function getAdmin(Request $request)
    {
        if($request->idx)
        {
            $user = User::find($request->idx);
            $otp_key = Google2faSecret::where('id',$user->id)->orderBy('created_at','desc')->first();
            return view('admin.manage.manage_detail' , ['user' => $user, 'otp_key'=>$otp_key->google2fa_secret]);
        }
        return redirect('/admin/manage/manage_detail');
    }

    function getQRCode(Request $request, $id)
    {
        $user = User::find($id);
        if($user->is_admin === 1)
        {
            $google2fa = app('pragmarx.google2fa');

            $registration_data = $request->all();

            $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
            $registration_data['email'] = $user->id;

            $request->session()->flash('registration_data', $registration_data);

            // 기존 데이터 삭제 처리
            Google2faSecret::where('id',$user->id)->delete();

            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $registration_data['email'],
                $registration_data['google2fa_secret']
            );
            $otp = new Google2faSecret;
            $otp->user_idx = $id;
            $otp->id = $user->id;
            $otp->google2fa_secret = $registration_data["google2fa_secret"];
            $otp->save();
            $user->google2fa_secret = $registration_data["google2fa_secret"];
            $user->save();

            return response()->json([
                'QR_Image' => $QR_Image,
                'key' => $registration_data["google2fa_secret"],
                'status' => 200,
            ], 200);
            //return view('admin.manage.manage_2fa' , ['QR_Image' => $QR_Image, 'key' => $registration_data["google2fa_secret"]]);
        }
    }

    function getAdminModify(Request $request)
    {
        if($request->idx)
        {
            $user = User::find($request->idx);
            return view('admin.manage.manage_modify' , ['data' => $user]);
        }else{
            $user = new User;
            return view('admin.manage.manage_modify' , ['data' => $user]);
        }
        return redirect('/admin/manage/manage');
    }


    function updateAdmin(Request $request, $id)
    {
        $user = User::find($request->user_idx);
        if($id == 'pw')
        {
            $user->password = bcrypt($request->pw);
        }else if($id == 'access'){
            $access = $request->access;
            if($access){
                $access = implode( ',', $access );

                $user->access_db = $access;

            }
        }
        else{
            $user->$id = $request->$id;
        }
        $user->save();
        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }

    function insertAdmin(Request $request)
    {
        $user = new User;
        $user->password = bcrypt($request->pw);
        $user->id = $request->id;
        $user->email = $request->email;
        $user->is_admin = 1;
        $user->tel = $request->tel;
        $user->name = $request->name;
        $user->access_db = 'read';
        $user->nickname = $request->name;
        $user->save();
        return redirect('/admin/manage/manage')->with('alert', '추가되었습니다.');
    }
    function deleteAdmin(Request $request)
    {
        $user = User::find($request->user_idx);
        $user->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }

    function appSetting(Request $request)
    {
        $data = Config::orderBy('category','asc')->get();
        $data = $data->groupBy('category', true);
        return view('admin.manage.app_setting', ['data' => $data]);
    }

    function updateAppSetting(Request $request)
    {
        if($request->idx && $request->value)
        {
            $config = Config::find($request->idx);
            $config->value = $request->value;
            $config->save();
            return response()->json([
                'msg' => '변경되었습니다.',
                'status' => 200,
            ], 200);
        }
    }




    function getTermsList(Request $request)
    {
        $data = Board::whereIn('category', ['이용약관','개인정보처리방침'])->with('user')->with('admin')->orderBy('top_fixed', 'desc')->orderBy('created_at', 'desc')->latest()->paginate(20);
        return view('admin.manage.terms', ['data' => $data]);
    }

    function getTermsDetail(Request $request)
    {
        if($request->idx)
        {
            $data = Board::where('idx',$request->idx)->with('user')->first();
            return view('admin.manage.terms_detail', ['data' => $data]);
        }else{
            return redirect('/admin/manage/terms')->with('noti','페이지가 없습니다,');
        }

    }

    function getTermsModify(Request $request)
    {
        $data = new Board();
        if($request->idx)
        {
            $data = Board::where('idx', $request->idx)->with('user')->first();
            return view('admin.manage.terms_modify', ['data' => $data, 'type' => '/api/admin/terms/update', 'title' => '수정']);
        }else{
            return view('admin.manage.terms_modify', ['data' => $data, 'type' => '/api/admin/terms/insert', 'title' => '신규추가']);
        }
    }

    function insertTerms(Request $request)
    {
        $category = $request->category;
        $user_idx = $request->session()->get('idx');
        $board = new Board;
        $board->user_idx = $user_idx;
        $board->title = $request->title;
        $board->content = $request->content;
        $board->category = $category;

        $board->save();

        return redirect('/admin/manage/terms')->with('alert', '추가되었습니다.');
    }

    function updateTerms(Request $request)
    {
        $user_idx = $request->session()->get('idx');

        $board = Board::find($request->board_idx);
        if($board)
        {
            $board->title = $request->title;
            $board->content = $request->content;
            $board->save();
        }


        // 임시방편?
        return redirect('/admin/manage/terms')->with('alert', '수정되었습니다.');
    }

    function deleteTerms(Request $request, $id)
    {
        $board = Board::find($id);
        $board->delete();

        // 임시방편?
        $backUrl = preg_replace("/^.+?(\/admin\/board)\/.+?(\/.+?)\/.*$/", "$1$2", request()->headers->get('referer'));
        die('<script>alert("Deleted!"); location.href="'.$backUrl.'"; </script>');
    }


    // 알람 내용 수정
    function getAlarmTextList(Request $request){
        $data = AppPush::all();
        return view('admin.manage.alarm' , ['data' => $data]);
    }

    function setAlarmTextModify(Request $request){
        return view('admin.manage.alarm_modify');
    }
    function updateAlarmText(Request $request){

        $appPush = AppPush::find($request->idx);
        $appPush->title = $request->title;
        $appPush->body = $request->body;
        $appPush->memo = $request->memo;
        $appPush->push_column = $request->push_column;
        $appPush->save();
        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }
}
