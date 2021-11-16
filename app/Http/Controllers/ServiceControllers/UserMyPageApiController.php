<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\CommonControllers\ImageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\DeviceInfo;
use App\Models\EventReview;
use App\Models\Files;
use App\Models\Order;
use App\Models\Pets;
use App\Models\Post;
use App\Models\Treat;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use  Intervention\Image\Facades\Image;

class UserMyPageApiController extends Controller
{
    /**
     * 내정보 수정요청
     * @param myfeed_contents   // 피드 소개글
     * @param file              // 파일 이미지
     */
    function updateMyPage(Request $request)
    {
        $user_idx = $request->session()->get('idx');

        $user = User::find($user_idx);

        // 마이피드 글 업데이트
        if(Arr::exists($request, 'myfeed_contents')){
            $user->my_feed = $request->myfeed_contents;
        }
        if(Arr::exists($request, 'nickname')){
            $user->nickname = $request->nickname;
        }
        // 사진 업데이트가 있을경우 이미지를 업데이트 해줌
        if($request->file('file')){
            // 파일 업로드
            $imageController = new ImageController;
            $file_idx = $imageController->updateImageWithTable($request->file('file'), $user_idx, 'user_tbl', $user->idx, $user->file_idx);
            $user->file_idx = $file_idx;
        }

        $user->save();
        return redirect('/setting_account')->with('alert','변경되었습니다.');
    }

    /**
     * 펫 정보 추가 요청
     */
    function insertMyPet(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $pet_count = Pets::where('user_idx',$user_idx)->count();
        if($pet_count >= 3)
        {
            return redirect('/my')->with('alert','최대 세마리만 등록이 가능합니다.');
        }
        $pet = new Pets;
        $pet->user_idx =$user_idx;
        $pet->name = $request->name;
        $pet->breed = $request->breed;
        $pet->sex = $request->sex;
        $pet->birth = $request->birth;
        $pet->memo = $request->memo;

        // 사진 업데이트가 있을경우 이미지를 업데이트 해줌
        if($request->file('file')){
            $imageController = new ImageController;
            $file_idx = $imageController->insertImageWithTable($request->file('file'), $user_idx, 'pet_tbl', $pet->idx);
            $pet->file_idx = $file_idx;
        }
        $pet->save();
        return redirect('/my')->with('alert','펫을 추가하였습니다.');
    }

    /**
     * 펫정보 수정 요청
     */
    function updateMyPet(Request $request)
    {
        $user_idx = $request->session()->get('idx');

        $pet = Pets::find($request->pet_idx);

        // $main_pet = Pets::where('user_idx', $user_idx)->where('is_main', 1)->get();
        // // 메인 펫이 있을경우 업데이트
        // if($main_pet)
        // {
        //     if($request->is_mian == 1) Pets::where('user_idx', $user_idx)->where('is_main', 1)->update('is_main', 0);
        //     $pet->is_mian = $request->is_mian;
        // }
        // else
        // {
        //     $pet->is_mian = 1; // 메인펫이 없을 경우 무조건 메인펫
        // }

        $pet->name = $request->name;
        $pet->breed = $request->breed;
        $pet->birth = $request->birth;
        $pet->memo = $request->memo;
        $pet->sex = $request->sex;

        // 사진 업데이트가 있을경우 이미지를 업데이트 해줌
        if($request->file('file')){
            $imageController = new ImageController;
            $file_idx = $imageController->updateImageWithTable($request->file('file'), $user_idx, 'pet_tbl', $pet->idx, $pet->file_idx);
            $pet->file_idx = $file_idx;
        }
        $pet->save();
        return redirect('/mypet?idx='.$request->pet_idx)->with('alert','변경되었습니다.');
        return response()->json([
            'msg' => '펫을 수정했습니다.',
            'status' => 200,
        ], 200);
    }

    /**
     * 펫정보 삭제 요청
    */
    function deleteMyPet(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $pet_idx = $request->pet_idx;

        $old_files = Files::where([['user_idx',$user_idx],['table_idx',$pet_idx],['table_name','pet_tbl']])->get();
        if($old_files)
        {
            foreach($old_files as $f)
            {
                Storage::delete('public/'.$f->real_path);
                Storage::delete('public/thumbnail/'.$f->real_path.'.png');
                $f->delete();
            }
        }
        $pet = Pets::find($pet_idx);
        $pet->delete();
        return response()->json([
            'msg' => '펫을 삭제했습니다.',
            'status' => 200,
        ], 200);
    }
    /**
     * 리뷰 작성 요청
     */
    function setMyReiview(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        if($request->review_idx){
            //수정
            $review = EventReview::find($request->review_idx);
            $review->user_idx = $user_idx;
            $review->content = $request->content;
            $review->score = $request->score;

            if($request->file('file'))
            {   // 파일 업로드
                $imageController = new ImageController;
                $file_idx = $imageController->updateImageWithTable($request->file('file'), $user_idx, 'event_review_tbl', $review->idx, $review->file_idx);
                $review->file_idx  = $file_idx;
            }
            $review->save();
        }else{
            //신규
            $review = new EventReview;
            $review->user_idx = $user_idx;
            $review->order_idx = $request->order_idx;
            $review->event_idx = $request->event_idx;
            $review->content = $request->content;
            $review->score = $request->score;
            $review->save();
            if($request->file('file'))
            {
                // 파일 업로드
                $imageController = new ImageController;
                $file_idx = $imageController->insertImageWithTable($request->file('file'), $user_idx, 'event_review_tbl', $review->idx);
                $review->file_idx  = $file_idx;
                $review->save();
            }
        }
        return redirect('/myhistory')->with('alert','리뷰를 작성하였습니다.');
    }

