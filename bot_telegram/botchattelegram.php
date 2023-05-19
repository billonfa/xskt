<?php 
header('Content-Type: application/json; charset=utf-8');

$url_qtri = 'https://samples.openweathermap.org/data/2.5/forecast?id=524901&appid=b1b15e88fa797225412429c1c50c122a1';
$content_tri = file_get_contents($url_qtri);

$token = "6010319117:AAF_eu45x-U85NHQ_3pstwuAwiKLQFLbGd4";

$data_qtri = [
	'chat_id' => '@tbkqxs_bot',
	'caption' => 'hehehe'
];
file_get_contents("https://api.telegram.org/bot$token/sendPhoto?" . http_build_query($data_qtri));

$url_hue = 'https://samples.openweathermap.org/data/2.5/forecast?id=524901&appid=b1b15e88fa797225412429c1c50c122a1';
$content_hue = file_get_contents($url_hue);


$data_hue = [
	'chat_id' => '@tbkqxs_bot',
	'caption' => 'hehe'
];
file_get_contents("https://api.telegram.org/bot$token/sendPhoto?" . http_build_query($data_hue));
