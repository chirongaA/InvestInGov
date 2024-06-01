<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid Submission Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Bid Submission Form</h2>
        <form action="submit_bid.php" method="POST" id="bidForm">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="bond_id">Bond ID:</label>
            <input type="text" id="bond_id" name="bond_id" required>
            <label for="yield">Yield:</label>
            <input type="number" id="yield" name="yield" required>
            <label for="facevalue">Face Value:</label>
            <input type="number" id="facevalue" name="facevalue" required>
            <label for="maturity">Maturity:</label>
            <input type="number" id="maturity" name="maturity" required>
            <label for="rate">Rate:</label>
            <input type="number" id="rate" name="rate" required>
            <button type="submit">Submit Bid</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
