<?php

namespace App\Http\Controllers\CommonControllers;

use App\Models\Files;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use  Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * @param file  // 파일
     * @param user_idx  // 전송하는 유저 인덱스
     * @param table_idx // 테이블 인덱스
     * @param table_name // 테이블이름
     */
    function insertImageWithTable($file, $user_idx, $table_name, $table_idx)
    {
        $mime_type = $file->getMimeType();
        if(false !== mb_strpos($mime_type, "image"))
        {
            $file_path = $file->store('image', 'public');
            $this->resizeImage($file_path);

            $files = new Files;
            $files->mime_type = $file->getMimeType();
            $files->size = $file->getSize();
            $files->user_idx = $user_idx;
            $files->table_idx = $table_idx;
            $files->table_name = $table_name;
            $files->orgin_name = $file->getClientOriginalName();
            $files->real_path = $file_path;
            $files->save();

            // 인덱스 리턴
            return $files->idx;
        }
    }


    function deleteImage($idx)
    {
        $file = Files::find($idx);
        Storage::delete('public/'.$file->real_path);
        Storage::delete('public/thumbnail/'.$file->real_path.'.png');
        $file->delete();
        return true;
    }
/**
     * @param file  // 파일
     * @param user_idx  // 전송하는 유저 인덱스
     * @param table_idx // 테이블 인덱스
     * @param table_name // 테이블이름
     * @param file_idx // 파일인덱스
     */
    function updateImageWithTable($file, $user_idx, $table_name, $table_idx, $file_idx)
    {

        $mime_type = $file->getMimeType();
        if(false !== mb_strpos($mime_type, "image"))
        {
            // 기존 파일 파일삭제
            if($file_idx)
            {
                $files = Files::find($file_idx);
                if($files)
                {
                    Storage::delete('public/'.$files->real_path);
                    Storage::delete('public/thumbnail/'.$files->real_path.'.png');
                    $files->delete();
                }
            }
            // 신규 저장
            $file_path = $file->store('image', 'public');
            $this->resizeImage($file_path);

            $files = new Files;
            $files->mime_type = $file->getMimeType();;
            $files->size = $file->getSize();
            $files->user_idx = $user_idx;
            $files->table_idx = $table_idx;
            $files->table_name = $table_name;
            $files->orgin_name = $file->getClientOriginalName();
            $files->real_path = $file_path;
            $files->save();

            // 인덱스 리턴
            return $files->idx;
        }
    }

    public function resizeImage(String $file_path)
    {
        $img = Image::make(storage_path('app/public/'.$file_path));

        $width = $img->width();
        $img->orientate();
        $img->resize(min($width, 360), null, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->save(storage_path('app/public/thumbnail/'.$file_path.'.png'));
    }
}
