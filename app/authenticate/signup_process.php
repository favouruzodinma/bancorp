<?php
// Include your database connection file (e.g., _db.php)
require_once("../../_db.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $phone_number = $_POST['phone_number'];
    $account_type = $_POST['account_type'];
    $currency = $_POST['currency'];
    $password = $_POST['password'];

    // Validate user input (add more validation as needed)
    if (empty($full_name) || empty($email) || empty($address) || empty($country) || empty($phone_number) || empty($account_type) || empty($currency) || empty($password)) {
        $response = array("content" => "Enter all fields");
    } else {
        // Check if the email already exists
        $checkEmailQuery = "SELECT COUNT(*) FROM users WHERE email = ?";
        $checkEmailStmt = $conn->prepare($checkEmailQuery);
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailStmt->bind_result($emailCount);
        $checkEmailStmt->fetch();
        $checkEmailStmt->close();

        if ($emailCount > 0) {
            $response = array("status" => "error", "content" => "Email already exists. Choose a different email.");
        }else {
            // Auto-generate account number (you can customize this logic based on your requirements)
            $account_number = generateAccountNumber();

            // Auto-generate user_id
            $userid = generateUserId();

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Perform database query to insert user data (use prepared statements for security)
            $insertQuery = "INSERT INTO users (userid, full_name, email, address, country, phone_number, account_type, currency, password, account_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);

            
            if ($insertStmt) {
                $insertStmt->bind_param("ssssssssss", $userid, $full_name, $email, $address, $country, $phone_number, $account_type, $currency, $hashed_password, $account_number);
                $insertStmt->execute();
                $insertStmt->close();

                // Registration successful
                $response = [
                    'status' => 'success',
                    'message' => 'Registration successful. You can now login.',
                ];
            } else {
                $response = array("status" => "error", "content" => "Error in database query: " . $conn->error);
            }
        }
    }
} else {
    $response = array("content" => "Invalid request");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Function to generate a random account number
function generateAccountNumber() {
    // Customize the logic to generate a unique account number based on your requirements
    return '01'. mt_rand(1009977000, 9991133999);
}

// Function to generate a random user_id
function generateUserId() {
    // Customize the logic to generate a unique user_id based on your requirements
    return 'BCP' . mt_rand(100000, 999999);
}
?>
