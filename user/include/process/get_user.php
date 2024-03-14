<?php
// Include your database connection file (replace YOUR_DB_CONNECTION_DETAILS)
require_once("../../../_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['q'])) {
    // Get account number from the query parameter
    $accountNumber = $_GET['q'];
    $count = 0;

    // Check if the account number exists in the database
    $isValidAccount = isValidAccountNumber($accountNumber, $conn , $count);

    // Output the result
    if ($isValidAccount) {
        echo "<span style='color:green;'>Account number is valid </span>.";
    } else {
        echo "<span style='color:red;'>Invalid account number</span>.";
    }

    // Close the database connection
    $conn->close();
}

// Function to validate account number
function isValidAccountNumber($accountNumber, $conn ,$count) {
    // Implement your validation logic
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE account_number = ?");

    // Check if the prepare was successful
    if ($stmt === false) {
        return false;
    }

    $stmt->bind_param("s", $accountNumber);

    // Execute the statement and check for errors
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Check if the account number exists (count > 0)
    return $count > 0;
}
?>
