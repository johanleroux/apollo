<?php

namespace App\Traits;

use App\Models\User;
use App\Notifications\ModelProcessed;
use Illuminate\Support\Facades\Notification;

trait NotifyModel
{
    protected static function bootNotifyModel()
    {
        static::created(function ($model) {
            $model->processNotification('created');
        });

        static::updated(function ($model) {
            $model->processNotification('updated');
        });

        static::deleted(function ($model) {
            $model->processNotification('deleted');
        });
    }

    public function processNotification($action = 'saved')
    {
        if (auth()->check()) {
            $users = User::where('id', '!=', auth()->user()->id)->get();

            Notification::send($users, (new ModelProcessed($this, $action)));
        }
    }
}
