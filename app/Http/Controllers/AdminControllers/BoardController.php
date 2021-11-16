<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonControllers\ImageController;
use Illuminate\Support\Facades\DB;

use App\Models\Board;
use App\Models\User;

class BoardController extends Controller
{

    private $BOARD_CATEGORY;

    function __construct()
    {
        $this->BOARD_CATEGORY = collect([
            [ 'name' => '공지사항', 'key' => 'notice'],
            [ 'name' => '이용문의', 'key' => 'ask'],
            [ 'name' => '자주하는질문', 'key' => 'frequently_ask'],
            [ 'name' => '이벤트', 'key' => 'event'],
            [ 'name' => '이용안내', 'key' => 'guide'],
            [ 'name' => '펫시피', 'key' => 'pet'],
            [ 'name' => '이용약관', 'key' => 'main_top'],
            [ 'name' => '개인정보처리방침', 'key' => 'main_top']
        ]);
    }

    function getBoardList(Request $request, $id)
    {
        $category = $this->BOARD_CATEGORY->firstWhere('key', $id);

        $data = Board::where('category', $category['name'])->with('user')->with('admin')->orderBy('top_fixed', 'desc')->orderBy('created_at', 'desc')->latest()->paginate(20);
        $ttcnt = Board::where('category', $category['name'])->count();
        $tdcnt = Board::where([['category', '=', $category['name']],['created_at', 'like', date('Y-m-d').'%']])->count();

        if($request->input())
        {
            $query = Board::orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $data = $query->paginate(20);
        }

        return view('admin.board.'.$id, ['data' => $data, 'category' => $id, 'total_count' => $ttcnt, 'today_count' => $tdcnt]);
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
                    case 'search':
                        if( $value == 'user_id'){
                            $user = User::where('id',$request['text'] )->first();
                            if($user)$query->where('user_idx', '=' , $user->idx);
                            else $query->where('user_idx', '=' , 0);
                        }else{
                            $text = '%'.$request['text'].'%';
                            if( $request['text'] )
                            {
                                $query->where($value, 'like' , $text);
                            }
                        }

                        break;
                    case 'text':
                        break;
                    default :
                        $query->where($key, '=', $value);
                }

            }
        }
        return $query;
    }

    function getBoard(Request $request, $id)
    {
        $data = Board::where('idx',$request->idx)->with('user')->first();
        return view('admin.board.'.$id.'_one', ['data' => $data]);
    }

    function getBoardDetail(Request $request, $id)
    {
        if($request->idx)
        {
            $data = Board::where('idx',$request->idx)->with('user')->first();
            return view('admin.board.'.$id.'_detail', ['data' => $data, 'id' => $id]);
        }else{
            return redirect('/admin/board/'.$id)->with('noti','페이지가 없습니다,');
        }

    }

    function getBoardModify(Request $request, $id, $idx = null)
    {
        $data = new Board;
        if($idx)
        {
            $data = Board::where('idx', $idx)->with('user')->first();
            return view('admin.board.'.$id.'_modify', ['data' => $data, 'type' => '/admin/board/update/', 'title' => '수정']);
        }else{
            return view('admin.board.'.$id.'_modify', ['data' => $data, 'type' => '/admin/board/insert/'.$id, 'title' => '신규추가']);
        }
    }

    function insertBoard(Request $request, $id)
    {
        $category = $this->BOARD_CATEGORY->firstWhere('key', $id);
        $user_idx = $request->session()->get('idx');
        $board = new Board;
        $board->user_idx = $user_idx;
        $board->title = $request->title;
        $board->content = $request->content;
        $board->category = $category['name'];
        $board->sub_title = $request->sub_title;
        $board->top_fixed = $request->top_fixed ?? 0;
        $board->link_url = $request->link_url;
        $board->startdate = $request->startdate;
        $board->enddate = $request->enddate;
        $board->order = $request->order ?? 0;
        $board->hidden = $request->hidden ?? 'N';

        $board->save();

        if($request->file('main_file')){
            $imageController = new ImageController;
            $file_idx = $imageController->insertImageWithTable($request->file('main_file'), $user_idx, 'board_tbl', $board->idx);
            $board->main_file_idx = $file_idx;
        }

        if($request->file('thum_file')){
            $imageController = new ImageController;
            $file_idx = $imageController->insertImageWithTable($request->file('thum_file'), $user_idx, 'board_tbl', $board->idx);
            $board->thum_file_idx = $file_idx;
        }

        $board->save();

        // 임시방편?
        $backUrl = preg_replace("/^.+?(\/admin\/board)\/.+?(\/.+?)(\/.*)?$/", "$1$2", request()->headers->get('referer'));
        die('<script>alert("Inserted!"); location.href="'.$backUrl.'"; </script>');
    }

    function updateBoard(Request $request, $id)
    {
        $user_idx = $request->session()->get('idx');
        $board = Board::find($id);
        if($request->content2 ?? false) {
            $board->user_idx2 = $user_idx;
        } else {
        	$board->user_idx = $user_idx;
        }
        $board->title = $request->title;
        $board->content = $request->content;
        $board->content2 = $request->content2;
        if($request->content2 ?? false) {
            $board->answered_at = DB::raw('now()');
            $alarm = collect();
            $alarm->user_idx = $board->user_idx;
            $alarm->sender_idx =  $user_idx;
            $alarm->url = '/myqna';
            $alarm->text = $request->content2;
            $appPushControllers = new AppPushControllers;
            $appPushControllers->sendSingleAppPush($alarm, 'myqna');
        }
        $board->sub_title = $request->sub_title;
        $board->top_fixed = $request->top_fixed ?? 0;
        $board->link_url = $request->link_url;
        $board->startdate = $request->startdate;
        $board->enddate = $request->enddate;
        $board->order = $request->order ?? 0;
        $board->hidden = $request->hidden ?? 'N';

        if($request->file('main_file')){
            $imageController = new ImageController;
            if($board->main_file_idx) {
            	$file_idx = $imageController->updateImageWithTable($request->file('main_file'), $user_idx, 'board_tbl', $board->idx, $board->main_file_idx);
            } else {
                $file_idx = $imageController->insertImageWithTable($request->file('main_file'), $user_idx, 'board_tbl', $board->idx);
            }
            $board->main_file_idx = $file_idx;
        }

        if($request->file('thum_file')){
            $imageController = new ImageController;
            if($board->thum_file_idx) {
            	$file_idx = $imageController->updateImageWithTable($request->file('thum_file'), $user_idx, 'board_tbl', $board->idx, $board->thum_file_idx);
            } else {
            	$file_idx = $imageController->insertImageWithTable($request->file('thum_file'), $user_idx, 'board_tbl', $board->idx);
            }
            $board->thum_file_idx = $file_idx;
        }

        $board->save();

        // 임시방편?
        $backUrl = preg_replace("/^.+?(\/admin\/board)\/.+?(\/.+?)\/.*$/", "$1$2", request()->headers->get('referer'));
        die('<script>alert("Updated!"); location.href="'.$backUrl.'"; </script>');
    }

    function deleteBoard(Request $request, $id)
    {
        $board = Board::find($id);
        $board->delete();

        // 임시방편?
        $backUrl = preg_replace("/^.+?(\/admin\/board)\/.+?(\/.+?)\/.*$/", "$1$2", request()->headers->get('referer'));
        die('<script>alert("Deleted!"); location.href="'.$backUrl.'"; </script>');
    }
}
