<?php
header("Content-Type: application/json");
$stkCallbackResponse = file_get_contents('php://input');
$logFile = " MpesastkResponse.json";
// Write to file
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$data = json_decode($stkCallbackResponse);