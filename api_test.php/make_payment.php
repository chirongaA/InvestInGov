<?php
include 'db_config.php';

$username = $_GET['username'];
$bond_id = $_GET['bond_id'];

$sql = "SELECT * FROM bids WHERE username='$username' AND bond_id='$bond_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $yield = $row['yield'];
} else {
    die("No matching bid found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Make Payment</h2>
        <form action="initiate_payment.php" method="POST" id="paymentForm" onsubmit="return validateAndFormatPaymentForm();" >
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
            <label for="bond_id">Bond ID:</label>
            <input type="text" id="bond_id" name="bond_id" value="<?php echo $bond_id; ?>" readonly>
            <label for="yield">Yield:</label>
            <input type="number" id="yield" name="yield" value="<?php echo $yield; ?>" readonly>
            <label for="phonenumber">Phone Number:</label>
            <input type="number" id="phonenumber" name="phonenumber" required>
            <button type="submit">Make Payment</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
