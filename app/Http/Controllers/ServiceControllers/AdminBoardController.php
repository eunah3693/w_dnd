<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Board;

class AdminBoardController extends Controller
{
	public function index(Request $request)
    {
        die('?');
    }
    
    public function toggleVisible(Request $request, $id)
    {
        Board::find($id)->update(['hidden' => DB::raw('hidden ^ 3')]);
        return response()->json(['data'=>'0'], 200);
    }
}
