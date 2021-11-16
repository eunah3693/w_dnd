<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class AdminPostController extends Controller
{
    //

    function setPostPublic(Request $request)
    {
        $post = Post::find($request->post_idx);
        $post->is_public = $request->is_public;
        $post->save();
        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }

    function deletePost(Request $request)
    {
        $post = Post::find($request->post_idx);
        $post->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }
}
