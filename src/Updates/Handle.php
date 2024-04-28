<?php

namespace Lanous\Telegram\Updates;
class Handle {
    public $chat_id;
    public $first_name;
    public $last_name;
    public $text;
    public $cb_data;
    public $cb_chat_id;
    public $cb_message_id;
    public $invite_id=false;
    public $forward_from;
    public $contact;

    public function __construct($Update) {
        $this->chat_id = $Update["message"]['chat']['id'] ?? null;
        $this->first_name = $Update["message"]['chat']['first_name'] ?? null;
        $this->last_name = $Update["message"]['chat']['last_name'] ?? null;
        $this->text = $Update["message"]['text'] ?? null;
        $this->cb_data = $Update["callback_query"]["data"] ?? null;
        $this->cb_chat_id = $Update["callback_query"]["from"]["id"] ?? null;
        $this->cb_message_id = $Update["callback_query"]["message"]["message_id"] ?? null;
        $this->forward_from = $Update["message"]["forward_from"] ?? null;
        $this->contact = $Update["message"]["contact"] ?? null;

        if(explode(" ",$this->text)[0] == "/start" and isset(explode(" ",$this->text)[1])) {
            $this->invite_id = explode(" ",$this->text)[1];
            $this->text = explode(" ",$this->text)[0];
        }
    }
}