<?php
// Include your database connection file (e.g., _db.php)
require_once("../../_db.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user input (add more validation as needed)
    if (empty($email) || empty($password)) {
        $response = array("status" => "error", "content" => "Enter all fields");
    } else {
        // Perform database query to check user credentials (use prepared statements for security)
        $query = "SELECT userid, email, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result->num_rows > 0) {
                // User found, check password
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    // Password is correct
                    $response = array("status" => "success", "content" => "SuccessFul: You will be redirected Now");

                    // Store userid and email in sessions
                    session_start();
                    $_SESSION['userid'] = $user['userid'];
                    $_SESSION['email'] = $user['email'];

                    // Add JavaScript code for redirection after 5 seconds
                    $response['redirect'] = '../user/dashboard';
                } else {
                    // Incorrect password
                    $response = array("status" => "error", "content" => "Error: Incorrect password");
                }
            } else {
                // User not found
                $response = array("status" => "error", "content" => "Error: User not found");
            }
        } else {
            $response = array("status" => "error", "content" => "Error in database query");
        }
    }
} else {
    $response = array("status" => "error", "content" => "Invalid request");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
