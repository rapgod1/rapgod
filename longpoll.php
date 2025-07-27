<?php
$token = "8473441275:AAGnWHju-vvGtWvdGU3gmt-smwMJ8PusT_0";
$offset = 0;

while (true) {
    $response = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=$offset&timeout=30");
    $updates = json_decode($response, true);

    if ($updates["ok"]) {
        foreach ($updates["result"] as $update) {
            $offset = $update["update_id"] + 1;
            // اینجا اتصال به bot.php یا لاگ گرفتن یا هر کاری
        }
    }

    sleep(1); // استراحت کوتاه بین هر حلقه
}
