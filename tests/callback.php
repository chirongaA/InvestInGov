<?php
header("Content-Type: application/json");
$ipnCallbackResponse = file_get_contents('php://input');
$logFile = "ipn.json";
$log = fopen($logFile, "a");
$log = fwrite($log, $ipnCallbackResponse);
fclose($log);