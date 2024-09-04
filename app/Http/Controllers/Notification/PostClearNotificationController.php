<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\Auth;

class PostClearNotificationController extends Controller
{
    
    public function delete(Request $request){

        Auth::user()->notifications()->delete();
        return redirect()->back();

    }
}
