<?php

namespace Lanous\Telegram\Updates;
use \Lanous\Telegram\Request;
class GetUpdate {
    private $last_update_id;
    public function Run (callable $callback,$sleep=0) {
        while (true) {
            $Request = new Request();
            $data = $Request->Method("getUpdates");
            if(!isset($data['result']) or !is_array($data['result'])) {
                var_dump($data);
                die("Get Update Error: ".PHP_EOL);
            }
            $result = $data['result'];
            $num = array_key_last($result);
            if ($num !== null) {
                $last_result = $result[$num];
                $update_id = $last_result['update_id'];
                if($update_id != $this->last_update_id) {
                    $this->last_update_id = $update_id;
                    $callback($last_result);
                }
                sleep($sleep);
            }
        }
    }
}