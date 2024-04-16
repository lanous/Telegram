<?php

include_once("src/Keyboard/Reply.php");

$Reply = new Lanous\Telegram\Keyboard\Reply([
    ["one","two","three"],
    ["four","five","six"],
    ["seven","eight","nine"],
]);


$Reply->AddRow(["ten","eleven","twelve"]); # Add New Row in Bottom
/*
    ["one","two","three"],
    ["four","five","six"],
    ["seven","eight","nine"],
    ["ten","eleven","twelve"]
*/

$Reply->AddRow(["1","Share Number","3"],"top"); # Add New Row in Top - thats not a clean code!
/*
    ["1","Share Number","3"]
    ["one","two","three"],
    ["four","five","six"],
    ["seven","eight","nine"],
    ["ten","eleven","twelve"]
*/

$Reply->AddField(row_number:1,  button_number:2, # Select Button
    field: ["request_contact"=>true] # Add Field
);

$Reply->DelRow(2);
/*
    ["1","Share Number","3"]
    ["four","five","six"],
    ["seven","eight","nine"],
    ["ten","eleven","twelve"]
*/

$Reply->DelButton(1,3);
/*
    ["1","Share Number"]
    ["four","five","six"],
    ["seven","eight","nine"],
    ["ten","eleven","twelve"]
*/

$Reply->ToJson();
/*

{
    "is_persistent": false,
    "resize_keyboard": true,
    "one_time_keyboard": true,
    "input_field_placeholder": null,
    "selective": false,
    "keyboard": [
        [
            {
                "text": "1"
            },
            {
                "text": "Share Number",
                "request_contact": true
            }
        ],
        [
            {
                "text": "four"
            },
            {
                "text": "five"
            },
            {
                "text": "six"
            }
        ],
        [
            {
                "text": "seven"
            },
            {
                "text": "eight"
            },
            {
                "text": "nine"
            }
        ],
        [
            {
                "text": "ten"
            },
            {
                "text": "eleven"
            },
            {
                "text": "twelve"
            }
        ]
    ]
}

*/