<?php

namespace Lanous\Telegram\Updates;

class Webhook {
    public static $webhook_url;
    public function __construct($url) {
        $this->webhook_url = $url;
    }
}