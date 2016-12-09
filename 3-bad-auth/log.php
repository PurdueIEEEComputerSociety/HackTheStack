<?php
$filename = "lastRequest.txt";

if (isset($_GET['data'])) {
    $tokenFile = fopen("lastRequest.txt", "w") or die("Unable to open file!");
    fwrite($tokenFile, $_GET['data']);
    fclose($tokenFile);
    echo "";
} else {
    $logContents = file_get_contents('lastRequest.txt');
    echo $logContents;
}
