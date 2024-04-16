<?php
include_once("vendor/autoload.php");


Lanous\Telegram\Config::setConfig("Telegram","BOT_TOKEN","6346204639:AAEUcb2qtWs5NBq6SUxGeFGt80jz48I6nPo");
$GetUpdate = new Lanous\Telegram\Updates\GetUpdate();
$Language = new Lanous\Telegram\Language\Load();
$Language->LoadDirectory("FA",__DIR__."/Languages/Fa");


$GetUpdate->Run(function ($Update) use ($Language) {
    $Request = new Lanous\Telegram\Request();
    $UpdateHandle = new Lanous\Telegram\Updates\Handle($Update);
    $Language->SetLanguage("FA");

    if($UpdateHandle->text == "/start") {
        $textMessage = $Language->Extract("start");
        $Language->Bind($textMessage,":chat_id:",$UpdateHandle->chat_id);
        $Language->Bind($textMessage,":first_name:",$UpdateHandle->first_name);
        $Request->Method("SendMessage",
            chat_id:$UpdateHandle->chat_id,
            text:$textMessage,
            // reply_markup: $Inline->ToJson()
        );
    }

},sleep:1);