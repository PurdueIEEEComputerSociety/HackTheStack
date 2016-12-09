<?php

require_once 'HackTheStackAPI.php';

$api = new HackTheStackAPI();

if (!isset($_GET['authToken'])) {
    echo 'missing token';
    return;
}
$authToken = $_GET['authToken'];

if ($api::login('','',$authToken, true) === true) {
    echo 'CONGRATULATIONS, YOU WIN! Code: "SUPER_HAPPY_FUNTIEEEME"';
} else {
    echo 'invalid credentials';
}