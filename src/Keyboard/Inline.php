<?php

namespace Lanous\Telegram\Keyboard;

class Inline {
    private array $buttons;

    public function __construct() {
        $this->buttons = [];
    }
    public static function GenerateButton (...$field) {
        return $field;
    }
    public function AddRow (...$buttons) {
        $this->buttons[] = $buttons;
    }
    public function toJson() {
        return json_encode(["inline_keyboard"=>$this->buttons],128|256);
    }
    public function AddManual (array $Buttons) {
        $this->buttons = array_merge($Buttons,$this->buttons);
    }

}