<?php

namespace App\Jobs\Users;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UpdateImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $id)
    {
        $this->user = $user;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // generating a file name
        $fileName = $this->id . '.png';
        // grab the file path
        $filePath = storage_path() . '/uploads/' . $this->id;
        // resize the image
        Image::make($filePath)->encode('png')->fit(60, 60, function($c) {
            $c->upsize();
        })->save();
        
        // upload to s3
        if(Storage::disk('s3')->put("images/users/{$fileName}", fopen($filePath, 'r+'))) {
            File::delete($filePath);
        }
        
        // update the user profile (db)
        $this->user->image_filename = $fileName;
        $this->user->save();
    }
}
