<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bond_name = $conn->real_escape_string($_POST['bond_name']);
    $itemName = $conn->real_escape_string($_POST['bond_name']);
    $query = "SELECT * FROM securities WHERE bond_name = '$bond_name'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<p>Bond is available</p>";
    } else {
        echo "<p>Bond is not available</p>";
    }
}
?>
