<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\CommonControllers\ImageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Config;

class BannerController extends Controller
{

    function getBannerList()
    {
        $data = Banner::orderBy('page', 'asc')->orderBy('position', 'asc')->paginate(20);
        return view('admin.manage.banner', ['data' => $data]);
    }

    function getBanner(Request $request)
    {
        $idx = $request->idx;
        $data = Banner::where('idx',$idx)->first();
        if($request->idx)
        {
            return view('admin.manage.banner_detail', ['data' => $data, 'config' =>  Config::get('banner'), 'type' => '/api/admin/manage/banner/update', 'title' => '상세보기 및 수정']);
        }else{
            return view('admin.manage.banner_detail', ['data' => $data, 'config' =>  Config::get('banner'), 'type' => '/api/admin/manage/banner/insert', 'title' => '신규추가']);
        }
    }

    function getBannerModify(Request $request)
    {
        $idx = $request->idx;
        $data = Banner::where('idx',$idx)->first();
        if($request->idx)
        {
            return view('admin.manage.banner_modify', ['data' => $data, 'config' =>  Config::get('banner'), 'type' => '/api/admin/manage/banner/update', 'title' => '상세보기 및 수정']);
        }else{
            return view('admin.manage.banner_modify', ['data' => $data, 'config' =>  Config::get('banner'), 'type' => '/api/admin/manage/banner/insert', 'title' => '신규추가']);
        }
    }

    function insertBanner(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $banner = new Banner;
        $banner->user_idx = $user_idx;
        $banner->title = $request->title;
        $banner->content = $request->content;
        $banner->startdate = $request->startdate;
        $banner->enddate = $request->enddate;
        $banner->link_url = $request->link_url;
        $banner->order = $request->order;
        $banner->is_public = $request->is_public;
        $page_postition = array();
        $page_postition = explode('_', $request->page_position);
      // print_r($page_postition);die();
        $banner->page = $page_postition[0];
        $banner->position = $page_postition[1];
        $banner->save();

        // 파일 업로드
        $imageController = new ImageController;
        $file_idx = $imageController->insertImageWithTable($request->file('file'), $user_idx, 'banner_tbl', $banner->idx);
        $banner->file_idx = $file_idx;
        $banner->save();

        return redirect('/admin/manage/banner')->with('alert', '신규 추가 되었습니다.');
    }

    function updateBanner(Request $request)
    {
        $user_idx = $request->session()->get('idx');
        $banner = Banner::find($request->idx);
        // 파일 업로드
        $imageController = new ImageController;
        if($request->file('file'))
        {
            $file_idx = $imageController->updateImageWithTable($request->file('file'), $user_idx, 'banner_tbl', $banner->idx, $banner->file_idx);
            $banner->file_idx  = $file_idx;
        }

        $banner->user_idx = $user_idx;
        $banner->title = $request->title;
        $banner->content = $request->content;
        $banner->startdate = $request->startdate;
        $banner->enddate = $request->enddate;
        $banner->link_url = $request->link_url;
        $banner->order = $request->order;
        $banner->is_public = $request->is_public;
        $page_postition = array();
        $page_postition = explode('_', $request->page_position);
        $banner->page = $page_postition[0];
        $banner->position = $page_postition[1];
        $banner->save();
        return redirect('/admin/manage/banner_detail?idx='.$banner->idx)->with('alert', '변경되었습니다.');
    }

    // 펫 업데이트
    public function updateBannerIsPublic(Request $request)
    {
        $user = Banner::find($request->idx);
        $user->is_public = $request->is_public;
        $user->save();
        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }
    function deleteBanner(Request $request)
    {
        $banner = Banner::find($request->idx);
        $banner->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }
}
