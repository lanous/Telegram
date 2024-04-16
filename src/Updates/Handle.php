<?php

namespace Lanous\Telegram\Updates;

class Handle {
    public $chat_id;
    public $first_name;
    public $text;
    public function __construct($Update) {
        $this->chat_id = $Update["message"]['chat']['id'] ?? null;
        $this->first_name = $Update["message"]['chat']['first_name'] ?? null;
        $this->text = $Update["message"]['text'] ?? null;
    }
}