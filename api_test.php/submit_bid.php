<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $bond_id = $_POST['bond_id'];
    $yield = $_POST['yield'];
    $facevalue = $_POST['facevalue'];
    $maturity = $_POST['maturity'];
    $rate = $_POST['rate'];

    $sql = "INSERT INTO bids (username, bond_id, yield, facevalue, maturity, rate) VALUES ('$username', '$bond_id', '$yield', '$facevalue', '$maturity', '$rate')";

    if ($conn->query($sql) === TRUE) {
        echo "Bid submitted successfully. Proceed to <a href='make_payment.php?username=$username&bond_id=$bond_id'>make payment</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
