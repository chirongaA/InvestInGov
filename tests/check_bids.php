<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bondName = $conn->real_escape_string($_POST['bondName']);
    $query = "SELECT * FROM securities WHERE bondName = '$bondName'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<p>Bond is available</p>";
    } else {
        echo "<p>Bond is not available</p>";
    }
}
?>