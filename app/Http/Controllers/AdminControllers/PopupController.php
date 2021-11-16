<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\CommonControllers\ImageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Popup;

class PopupController extends Controller
{
    function getPopupList()
    {
        $data = Popup::orderBy('page', 'asc')->paginate(20);
        return view('admin.manage.popup', ['data' => $data]);
    }

    function getPopup(Request $request)
    {
        $idx = $request->idx;
        $data = Popup::where('idx',$idx)->first();
        if($request->idx)
        {
            return view('admin.manage.popup_detail', ['data' => $data, 'type' => '/api/admin/manage/popup/update', 'title' => '상세보기 및 수정']);
        }else{
            return view('admin.manage.popup_detail', ['data' => $data, 'type' => '/api/admin/manage/popup/insert', 'title' => '신규추가']);
        }
    }

    function getPopupModify(Request $request)
    {
        $idx = $request->idx;
        $data = Popup::where('idx',$idx)->first();
        if($request->idx)
        {
            return view('admin.manage.popup_modify', ['data' => $data, 'type' => '/api/admin/manage/popup/update', 'title' => '상세보기 및 수정']);
        }else{
            return view('admin.manage.popup_modify', ['data' => $data, 'type' => '/api/admin/manage/popup/insert', 'title' => '신규추가']);
        }
    }

    function insertPopup(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $popup = new Popup;
        $popup->user_idx = $user_idx;
        $popup->title = $request->title;
        $popup->content = $request->content;
        $popup->startdate = $request->startdate;
        $popup->enddate = $request->enddate;
        $popup->link_url = $request->link_url;
        $popup->order = $request->order;
        $popup->is_public = $request->is_public;
        $popup->page = $request->page;
        $popup->save();

        // 파일 업로드
        $imageController = new ImageController;
        $file_idx = $imageController->insertImageWithTable($request->file('file'), $user_idx, 'popup_tbl', $popup->idx);
        $popup->file_idx = $file_idx;
        $popup->save();

        return redirect('/admin/manage/popup')->with('alert', '신규 추가 되었습니다.');
    }

    function updatePopup(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $popup = Popup::find($request->idx);
        // 파일 업로드
        $imageController = new ImageController;
        if($request->file('file'))
        {
            $file_idx = $imageController->updateImageWithTable($request->file('file'), $user_idx, 'popup_tbl', $popup->idx, $popup->file_idx);
            $popup->file_idx  = $file_idx;
        }

        $popup->user_idx = $user_idx;
        $popup->title = $request->title;
        $popup->content = $request->content;
        $popup->startdate = $request->startdate;
        $popup->enddate = $request->enddate;
        $popup->link_url = $request->link_url;
        $popup->order = $request->order;
        $popup->is_public = $request->is_public;
        $popup->page = $request->page;
        $popup->save();
        return redirect('/admin/manage/popup_detail?idx='.$popup->idx)->with('alert', '변경되었습니다.');
    }

    // 펫 업데이트
    public function updatePopupIsPublic(Request $request)
    {
        $user = Popup::find($request->idx);
        $user->is_public = $request->is_public;
        $user->save();
        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }
    function deletePopup(Request $request)
    {
        $popup = Popup::find($request->idx);
        $popup->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }
}

