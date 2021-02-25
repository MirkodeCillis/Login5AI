<?php
ini_set('display_errors', 'Off');
$secretKey = "e58bd8c3-ce71-4a0d";

function getter($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

# DB CONFIGS
$host = "127.0.0.1";
$root = "root";
$db_password = "";
$db_name = "my_decillis";