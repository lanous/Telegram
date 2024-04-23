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
        if (!empty($buttons)) {
            $this->buttons[] = array_values(array_filter($buttons,fn($data) => $data !== null));
        }
    }
    public function toJson() {
        return json_encode(["inline_keyboard"=>$this->buttons],128|256);
    }
    public function AddManual (array $Buttons) {
        $this->buttons = array_merge($Buttons,$this->buttons);
    }

}