<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Jobs\Myjob;

/* redis队列测试 */
class QueuetestController extends Controller
{
    public function test()
    {
    	$queueId = $this->dispatch(new Myjob(1, 'test1'));
    	dd($queueId);
    }
}
