<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCancelled extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Gửi mail + lưu database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Thông báo #' . $this->order->id)
            ->greeting('Xin chào ' . $notifiable->name . ',')
            ->line('Đơn hàng #' . $this->order->id . ' của bạn đã được cập nhật trạng thái: ' . $this->order->status)
            ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.')
            ->salutation('Trân trọng, Hệ thống bán hàng');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Thông báo',
            'message' => 'Đơn hàng #' . $this->order->id . ' đã được cập nhật trạng thái: ' . $this->order->status,
        ];
    }
}
