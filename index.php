<?php
include_once("src/Exceptions/Structure.php");
include_once("src/Config.php");
include_once("src/Keyboard/Reply.php");
include_once("src/Updates/GetUpdate.php");
include_once("src/Request.php");
include_once("src/Language/Load.php");


Lanous\Telegram\Config::setConfig("Telegram","BOT_TOKEN","6346204639:AAEUcb2qtWs5NBq6SUxGeFGt80jz48I6nPo");
$Request = new Lanous\Telegram\Request();

$Language = new Lanous\Telegram\Language\Load();
$Language->LoadDirectory("FA",__DIR__."/Languages/Fa");

$Language->SetLanguage("FA");


$textMessage = $Language->Extract("start")['text'];
$Language->Bind($textMessage,":chat_id:",5777768106);
$Language->Bind($textMessage,":first_name:","محمد");
$Request->Method("SendMessage",
    chat_id:5777768106,
    text:$textMessage
);