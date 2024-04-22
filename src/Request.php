<?php

namespace Lanous\Telegram;
class Request extends Config {
    private static $proxy = [];
    public function __construct() {}
    public static function SetProxy ($host,$port,$user=null,$pass=null) {
        self::$proxy["host"] = $host;
        self::$proxy["port"] = $port;
        self::$proxy["user"] = $user;
        self::$proxy["pass"] = $pass;
    }
    public function Method ($method_name,...$fields) {
        $BOT_TOKEN = Config::getConfig ("Telegram","BOT_TOKEN");
        $Request = curl_init("https://api.telegram.org/bot".$BOT_TOKEN."/".$method_name);
        curl_setopt($Request,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($Request,CURLOPT_POST,1);
        curl_setopt($Request,CURLOPT_POSTFIELDS, $fields);
        if(self::$proxy != []) {
            curl_setopt($Request, CURLOPT_PROXY, self::$proxy["host"].":".self::$proxy["port"]);
        }
        $result = curl_exec($Request);
        if (curl_errno($Request)) {
            die(curl_error($Request));
        }
        curl_close($Request);
        return json_decode($result,1);
    }
}