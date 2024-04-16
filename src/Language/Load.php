<?php

namespace Lanous\Telegram\Language;

class Load {
    private $Data;
    private $Language;
    public function LoadDirectory ($language,$directory) {
        if (!isset($this->Data[$language])) {
            $this->Data[$language] = [];
        }
        foreach(glob($directory."/*.php") as $filename) {
            $ReadFile = include_once($filename);
            $this->Data[$language] = array_merge($this->Data[$language],$ReadFile);
        }
    }
    public function SetLanguage ($language) {
        if (!isset($this->Data[$language])) {
            return false;
        }
        $this->Language = $language;
    }
    public function Bind (&$extract,$variable,$new_value) {
        $extract = str_replace($variable,$new_value,$extract);
    }
    public function Extract ($Section) {
        return $this->Data[$this->Language][$Section];
    }
}