<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redis;

class RedistestController extends Controller
{
    public function test()
    {
    	$test = null;
    	if (!isset($test)) {
    		abort(503);//参数对应errors视图名称
    	}
    }














}