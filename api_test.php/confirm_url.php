<?php
session_start(); // Start the session at the beginning of the script
$mpesaResponse = file_get_contents('php://input');

if (!empty($mpesaResponse)) {
    $mpesaResponse = json_decode($mpesaResponse, true);

    $requireAmount = $_SESSION['yield']; // Get the 'yield' value from the session
    $requireAmount = 1;
    $imv = $mpesaResponse['BillRefNumber'];
    if($mpesaResponse['TransAmount'] != $requireAmount)
    {
        $response = array("ResultCode" =>1, "ResultDesc" => "Rejected");
    }
    else
    {
        $response = array("ResultCode" =>0, "ResultDesc" => "Accepted");
    }

    $logFile ="M_PESAConfirmationResponse.txt";
    $log = fopen($logFile,"a");
    fwrite($log, $mpesaResponse);
    fclose($log);
} else {
    $response = array("ResultCode" =>1, "ResultDesc" => "No data received");
}

header("Content-Type: application/json");
echo json_encode($response);
?>
