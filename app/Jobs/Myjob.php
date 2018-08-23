<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Redis;
class Myjob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $key;
    public $value;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key, $value)
    {
        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::set($this->key, $this->value);
    }

    public function failed()
    {
        dump('failed');
    }
}
