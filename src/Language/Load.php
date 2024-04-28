<?php

namespace Lanous\Telegram\Language;

class Load {
    private $Data;
    private $Selected;
    private $Language;
    public function __construct(string $language_name,string $language_directory) {
        
        foreach(scandir($language_directory) as $filename) {
            if(pathinfo($filename,PATHINFO_EXTENSION) == "php") {
                $name = pathinfo($filename,PATHINFO_FILENAME);
                $ReadFile = include_once($language_directory."/".$filename);
                if (!isset($this->Data[$language_name])) {
                    $this->Data[$language_name] = [];
                }
                if (!isset($this->Data[$language_name][$name])) {
                    $this->Data[$language_name][$name] = [];
                }
                $this->Data[$language_name][$name] = array_merge($this->Data[$language_name][$name],$ReadFile);
            }
        }
    }
    public function SetLanguage ($language) {
        $this->Language = $language;
    }
    public function Bind (&$extract,$variable,$new_value) {
        $extract = str_replace($variable,$new_value,$extract);
    }
    public function Open ($file,$section) {
        return $this->Data[$this->Language][$file][$section];
    }
    public function Search ($file,$text) {
        $result = [];
        foreach ($this->Data[$this->Language][$file] as $key=>$value) {
            $search = array_search($text,$value);
            if($search !== false) {
                $result[$key] = $search;
            }
            if (!isset($result[$key])) {
                $result[$key] = false;
            }
        }
        return $result;
    }

}