<?php

namespace App\Notifications;

use App\Notifications\Messages\PaymentURLMessage;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PaymentURLSms extends Notification // implements ShouldQueue
{
    use Queueable;

    private string $_paymentURL;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $paymentURL)
    {
        $this->_paymentURL = $paymentURL;
        // TODO: queue disabled, remember to enable again
        // $this->connection = 'database';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the SMS representation of the notification.
     *
     * @param mixed $notifiable
     * @return array|string
     * @throws Exception
     */
    public function toSms(mixed $notifiable): array|string
    {
        return (new PaymentURLMessage())
            ->setURL($this->_paymentURL)
            ->getMessage();
    }
}
