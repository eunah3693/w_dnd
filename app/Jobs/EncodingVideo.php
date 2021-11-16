<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Files;
use ProtoneMedia\LaravelFFMpeg\Exporters\EncodingException;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Filters\Video\ClipFilter;
use Illuminate\Support\Facades\Log;

class EncodingVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $files = Files::where([
            ['mime_type', 'like', 'video%'],
            ['is_encoding', '0'],
        ])->get();
        foreach( $files as $file)
        {
            try {
                $video = FFmpeg::open('public/'.$file->real_path);
                $video->getFrameFromSeconds(1)                                                            //썸네일 할 영상추출
                ->export()
                ->save('public/thumbnail/'.$file->real_path.'_enc.mp4.png')
                ->addFilter(new ClipFilter(TimeCode::fromSeconds(0), TimeCode::fromSeconds(30)))    // 영상시간
                ->addFilter('-vf',"scale='640':'-2'")
                ->addFilter('-y')                                                                   // 덮어쓰기
                ->export()
                ->inFormat(new \FFMpeg\Format\Video\X264('aac', 'libx264'))
                ->save('public/'.$file->real_path.'_enc.mp4');
                $file->real_path = $file->real_path.'_enc.mp4';
                $file->is_encoding = 1;
                $file->save();
            } catch (EncodingException $exception) {
                $command = $exception->getCommand();
                $errorLog = $exception->getErrorOutput();
            }
        }
    }
}
