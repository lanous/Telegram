<?php

namespace Lanous\Telegram\Exceptions;
class Structure extends \Exception {
    public const CONFIG = 900;
    public function __construct(int $code, string $detail = "") {
        $this->code = $code;
        $this->message = $this->errorText($code)."\n".$detail;
    }
    private function errorText (int $code) : bool|string {
        if($code == self::CONFIG) {
            return "Error in config";
        }
        return false;
    }
}