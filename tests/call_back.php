<?php
include 'database.php';

// Get the raw POST data from M-Pesa
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

if (isset($data['Body']['stkCallback']['ResultCode'])) {
    $resultCode = $data['Body']['stkCallback']['ResultCode'];
    $checkoutRequestID = $data['Body']['stkCallback']['CheckoutRequestID'];

    if ($resultCode == 0) {
        // Transaction was successful
        $amount = $data['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $mpesaReceiptNumber = $data['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $phoneNumber = $data['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

        // Here you can update the order status in the database
        $sql = "UPDATE payments SET payment_status = 'completed', mpesa_receipt_number = '$mpesaReceiptNumber' WHERE checkout_request_id = '$checkoutRequestID'";
        $conn->query($sql);
    } else {
        // Transaction failed
        $sql = "UPDATE payments SET payment_status = 'failed' WHERE checkout_request_id = '$checkoutRequestID'";
        $conn->query($sql);
    }
}
?>