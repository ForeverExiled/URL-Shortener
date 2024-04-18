<?php

$filename = 'database.txt';
$alphabet = range('A', 'Z');
array_push($alphabet, ...range('a', 'z'));
array_push($alphabet, ...range(0, 9));
$arLen = count($alphabet) - 1;

if (isset($_POST['url'])) {
    $url = $_POST['url'];
    shuffle($alphabet);
    $key = implode(array(
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
    ));
    file_put_contents($filename, $key.'|'.$url.PHP_EOL, FILE_APPEND);
    echo 'http://localhost:8000/'.$key;
} elseif (isset($_GET['key'])) {
    $key = $_GET['key'];
    foreach (explode(PHP_EOL, file_get_contents($filename)) as $line) {
        if (str_starts_with($line, $key)) {
            echo explode('|', $line)[1];
            break;
        }
    }
}