    /**
     * 이벤트  당첨 - 배송정보 작성 요청
     */
    function updateMyEventdelivery(Request $request)
    {
        $order = Order::find($request->order_idx);
        $order->name = $request->name;
        $order->tel = $request->tel;
        $order->email = $request->email;
        $order->msg = $request->msg;
        $order->zip = $request->zip;
        $order->addr1 = $request->addr1;
        $order->addr2 = $request->addr2;
        $order->save();

        return response()->json([
            'msg' => '배송정보를 업데이트 했습니다.',
            'status' => 200,
        ], 200);
    }

    /**
     * 이용문의 삽입 요청
     */
    function insertMyQna(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $board = new Board;
        $board->category = '이용문의';
        $board->title = $request->title;
        $board->content = $request->content;
        $board->user_idx = $user_idx;
        $board->save();
        return response()->json([
            'msg' => '정상적으로 처리되었습니다.',
            'status' => 200,
        ], 200);
    }

    /**
     * 앱 푸쉬, SMS, 광고성 정보 등 설정
     * config_key : 컬럼명
     * config_val : Y, N
     */
    function updateMyConfig(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        if(Arr::exists($request, 'config_key'))
        {
            switch ($request->config_key) {
                case 'push_like':
                case 'push_reply':
                case 'push_event':
                    User::where('idx',$user_idx)->update([$request->config_key => $request->config_val]);
                    break;
                default:
                    User::where('idx',$user_idx)->update(
                        [$request->config_key => $request->config_val],
                        [$request->config_key.'_date' => date('Y-m-d H:i:s')]
                    );
                    break;
            }
        }

    }
    /**
     * 트릿로그 요청
     */
    function getTreatList(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $treat = Treat::where('user_idx',$user_idx)->latest()->paginate(10);
        return response()->json([
            'data' => $treat,
            'status' => 200,
        ], 200);
    }

    /**
     *  펫 수량
     * */
    function getUserPetsCount(Request $request) {
    	$user_idx = $request->session()->get('idx');

    	$pets = User::join('pet_tbl','user_tbl.idx', '=','pet_tbl.user_idx')
    	->where('user_tbl.idx', '=', $user_idx)
    	->select('pet_tbl.name as petname','user_tbl.name as username')
    	->get();

    	return response()->json([
    			'count' => count($pets),
    			'status' => 200,
    	], 200);
    }

    public function resizeImage(String $file_path)
    {
        $img = Image::make(storage_path('app/public/'.$file_path));

        $width = $img->width();
        $img->orientate();
        $img->resize(min($width, 1080), null, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->save(storage_path('app/public/'.$file_path))

        ->resize(min($width, 360), null, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->save(storage_path('app/public/thumbnail/'.$file_path.'.png'));
    }
    // 포스트 주성
    public function updatePost(Request $request)
    {
        $user_idx = Auth::id();
        if($request->post_idx)
        {
            $total_point = 0;
             // 태그 변환
            $content = $this->getTagChange($request->content);
            // 포스트 저장
            $post = Post::find($request->post_idx);
            $pet_idx = implode( ', ', $request->pet_idx);
            $post->pet_idx = $pet_idx;
            $post->content = $content;
            $post->save();
        }
        // 삭제 파일이 있을경우 파일 삭제
        $delete_idx = explode( ',', $request->delete_idx);
        foreach($delete_idx as $d)
        {
            //;
            $file = Files::find($d);
            if($file && Storage::exists('public/'.$file->real_path))
            {
                Storage::delete('public/'.$file->real_path);
                Storage::delete('public/thumbnail/'.$file->real_path.'.png');
                $file->delete();
            }
        }


        return redirect('/myfeed')->with('alert','업로드하였습니다.');
    }

    function getTagChange($text)
    {
        $result = preg_replace('/#([\d|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣|\_]+)/' , '<a href="/newsfeed?tag[]=${1}" class="hash-tag">${1}</a>', $text);
        return $result;
    }

    // 피드 삭제
    function deleteMyPost(Request $request, $id)
    {
        $user_idx = Auth::id();
        $post = Post::find($id);
        if($post && $post->user_idx == $user_idx)
        {
            // 파일 삭제
            $files = Files::where(['table_name' => 'post_tbl'])->where( ['table_idx' => $post->idx ])->where( ['user_idx' => $user_idx ])->get();
            foreach($files as $file)
            {
                Storage::delete('public/'.$file->real_path);
                Storage::delete('public/thumbnail/'.$file->real_path.'.png');
                $file->delete();
            }

            // 컨텐츠 댓글 삭제
            Post::where('parent_idx', $post->idx)->delete();


            // 게시물 삭제
            $post->delete();

            return redirect('/myfeed')->with('alert','삭제되었습니다.');
        }
        return redirect()->back();
    }

    // 계정 탈퇴
    function deleteUser(Request $request)
    {
        $user_idx = Auth::id();
        $user = User::find($user_idx);
        // 관리자일경우
        if($user->is_admin){ return redirect('/setting_account')->with('alert','관리자는 탈퇴가 불가능합니다. 해당 당담자에게 문의주세요.'); }
        //sns 계정이 아닐경우 비밀번호 체크
        if($user->is_sns != 1 && !Hash::check($request->pw, $user->password)){ return redirect()->back()->with('alert','비밀번호가 다릅니다.'); }
        // 상태 변경
        $user->status = 'D';
        $user->out_reason = '#탈퇴사유: '. $request->text1 .' #개선사항: ' . $request->text2;
        $user->out_date = date('Y-m-d');
        $user->save();

        if($user->remember_token){$user->remember_token = null;}
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

        Auth::logout(); // 인증 로그아웃
        $request->session()->flush(); // 세션 삭제
        return redirect('/login')->with('alert','탈퇴처리되었습니다.');
    }
}
