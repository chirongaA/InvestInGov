<?php
include 'db_config.php';

$callbackJSONData = file_get_contents('php://input');
$callbackData = json_decode($callbackJSONData, true);

// Process the callback data
if (isset($callbackData['ResponseCode'])) {
    $resultCode = $callbackData['ResponseCode'];
    $checkoutRequestID = $callbackData['CheckoutRequestID'];

    // Handle success
    if ($resultCode == "0") {
        $sql = "UPDATE payments SET payment_status='fulfilled' WHERE payment_status='pending' AND CheckoutRequestID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $checkoutRequestID);

        if ($stmt->execute()) {
            echo "Payment successful.";
        } else {
            echo "Error updating payment status: " . $conn->error;
        }
    } else {
        echo "Payment failed.";
    }
} else {
    echo "Invalid callback data.";
}

$conn->close();
?>
