<?php

namespace App\Http\Controllers\AdminControllers;

use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserInsertRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\LogExp;
use App\Models\Pets;
use App\Models\Post;
use App\Models\Treat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserViewController extends Controller
{

    public function insertUser(UserInsertRequest $request)
    {
        $request = $request->validated();
        $request = array_filter($request);
        $user = new User;
        foreach($request as $key => $value)
        {
            $user->$key = $request[$key];
        }
        $user->save();

        return redirect('user')->with('status', 'Profile inserted!');
    }

    public function updateuser(UserUpdateRequest $request)
    {
        $request = $request->validated();
        $request = array_filter($request);
        $user = User::find($request['idx']);
        foreach($request as $key => $value)
        {
            $user->$key = $request[$key];
        }
        $user->save();
        return redirect('user')->with('status', 'Profile updated!');
    }

    public function deleteuser(UserUpdateRequest $request)
    {
        $request = $request->validated();
        $request = array_filter($request);
        $user = User::find($request['idx']);
        $user->delete();
        return redirect('user')->with('status', 'Profile deleted!');
    }

    // 회원정보리스트
    public function getUserList(Request $request)
    {
        DB::enableQueryLog();
        $users = User::select('*')->selectRaw('(SELECT sum(treat) FROM treat_tbl WHERE user_idx = user_tbl.idx) as total_treat')->where('is_admin', 0)->orderBy('created_at', 'desc')->paginate(20);
        $total_users = User::where('is_admin', 0)->orderBy('created_at', 'desc')->count();// 총회원수
        $today_join = User::where('is_admin', 0)->whereDate('created_at','>=', date('Y-m-d').' 00:00:00' )->orderBy('created_at', 'desc')->count();// 금일 가입수
        $today_login = User::where('is_admin', 0)->where('last_login_date','>=', date('Y-m-d').' 00:00:00' )->orderBy('created_at', 'desc')->count();/// 금일 접속자수
        $total_deactivate = User::where('is_admin', 0)->where('status','D')->orderBy('created_at', 'desc')->count();/// 탈퇴자수
        //dd(DB::getQueryLog());
        if($request->input())
        {
            $query = User::select('*')->selectRaw('(SELECT sum(treat) FROM treat_tbl WHERE user_idx = user_tbl.idx) as total_treat')->where('is_admin', 0)->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $users = $query->paginate(20);
        }

        return view('admin.member.member', ['user' => $users, 'total_user' => $total_users, 'today_join' => $today_join,'today_login' => $today_login,'deactivate' => $total_deactivate ]);
    }

    // 회원 정보 디테일
    public function getUser(Request $request)
    {
        $user = User::find($request->user_idx);
        if(!$user)
        {
            return redirect('/admin/member/member');
        }
        $pet = Pets::where('user_idx',$request->user_idx)->get();
        $treat = Treat::where('user_idx',$request->user_idx)->paginate(15,['*'],'t_page');
        $logexp = LogExp::where('user_idx',$request->user_idx)->paginate(15,['*'],'l_page');
        $post = Post::where('user_idx',$request->user_idx)->where('status',2)->with('mission')->with('files')->with('like')->paginate(15,['*'],'p_page');
        $post_reply = Post::where('user_idx',$request->user_idx)->whereNotNull('parent_idx')->paginate(15,['*'],'r_page');
        return view('admin.member.member_detail', ['user' => $user, 'pet' => $pet, 'treat' => $treat,'logexp' => $logexp,'post' => $post, 'post_reply'=>$post_reply ]);
    }

    // 관리자 비밀번호 변경 (본인)
    public function setUserPasswordWithAdmin(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $user = User::find($user_idx );
        if($request->pw != $request->r_pw)
        {
            return redirect()->back()->with('status', '비밀번호가 서로 다릅니다.');
        }
        $user->password = bcrypt($request->pw);
        $user->is_password_change = 0;
        $user->last_password_change = date('Y-m-d H:i:s');
        $user->save();

        return redirect('/admin/index')->with('alert', '변경되었습니다.');
    }

    // 유저 비번변경
    public function setUserPassword(Request $request)
    {
        $user = User::find($request->user_idx);
        $user->password = bcrypt($request->pw);
        $user->is_password_change = 1;
        $user->save();

        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }

    // 유저 컬럼 업데이트
    public function setUserUpdate(Request $request, $id)
    {
        $user = User::find($request->user_idx);
        $user->$id = $request->$id;
        $user->save();
        return redirect()->back()->with('alert','변경되었습니다.');
    }

    // 펫 리스트
    public function getPets(Request $request)
    {
        $pet = Pets::with('user')->orderBy('created_at', 'desc')->paginate(20);
        $total_pet = Pets::count();
        $today_pet = User::whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();// 금일 팻 등록수
        //dd(DB::getQueryLog());
        if($request->input())
        {
            $query = Pets::select('*')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $pet = $query->paginate(20);
        }
        return view('admin.member.animal', ['pets' => $pet, 'total_pet' => $total_pet, 'today_pet' => $today_pet ]);
    }

    // 펫 디테일
    public function getPetDetail(Request $request)
    {
        if($request->pet_idx)
        {
            $pet = Pets::with('user')->where('idx',$request->pet_idx)->first();

            return view('admin.member.animal_detail', ['pet' => $pet]);
        }
        return redirect('/admin/member/animal');
    }

    // 펫 디테일
    public function getPetsModify(Request $request)
    {
        if($request->pet_idx)
        {
            $pet = Pets::with('user')->where('idx',$request->pet_idx)->first();

            return view('admin.member.animal_modify', ['pet' => $pet, 'type' => '수정', 'url'=>'/api/admin/pet/update']);
        }else{
            $pet = new Pets;
            return view('admin.member.animal_modify', ['pet' => $pet, 'type' => '추가', 'url'=>'/api/admin/pet/insert']);
        }
    }

    // 펫 생성
    public function setPetInsert(Request $request){
        if($request->pet_idx)
        {
            $pet = Pets::find($request->pet_idx);
        }else{
            $pet = new Pets;
        }
        $pet->user_idx = $request->user_idx;
        $pet->name = $request->name;
        $pet->breed = $request->breed;
        $pet->birth = $request->birth;
        $pet->memo = $request->memo;
        $pet->save();
        return redirect('/admin/member/animal_detail?pet_idx='.$pet->idx)->with('alert','변경/추가되었습니다.');
    }
    // 펫 삭제
    public function setPetDelete(Request $request)
    {
        $pet = Pets::find($request->pet_idx);
        $pet->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }

    // 펫 업데이트
    public function setPetUpdate(Request $request, $id)
    {
        $user = Pets::find($request->user_idx);
        $user->$id = $request->$id;
        $user->save();
        return redirect()->back()->with('alert','변경되었습니다.');
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
                        $text = '%'.$request['text'].'%';
                        if( $request['text'] )
                        {
                            $query->where($value, 'like' , $text);
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

    public function userExport(Request $request)
    {
        return Excel::download(new UserExport($request->input()), 'user_list_'.date('Y-m-d').'.xlsx');
    }

    public function userImport(Request $request)
    {
        $import = new UsersImport;
        Excel::import($import, $request->file('file')->store('temp'));
        return response()->json([
            'data' => $import->userList(),
            'status' => 200,
        ], 200);
    }


    // 트릿 리스트
    public function getTreat(Request $request)
    {
        $treat = Treat::with('user')->orderBy('created_at', 'desc')->paginate(20);
        $total = Treat::count();
        $today = Treat::whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();// 금일 팻 등록수
        //dd(DB::getQueryLog());
        if($request->input())
        {
            $query = Treat::select('*')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $today = $query->paginate(20);
        }
        return view('admin.member.treat', ['treat' => $treat, 'total' => $total, 'today_t' => $today ]);
    }

    // 상세
    public function getTreatDetail(Request $request)
    {
        if($request->treat_idx)
        {
            $treat = Treat::with('user')->where('idx',$request->treat_idx)->first();

            return view('admin.member.treat_detail', ['treat' => $treat]);
        }
        return redirect('admin/member/treat');
    }

    // 수정
    public function getTreatModify(Request $request)
    {
        if($request->treat_idx)
        {
            $treat = Treat::with('user')->where('idx',$request->treat_idx)->first();

            return view('admin.member.treat_modify', ['treat' => $treat, 'type' => '수정', 'url'=>'/api/admin/treat/update']);
        }else{
            $treat = new Treat;
            return view('admin.member.treat_modify', ['treat' => $treat, 'type' => '추가', 'url'=>'/api/admin/treat/insert']);
        }
    }

    // 생성 및 수정
    public function setTreatInsert(Request $request){
        if($request->treat_idx)
        {
            $treat = Treat::find($request->treat_idx);
        }else{
            $treat = new Treat;
        }
        $treat->treat = $request->treat;
        $treat->memo = $request->memo;
        $treat->user_idx = $request->user_idx;
        $treat->save();
        return redirect('/admin/member/treat_detail?treat_idx='.$treat->idx)->with('alert','변경/추가되었습니다.');
    }
    // 삭제
    public function setTreatDelete(Request $request)
    {
        $treat = Treat::find($request->treat_idx);
        $treat->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }




    // 경험치 리스트
    public function getLogExp(Request $request)
    {
        $exp = LogExp::with('user')->orderBy('created_at', 'desc')->paginate(20);
        $total = LogExp::count();
        $today = LogExp::whereDate('created_at','>=',date('Y-m-d').' 00:00:00')->count();// 금일 팻 등록수
        //dd(DB::getQueryLog());
        if($request->input())
        {
            $query = LogExp::select('*')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $exp = $query->paginate(20);
        }
        return view('admin.member.level', ['exp' => $exp, 'total' => $total, 'today_t' => $today ]);
    }

    // 상세
    public function getLogExpDetail(Request $request)
    {
        if($request->exp_idx)
        {
            $exp = LogExp::with('user')->where('idx',$request->exp_idx)->first();

            return view('admin.member.level_detail', ['exp' => $exp]);
        }
        return redirect('admin/member/level');
    }

    // 수정
    public function getLogExpModify(Request $request)
    {
        if($request->exp_idx)
        {
            $exp = LogExp::with('user')->where('idx',$request->exp_idx)->first();

            return view('admin.member.level_modify', ['exp' => $exp, 'type' => '수정', 'url'=>'/api/admin/exp/update']);
        }else{
            $exp = new LogExp;
            return view('admin.member.level_modify', ['exp' => $exp, 'type' => '추가', 'url'=>'/api/admin/exp/insert']);
        }
    }

    // 생성 및 수정
    public function setLogExpInsert(Request $request){
        if($request->exp_idx)
        {
            $exp = LogExp::find($request->exp_idx);
        }else{
            $exp = new LogExp;
        }
        $exp->exp = $request->exp;
        $exp->memo = $request->memo;
        $exp->user_idx = $request->user_idx;
        $exp->save();
        return redirect('/admin/member/level_detail?exp_idx='.$exp->idx)->with('alert','변경/추가되었습니다.');
    }
    // 삭제
    public function setLogExpDelete(Request $request)
    {
        $exp = LogExp::find($request->exp_idx);
        $exp->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }
}
