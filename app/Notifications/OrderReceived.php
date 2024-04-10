<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReceived extends Notification implements ShouldQueue
{
    use Queueable;

    public function withDelay(object $notifiable): array
    {
        return [
            'mail' => now()->addMinutes(5),
        ];
    }

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $this->order->loadMissing('customer');
        return (new MailMessage)
            ->subject('Order Received: ' . $this->order->id)
            ->line('New order has been received.')
            ->line('Order ID: ' . $this->order->id)
            ->line('Order Status: ' . $this->order->status->value)
            ->line('Total Price: ' . $this->order->total_price)
            ->line('Customer Name: ' . $this->order->customer->full_name)
            ->line('Shipping Address: ' . $this->order->shipping_address)
            ->line('Shipping Country: ' . $this->order->shipping_country)
            ->line('Shipping State: ' . $this->order->shipping_state)
            ->line('Shipping Postal Code: ' . $this->order->shipping_postal_code)
            ->line('Payment Method: ' . $this->order->payment_method->value)
            ->line('Payment Status: ' . $this->order->payment_status->value);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
