<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Cache;

/*系统默认的文件缓存*/
class CachetestController extends Controller
{
    public function test1()
    {
    	if (Cache::has('key1')) {
    		var_dump(Cache::get('key1'));
    	} else {
    		Cache::add('key1', 'val1', 3);
    		echo 1;
    	}
    }

    public function del()
    {
    	Cache::forget('key1');
    }
}
