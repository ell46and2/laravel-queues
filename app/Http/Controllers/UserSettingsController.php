<?php

namespace App\Http\Controllers;

use App\Jobs\Users\UpdateImage;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}

    public function edit()
    {
    	return view('users.settings');
    }

    public function update(Request $request)
    {
    	if($request->file('image')) {
    		$file = $request->file('image');

    		$file->move(storage_path() . '/uploads', $id = uniqid());

    		$this->dispatch(new UpdateImage($request->user(), $id));
    	}

    	return back();
    }
}
