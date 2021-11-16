<?php

namespace App\Jobs;

use App\Models\Config;
use App\Models\Mission;
use App\Models\MissionPool;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MissionIssuance implements ShouldQueue
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
        /**
         * 앱설정에서 주간 발급갯수, 발급요일, 발급페이지 추출
         */
        $config = array();
        $weekly_config = Config::whereIn('key',['weekly_issuance_number','weekly_issuance_day','weekly_page','weekly_issuance_last_idx'])
                                ->get();
        foreach ($weekly_config as $key) {
            $config[$key->key] = $key->value;
        }
        $startdate = date('Y-m-d');

        /**
         * 주간 발급
         * 주간 발급요일이 설정내용과 같은 요일일때 실행
         */
        if(date("w") == $config['weekly_issuance_day'])
        {
            $enddate = date("Y-m-d", strtotime($startdate." +7 day"));                              // 종료 날짜
            $max_idx = MissionPool::selectRaw('max(idx) as max_idx')->value('max_idx');             // 주간 미션 인덱스 가장 마지막 번호

            $weekly = MissionPool::where('category', '주간미션')
                    ->where(function ($q) use($config, $max_idx){
                        $q->orWhere('idx','>', $config['weekly_issuance_last_idx']);
                        if($max_idx - $config['weekly_issuance_last_idx'] < $config['weekly_issuance_number']) $q->orWhere('idx', '>', 1);
                    })
                    ->orderByRaw('idx > '. $config['weekly_issuance_last_idx'].' DESC , idx ASC')
                    ->limit($config['weekly_issuance_number'])
                    ->get();

            // 발급 미션 실제 insert
            foreach ($weekly as $key => $val) {
                Mission::insert(
                    ['mission_pool_idx' => $val->idx , 'startdate' => $startdate , 'enddate' => $enddate]
                );
                // 가장 마지막 인덱스 config 에 저장
                if($key == 2){ Config::where('key', 'weekly_issuance_last_idx')->update(['value' => $val->idx]); }
            }
        }

        /**
         * 일간 발급
         */
        $dailys = MissionPool::where('category', '일일미션')->get();
        foreach ($dailys as $key) {
            $enddate = date("Y-m-d", strtotime($startdate." +1 day"));
            Mission::insert(
                ['mission_pool_idx' => $key->idx , 'startdate' => $startdate , 'enddate' => $enddate]
            );
        }

    }
}
