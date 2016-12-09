<?php

require_once 'HackTheStackAPI.php';

$api = new HackTheStackAPI();

$api::process();
echo json_encode($api::$response);