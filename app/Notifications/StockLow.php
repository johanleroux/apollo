<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StockLow extends Notification
{
    use Queueable;

    protected $product;
    protected $quantity;
    protected $required;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product, $quantity, $required)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->required = $required;
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
                    ->subject('Product - ' . $this->product->sku . ' Stock Alert')
                    ->greeting('Hello ' . $notifiable->name)
                    ->line(
                        $this->product->sku . ' has only ' .
                        $this->quantity . ' ' .
                        str_plural('unit', $this->quantity) .
                        ' in stock requires atleast ' .
                        $this->required . ' ' .
                        str_plural('unit', $this->required)
                    )
                    ->action('View Product', action('ProductsController@show', $this->product))
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
            'message' => $this->product->sku . ' Stock Alert',
            'url'     => action('ProductsController@show', $this->product)
        ];
    }
}
