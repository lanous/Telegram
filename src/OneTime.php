<?php

namespace Lanous\Telegram;

class OneTime {
    private static array $data = [];
    private function __construct() {}
    private function __clone() {}
    public static function Add($index,$key,$value) {
        if (!isset(self::$data[$index][$key])) {
            self::$data[$index] = [];
        }
        self::$data[$index][$key] = $value;
    }
    public static function Valid($index,$key,$with) {
        if(!isset(self::$data[$index][$key])) {
            return false;
        }elseif(self::$data[$index][$key] != $with) {
            return false;
        } else {
            unset(self::$data[$index][$key]);
            self::$data = array_filter(self::$data,fn ($value) => (count($value) == 0) ? false : true);
            return true;
        }
    }
}