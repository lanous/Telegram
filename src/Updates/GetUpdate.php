<?php

namespace Lanous\Telegram\Updates;
use \Lanous\Telegram\Request;

class GetUpdate {
    private static $last_update_id;
    public static $update_cb;

    public function SetCallback (callable $callback) {
        self::$update_cb = $callback;
    }
    public static function GetUpdate() {
        $Request = new Request();
        $data = $Request->Method("getUpdates",offset:-1);
        if(!isset($data['result']) or !is_array($data['result'])) {
            var_dump($data);
            die("Get Update Error: ".PHP_EOL);
        }
        $result = $data['result'];
        $num = array_key_last($result);
        if ($num !== null) {
            $last_result = $result[$num];
            $update_id = $last_result['update_id'];
            if($update_id != self::$last_update_id) {
                self::$last_update_id = $update_id;
                return $last_result;
            }
        }
    }
    public static function sendUpdate (array $update) {
        call_user_func(self::$update_cb,$update);
    }
    public function Run () {
        while (true) {
            $GetUpdate = self::GetUpdate();
            if ($GetUpdate !== NULL) {
                $this->sendUpdate ($GetUpdate);
            }
        }
    }
}