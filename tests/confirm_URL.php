<?php
$mpesaResponse = file_get_contents('php://input');
$mpesaResponse = json_decode($mpesaResponse, true);

$requireAmount = 100;
$imv =$jsonMpesaResponse['BillRefNumber'];
if($jsonMpesaResponse['TransAmount']!= $requireAmount)
{
    $response = array("ResultCode" =>1, "ResultDesc" => "Rejected");
    echo json_encode($response);
}
else
{
    $response = array("ResultCode" =>0, "ResultDesc" => "Accepted");
    echo json_encode($response);
}

$logFile ="M_PESAConfirmationResponse.txt";
$log =fopen($logfile,"a");
fwrite($log, $mpesaResponse);
fclose($log);
header("context-Type: application/lson");
echo json_encode($response);
?>