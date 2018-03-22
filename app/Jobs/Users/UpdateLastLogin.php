<?php

namespace App\Jobs\Users;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateLastLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Carbon $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->update([
            'last_login' => $this->date
        ]);
    }

    // public function failed()
    // {
    //     Log::error('Could not update user ' . $this->user->id);
    // }
}
