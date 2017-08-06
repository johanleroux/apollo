<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    
    public function show($uuid)
    {
        $notification = DatabaseNotification::findOrFail($uuid);
        $notification->markAsRead();

        return redirect()->to($notification->data['url']);
        dd($notification);
    }
}
