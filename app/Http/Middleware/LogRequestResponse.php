<?php

namespace App\Http\Middleware;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class LogRequestResponse
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
    public function terminate($request, $response)
    {
        $log_table = '__log_'.date('Ym').'_tbl';

       // if(Arr::exists($request, 'password')) $request['password'] = Crypt::encryptString($request->password);
        $response = $request->isMethod('get') ? "[]" : $response;
        $data = array(
            'URL'=>$request->fullUrl(),
            'IP'=>$request->ip(),
            'METHOD'=>$request->method(),
            'REQUEST'=>json_encode($request->all()),
            'RESPONSE'=> $response,
        );
        Log::info(json_encode($data));
        if(!Schema::hasTable($log_table)) {
            Schema::create($log_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('idx');
                $table->bigInteger('user_idx')->nullable();
                $table->string('script_name','1024')->nullable();
                $table->string('request_uri','1024')->nullable();
                $table->string('request_method','45')->nullable();
                $table->string('http_user_agent','512')->nullable();
                $table->string('http_referer','1024')->nullable();
                $table->string('remote_addr','255')->nullable();
                $table->string('http_x_forworded_for','255')->nullable();
                $table->text('server_header')->nullable();
                $table->text('request')->nullable();
                $table->text('response')->nullable();
                $table->text('files')->nullable();
                $table->text('client_session')->nullable();
                $table->text('client_cookie')->nullable();

                $table->timestamps();
                $table->softDeletes('deleted_at', 0)->comment('임시삭제');
            });
        }

        if(strpos( $_SERVER['HTTP_USER_AGENT'] , 'ELB') === false ){
            DB::table($log_table)->insert([
                'user_idx' => $request->session()->get('idx')
                ,'script_name' => $_SERVER['SCRIPT_NAME']
                ,'request_uri' => $_SERVER['REQUEST_URI']
                ,'request_method' => $request->method()
                ,'http_user_agent' => $_SERVER['HTTP_USER_AGENT']
                ,'http_referer' => $request->ip()
                ,'remote_addr' =>$_SERVER['REMOTE_ADDR']
                ,'http_x_forworded_for' => ''
                ,'server_header' => serialize($_SERVER)
                ,'request' => serialize($request->input())
                ,'response' => $response
                ,'files' => serialize($_FILES)
                ,'client_session' => serialize($request->session()->all())
                ,'client_cookie' => serialize($_COOKIE)
                ,'created_at' => now()
            ]);
        }
    }
}
