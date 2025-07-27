<?php

$token = "8473441275:AAGnWHju-vvGtWvdGU3gmt-smwMJ8PusT_0";
$api = "http://api.telegram.org/bot$token/";
$offset = 0;

while (true) {
    $response = file_get_contents($api . "getUpdates?offset=$offset&timeout=30");
    $updates = json_decode($response, true);

    if (isset($updates["result"])) {
        foreach ($updates["result"] as $update) {
            $offset = $update["update_id"] + 1;

            // اینجا پیام جدید اومده
            // ما متغیر $update رو می‌سازیم و فایل اصلی رباتو اجرا می‌کنیم
            global $update;
            $update = json_decode(json_encode($update), false); // تبدیل به object مثل php://input

            require 'bot.php'; // ← این خط باعث می‌شه کد اصلیت اجرا شه
        }
    }

    sleep(1);
}
