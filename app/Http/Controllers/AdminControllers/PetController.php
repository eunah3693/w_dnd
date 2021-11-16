<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Breed;
use Illuminate\Support\Facades\Redirect;

class PetController extends Controller
{
    public function getBreedList(Request $request){

        $data = Breed::orderBy('visible', 'asc')->orderBy('idx', 'desc')->paginate(20);
        if($request->search && $request->text)
        {
            $data = Breed::where($request->search, 'like' , '%'.$request->text.'%')->orderBy('visible', 'asc')->orderBy('idx', 'desc')->paginate(20);
        }
        return view('admin.manage.breed', ['data'=>$data]);
    }
    public function getBreedDetail(Request $request){

        return view('admin.manage.breed_detail');
    }
    public function getBreedModify(Request $request){

        return view('admin.manage.breed_modify');
    }
    public function insertBreed(Request $request){

        $breed = new Breed;
        $breed->breed = $request->breed;
        $breed->visible =  $request->visible ? 'Y':'N';
        $breed->save();
        return Redirect('/admin/manage/breed')->with('alert','추가되었습니다.');
    }
    public function updateBreed(Request $request, $id){

        if($request->idx)
        {
            $breed = Breed::find($request->idx);
            $breed->$id = $request->$id;
            $breed->save();
        }
        return response()->json([
            'msg' => '변경되었습니다.',
            'status' => 200,
        ], 200);
    }
    public function deleteBreed(Request $request){
        if($request->idx)
        {
            $breed = Breed::find($request->idx);
            $breed->delete();
        }
        return response()->json([
            'msg' => '삭제되었습니다.',
            'status' => 200,
        ], 200);
    }
}
