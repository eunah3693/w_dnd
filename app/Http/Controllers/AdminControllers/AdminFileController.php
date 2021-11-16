<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    function getFileList(Request $request)
    {
        $file = Files::select('files_tbl.*')->orderBy('created_at', 'desc')->paginate(40);
        //dd($file);
        if($request->input())
        {
            $query = Files::select('*')->orderBy('created_at', 'desc');
            $query = $this->getDynamicQuery($query, $request->input());
            $file = $query->paginate(40);
        }
        foreach($file as $key)
        {
            $file_data = collect();
            if($key->table_name){ $file_data = DB::table($key->table_name)->where('idx',$key->table_idx)->first(); }

            if(Storage::exists('public/'.$key->real_path)) { $key->file_exists = 'Y';}else{$key->file_exists = 'N'; }
            $key->file_data = $file_data;
        }
        return view('admin.manage.file',['data'=>$file]);
    }

    function deleteFile(Request $request)
    {
        $file = Files::find($request->file_idx);
        $file->delete();
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
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
}
