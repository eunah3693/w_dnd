<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LogController extends Controller
{

    function getLog(Request $request){

        $list = DB::table('__log_'.date('Ym').'_tbl')->orderBy('idx','desc')->paginate(20);
        $col = Schema::getColumnListing('__log_'.date('Ym').'_tbl');
       // dd($col);
        switch ($request->table_name) {
            case 'log':
                if($request->id)
                {
                    $date = explode('-',$request->id);
                    $log_table = '__log_'.$date[0].$date[1].'_tbl';
                    if(Schema::hasTable($log_table)) {
                        $list = DB::table('__log_'.$date[0].$date[1].'_tbl');
                        if($date[2]) $list->whereDate('created_at',$request->id);
                        $list = $list->orderBy('idx','desc')->paginate(20);
                    }
                    $col = Schema::getColumnListing($log_table);
                }
                break;
            case 'log_app_push_tbl':
            case 'log_exp_tbl':
                $list = DB::table($request->table_name);
                if($request->id) $list->whereDate('created_at',$request->id);
                $list = $list->orderBy('idx','desc')->paginate(20);
                $col = Schema::getColumnListing($request->table_name);
                break;
            default:
                break;
        }
        return view('admin.log', ['data' => $list, 'col' =>  $col]);
    }
}
