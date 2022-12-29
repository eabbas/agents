<?php

namespace App\Notifications;

use App\Models\User;
use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SmsChannel
{

    private static string $_api_meliPayamak_send = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws Exception
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        /* @var $notification PaymentURLSms */
        /* @var $notifiable User */

        $message = $notification->toSms($notifiable);
        $sent = $this->callMeliPayamak($message, $notifiable->phone ?? $notifiable->number);

        if (!$sent) {
            throw new Exception("SMS failed");
        }
    }

    /**
     * send sms with melipayamak api
     * @param $message string
     * @param $phone string
     * @return bool
     */
    private function callMeliPayamak(string $message, string $phone): bool
    {
        $response = Http::post(self::$_api_meliPayamak_send, [
            'username' => env('MELIPAYAMAK_USERNAME'),
            'password' => env('MELIPAYAMAK_PASSWORD'),
            'from' => env('MELIPAYAMAK_FROM'),
            'to' => $phone,
            'text' => $message
        ]);

        return $response->status() == 200 && $response->json('RetStatus') == 1;
    }
}
