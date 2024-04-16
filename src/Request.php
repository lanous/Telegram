<?php

namespace Lanous\Telegram;
class Request extends Config {
    public function __construct() {}
    public function Method ($method_name,...$fields) {
        $BOT_TOKEN = Config::getConfig ("Telegram","BOT_TOKEN");
        $Request = curl_init("https://api.telegram.org/bot".$BOT_TOKEN."/".$method_name);
        curl_setopt($Request,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($Request,CURLOPT_POST,1);
        curl_setopt($Request,CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($Request);
        curl_close($Request);
        return json_decode($result,1);
    }
}