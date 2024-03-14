<?php
// Include your database connection file (e.g., _db.php)
require_once("../_db.php");

// Function to generate a random 4-digit OTP
function generateOTP() {
    return sprintf('%04d', mt_rand(0, 9999));
}

// Function to send email with OTP
function sendEmailWithOTP($email, $otp) {
    // Set the recipient's email
    $to = $email;

    // Subject of the email
    $subject = 'OTP Code for Transaction PIN Change';

    // Message content
    $message = "Your OTP code for Transaction PIN change is: $otp";

    // Send the email
    return mail($to, $subject, $message);
}

// Function to check if OTP is correct and not expired
function validateOTP($email, $enteredOTP) {
    global $conn;

    // Assuming you have a table named 'otp_codes'
    $stmt = $conn->prepare("SELECT * FROM otp_codes WHERE email = ? AND otp = ? AND expiry_time > NOW()");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $enteredOTP);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    } else {
        return false;
    }
}

// Function to update transaction PIN
function updateTransactionPIN($email, $newPIN) {
    global $conn;

    // Assuming you have a table named 'users' and a column 'transaction_pin'
    $stmt = $conn->prepare("UPDATE users SET transaction_pin = ? WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $newPIN, $email);
        $stmt->execute();
        $stmt->close();

        return true;
    } else {
        return false;
    }
}

// Main logic for OTP generation, validation, and PIN update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_otp'])) {
    $email = $_POST['email'];

    // Generate and store OTP in the database
    $otp = generateOTP();
    $expiryTime = date('Y-m-d H:i:s', strtotime('+5 minutes')); // OTP expires in 5 minutes

    // Store OTP in the database
    $insertStmt = $conn->prepare("INSERT INTO otp_codes (email, otp, expiry_time) VALUES (?, ?, ?)");
    if ($insertStmt) {
        $insertStmt->bind_param("sss", $email, $otp, $expiryTime);
        $insertStmt->execute();
        $insertStmt->close();

        // Send OTP to the user's email
        if (sendEmailWithOTP($email, $otp)) {
            echo "OTP sent successfully. Check your email.";

            // Redirect or display a form to enter OTP and new PIN
        } else {
            echo "Failed to send OTP. Please try again.";
        }
    } else {
        echo "Error generating OTP. Please try again.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $email = $_POST['email'];
    $enteredOTP = $_POST['entered_otp'];
    $newPIN = $_POST['new_pin'];
    $confirmNewPIN = $_POST['confirm_new_pin'];

    // Validate OTP
    if (validateOTP($email, $enteredOTP)) {
        // Check if new PIN and confirm new PIN match
        if ($newPIN === $confirmNewPIN) {
            // Update transaction PIN
            if (updateTransactionPIN($email, $newPIN)) {
                echo "Transaction PIN updated successfully!";
            } else {
                echo "Error updating transaction PIN. Please try again.";
            }
        } else {
            echo "New PIN and confirm new PIN do not match. Please try again.";
        }
    } else {
        echo "Invalid or expired OTP. Please try again.";
    }
}
?>
