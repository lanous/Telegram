<?php
include_once("src/Exceptions/Structure.php");
include_once("src/Config.php");
include_once("src/OneTime.php");
include_once("src/Keyboard/Reply.php");
include_once("src/Keyboard/Inline.php");
include_once("src/Updates/GetUpdate.php");
include_once("src/Updates/Handle.php");
include_once("src/Request.php");
include_once("src/Language/Load.php");


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
        var_dump($textMessage);

        /*
        $Inline = new Lanous\Telegram\Keyboard\Inline();
        $button_1 = $Inline->GenerateButton(
            text:"test1",callback_data:"cb_test1"
        );
        $button_2 = $Inline->GenerateButton(
            text:"test2",callback_data:"cb_test2"
        );
        $button_3 = $Inline->GenerateButton(
            text:"test3",callback_data:"cb_test3"
        );
        $Inline->AddManual([
            [$button_1,$button_2,$button_3],
                 [$button_1,$button_3],
            [$button_1,$button_2,$button_3],
                 [$button_1,$button_3],
            [$button_1,$button_2,$button_3],
        ]);*/

        $Request->Method("SendMessage",
            chat_id:$UpdateHandle->chat_id,
            text:$textMessage,
            // reply_markup: $Inline->ToJson()
        );
    }


},sleep:1);