<?php

namespace App\Jobs;

use App\Models\OneTimeCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OneTimeCodeClearJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        OneTimeCode::query()->where('created_at', '<', now()->subMinutes(10))->delete();
    }
}
