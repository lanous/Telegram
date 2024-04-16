<?php
include_once("vendor/autoload.php");


Lanous\Telegram\Config::setConfig("Telegram","BOT_TOKEN","xxxx");
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
        if($UpdateHandle->invite_id) {
            $Language->Bind($textMessage,":first_name_inviter:","unknown user");
            $invite_id = $UpdateHandle->invite_id;
            $Request->Method("SendMessage",
                chat_id:$UpdateHandle->chat_id,
                text:$textMessage["invite"]
            );
        }
        $Request->Method("SendMessage",
            chat_id:$UpdateHandle->chat_id,
            text:$textMessage["normal"],
        );
    }

},sleep:1);