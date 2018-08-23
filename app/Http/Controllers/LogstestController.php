<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Log;

class LogstestController extends Controller
{
    public function test()
    {
    	Log::info('LOG文件测试！');
    	Log::warning('换个级别测试~');
    }
}
