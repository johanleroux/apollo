<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class ModelProcessed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $action;
    protected $model;
    protected $modelName;
    protected $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model, $action)
    {
        $this->action    = $action;
        $this->model     = $model;
        $this->modelName = class_basename($model);
        $this->url       = action($this->modelName . 'sController@show', $this->model);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Apollo - ' . $this->modelName . ' Processed')
                    ->greeting('Hello ' . $notifiable->name)
                    ->line($this->modelName . ' ' . $this->model->name . ' has been ' . $this->action)
                    ->action('View ' . $this->modelName, $this->url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->modelName . ' ' . $this->model->name . ' has been ' . $this->action . '!',
            'url'     => $this->url
        ];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->success()
            ->content($this->modelName . ' ' . $this->model->name . ' has been ' . $this->action . '!')
            ->attachment(function ($attachment) {
                $attachment->title('View ' . $this->modelName, $this->url);
            });
    }
}
