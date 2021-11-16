<?php

namespace App\Http\Controllers\CommonControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MentionController extends Controller
{
    // 유저 정보 요청
    public function getUserList(Request $request)
    {
        $text = $request->text;
        $data = '';
        if($text)
        {
            $data = User::select('nickname as name','idx as id', 'file_idx as avatar')
            ->selectRaw(' concat("/myfeed?user_idx=", idx) as href ')
            ->where('nickname', 'like', '%'.$text.'%')
            ->where('is_admin', '=', '0')->limit(5)
            ->get();

            return response()->json([
                'data' => $data,
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'data' => $data,
            'status' => 200,
        ], 200);

    }
}
