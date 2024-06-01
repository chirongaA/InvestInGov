<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $bond_id = $_POST['bond_id'];
    $yield = $_POST['yield'];
    $phonenumber = $_POST['phonenumber'];

    $sql = "INSERT INTO payments (username, bond_id, yield, phonenumber, payment_status) VALUES ('$username', '$bond_id', '$yield', '$phonenumber', 'pending')";

    if ($conn->query($sql) === TRUE) {
        header("Location: process_payment.php?username=$username&bond_id=$bond_id&yield=$yield&phonenumber=$phonenumber");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
