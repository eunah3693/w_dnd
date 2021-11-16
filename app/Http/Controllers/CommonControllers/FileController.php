<?php

namespace App\Http\Controllers\CommonControllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use ProtoneMedia\LaravelFFMpeg\Exporters\EncodingException;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use  Intervention\Image\Facades\Image;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = public_path('/image/app/image_error.jpg');
        return response()->file($contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('file'))
        {
            return response()->json(array('success' => false, 'msg' => '파일이 없습니다.'), 200);
        }
        $mime_type = $request->file('file')->getMimeType();
        $file_type = '';
        if (false !== mb_strpos($mime_type, "video"))
        {
            $file_path = $request->file('file')->store('video', 'public');

            $file = FFMpeg::open('public/'.$file_path);
            $durationInSeconds = $file->getDurationInSeconds();

            if($durationInSeconds >= 30)
            {
                Storage::delete('public/'.$file_path);
                return response()->json(array('success' => false, 'msg' => '30초 이내로 올려주세요.'), 200);
            }

            $file_path = $this->encodingVideo($file_path);
            $file_type = 'video';
        }
        else if(false !== mb_strpos($mime_type, "image"))
        {
            $file_path = $request->file('file')->store('image', 'public');
            $this->resizeImage($file_path);
            $file_type = 'image';
        }
        else
        {
            return  response()->json(array('success' => false, 'msg' => '비디오 혹은 사진을 올려주세요'), 200);
        }

        $file = new Files;
        $file->mime_type = $request->file('file')->getMimeType();;
        $file->size = $request->file('file')->getSize();
        if(Arr::exists($request, 'user_idx'))  $file->user_idx = $request->user_idx;
        if(Arr::exists($request, 'table_idx'))  $file->table_idx = $request->table_idx;
        if(Arr::exists($request, 'table_name'))  $file->table_name = $request->table_name;
        $file->orgin_name = $request->file('file')->getClientOriginalName();
        $file->real_path = $file_path;
        $file->save();

        return  response()->json(array('success' => true, 'idx' => $file->idx, 'type' => $file_type), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = Files::find($id);
        $exists = '';
        if($file) $exists = Storage::exists('public/'.$file->real_path);

        if(!$exists || !$file)
        {
            $contents = public_path('/image/app/image_error.jpg');
        }else{
            $contents = Storage::path('public/'.$file->real_path);

        }
        return response()->file($contents);
    }

    public function thumbnailShow(Request $request)
    {
        $file = Files::find($request->id);
        $exists = '';
        if($file) $exists = Storage::exists('public/thumbnail/'.$file->real_path.'.png');
        if(!$exists || !$file)
        {
            $contents = public_path('/image/app/image_error.jpg');
        }else{
            $contents = Storage::path('public/thumbnail/'.$file->real_path.'.png');

        }
        return response()->file($contents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Files $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Files $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $file)
    {
        Storage::delete('public/'.$file->real_path);
        Storage::delete('public/thumbnail/'.$file->real_path.'.png');
        $file->delete();
        return response()->json(array('success' => true), 200);
    }

    public function encodingVideo($file_path){
        // 파일이름 날짜_난수

        try {
            $video = FFmpeg::open('public/'.$file_path);
            $video->getFrameFromSeconds(1)                                                            //썸네일 할 영상추출
            ->export()
            ->save('public/thumbnail/'.$file_path.'.png');
            //Storage::delete('public/'.$file_path);
        } catch (EncodingException $exception) {
            $command = $exception->getCommand();
            $errorLog = $exception->getErrorOutput();
        }
        return $file_path;
    }

    public function resizeImage(String $file_path)
    {
        $img = Image::make(storage_path('app/public/'.$file_path));

        $width = $img->width();
        $img->orientate();
        $img->resize(min($width, 1080), null, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->save(storage_path('app/public/'.$file_path))

        ->resize(min($width, 360), null, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->save(storage_path('app/public/thumbnail/'.$file_path.'.png'));
    }

    public function insertImage(Request $request)
    {

    }
}
