<?php
require_once('database.php');
$db = new Database();
$alphabet = range('A', 'Z');
array_push($alphabet, ...range('a', 'z'));
array_push($alphabet, ...range(0, 9));
$arLen = count($alphabet) - 1;

function generate_key($alphabet, $arLen) {
    shuffle($alphabet);
    $key = implode(array(
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
        $alphabet[rand(0, $arLen)],
    ));

    return $key;
}

if (isset($_POST['url'])) {
    $url = $_POST['url'];
    $key = generate_key($alphabet, $arLen);
    while ($db->find($key)) {
        $key = generate_key($alphabet, $arLen);
    }
    $db->insert($key, $url);
    echo 'http://localhost:8000/'.$key;
} elseif (isset($_GET['key'])) {
    echo $db->find($_GET['key']);
}