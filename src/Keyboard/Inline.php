<?php

namespace Lanous\Telegram\Keyboard;

class Inline {
    private array $buttons = [];
    private array $stay_buttons = [];

    public function __construct() { }
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


    public function Stay (array $button) {
        $this->stay_buttons[] = $button;
    }
    public function Sort ($item_per_row=2) {
        $this->stay_buttons = array_chunk($this->stay_buttons,$item_per_row);
    }
    public function PushToKeyboard () {
        $this->buttons = array_merge($this->stay_buttons,$this->buttons);
        $this->stay_buttons = [];
    }

}