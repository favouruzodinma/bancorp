<?php
// Include your database connection file (e.g., _db.php)
require_once("../../../_db.php");

// Start the session (if not already started)
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_pass'])) {

    // Get user input
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['npassword'];
    $verifyPassword = $_POST['vpassword'];

    // Validate form fields
    if (empty($currentPassword) || empty($newPassword) || empty($verifyPassword)) {
        // echo "Please fill in all the fields.";
        // You can redirect or show an alert here as needed
        header('Location: ../../change-pwd.php?status=error&message=Please fill in all the fields.');
        exit;
    }

    // Assuming you have a user ID stored in the session
    $userid = $_SESSION['userid'];

    // Fetch the user's current password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE userid = ?");
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify if the entered current password matches the database password
    if (!password_verify($currentPassword, $dbPassword)) {
       // echo "Current password is incorrect.";
        // You can redirect or show an alert here as needed
        header('Location: ../../change-pwd.php?status=error&message=Current password is incorrect');
        exit;
    }

    // Check if the new password and verify password match
    if ($newPassword !== $verifyPassword) {
        //echo "New password and verify password do not match.";
        // You can redirect or show an alert here as needed
        header('Location: ../../change-pwd.php?status=error&message=New password and verify password do not match');
        exit;
    }

    // Hash the new password before updating it in the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE userid = ?");
    $updateStmt->bind_param("ss", $hashedPassword, $userid);
    $updateStmt->execute();
    $updateStmt->close();

    //echo "Password updated successfully!";
    header('Location: ../../change-pwd.php?status=success&message=Password updated successfully!');
    exit;
    // You can redirect or show an alert here as needed
}

// Close the database connection
$conn->close();
?>
