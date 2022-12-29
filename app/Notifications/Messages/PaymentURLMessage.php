<?php

namespace App\Notifications\Messages;

class PaymentURLMessage
{

    private string $_url;

    /**
     * Sms Verification message template
     * @var string $_template
     */
    private string $_template = "لینک پرداخت شما : \n[URL]";
    /**
     * set verification code
     * @param string $url
     * @return PaymentURLMessage
     */
    public function setURL(string $url): PaymentURLMessage
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * get sms message
     */
    public function getMessage(): array|string
    {
        return str_replace('[URL]', $this->_url, $this->_template);
    }
}
