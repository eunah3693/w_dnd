<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use App\Http\Controllers\CommonControllers\ImageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marketing;

class MarketingController extends Controller
{
    function appPush(Request $request)
    {
        $user_idx = $request->session()->get('idx');

        $marketing = new Marketing;
        $marketing->title = $request->title;
        $marketing->content = $request->content;
        $marketing->category = '앱푸쉬';
        if($request->user_list){ $users = explode(',',$request->user_list); }
        $marketing->count = count($users);
        $marketing->save();

        if($request->file('file'))
        {
            $imageController = new ImageController;
            $file_idx = $imageController->insertImageWithTable($request->file('file'), $user_idx, 'marketing_tbl', $marketing->idx);
        }
        $msg = array();
        $msg['title'] = $request->title;
        $msg['body'] = $request->content;
        $msg['image'] = 'https://dndlifecare.com/files/'.$file_idx;

        $appPushControllers = new AppPushControllers;
        foreach ($users as $key => $user) {
            $appPushControllers->sendAdminAppPush($user, $msg, $marketing->idx);
        }
        return redirect('/admin/marketing/marketing_detail?idx='.$marketing->idx)->with('alert', '신규 추가 되었습니다.');
    }

    function getMarketingList(Request $request)
    {
        $query = Marketing::with('user')->orderBy('created_at', 'desc');

        //dd(DB::getQueryLog());
        if($request->category)
        {
            $query = $query->where('category', '=', $request->category);
        }
        if($request->search)
        {
            $text = '%'.$request->text.'%';
            if( $request->text )
            {
                $query->where($request->search, 'like' , $text);
            }
        }
        $marketing = $query->paginate(20);

        return view('admin.marketing.marketing_list', ['data' => $marketing]);
    }

    function getMarketingDetail(Request $request)
    {
        $marketing = Marketing::with('user')
        ->with('appPush')
        ->with('file')
        // ->with('mail')
        // ->with('alarmTalk')
        // ->with('sms')
        ->where('idx', $request->idx)->first();
        if($marketing)
        {
            return view('admin.marketing.marketing_detail', ['data' => $marketing]);
        }
        return redirect('/admin/marketing/marketing_list');
    }
}
