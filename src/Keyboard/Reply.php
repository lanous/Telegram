<?php

namespace Lanous\Telegram\Keyboard;

class Reply {
    private array $buttons;
    private $config=[];
    public function __construct($buttons=null,$is_persistent=false,$resize_keyboard=true,$one_time_keyboard=true,$input_field_placeholder=null,$selective=false) {
        $this->config['is_persistent'] = $is_persistent;
        $this->config['resize_keyboard'] = $resize_keyboard;
        $this->config['one_time_keyboard'] = $one_time_keyboard;
        $this->config['input_field_placeholder'] = $input_field_placeholder;
        $this->config['selective'] = $selective;
        foreach ($buttons ?? [] as $key=>$value) {
            if(is_array($value)) {
                array_walk($value,function (&$value,$key) {
                        $value = ["text"=>$value];
                });
                $buttons[$key] = array_values($value);
            } else {
                $buttons[$key] = ["text"=>$value];
            }
        }
        $this->buttons = $buttons;
    }
    /**
     * @param string $from top|bottom
     */
    public function AddRow(array $buttons,string $position="bottom") : int {
        if ($position == "top") {
            array_walk($buttons,function (&$value,$key) {
                $value = ["text"=>$value];
            });
            $this->buttons = array_merge([$buttons],$this->buttons);
        } elseif ($position == "bottom") {
            array_walk($buttons,function (&$value,$key) {
                $value = ["text"=>$value];
            });
            $this->buttons[] = $buttons;
        }
        return count($this->buttons);
    }
    public function AddManual ($keyboards) {
        $this->buttons = array_merge($keyboards,$this->buttons);
    }
    public function AddField (int $row_number=null,int $button_number,array $field) {
        $field_type = array_key_first($field);
        $field_value = $field[$field_type];
        if ($row_number != null) {
            $this->buttons[$row_number - 1][$button_number - 1][$field_type] = $field_value;
        } else {
            $this->buttons[count($this->buttons) - 1][$button_number - 1][$field_type] = $field_value;
        }
    }
    public function DelRow(int $row_number=null) : void {
        $row_number = $row_number == null ? count($this->buttons) - 1 : $row_number - 1;
        unset($this->buttons[$row_number]);
        $this->buttons = array_values($this->buttons);
    }
    public function DelButton(int $row_number=null,int $button_number) : void {
        $row_number = $row_number == null ? count($this->buttons) - 1 : $row_number - 1;
        $button_number = $button_number == null ? count($this->buttons[$row_number]) - 1 : $button_number - 1;
        unset($this->buttons[$row_number][$button_number]);
    }

    public function ToJson () {
        $this->config['keyboard'] = $this->buttons;
        return json_encode($this->config,128|256);
    }
}