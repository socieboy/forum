<?php

namespace Socieboy\Forum\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class UnLikeReply extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
