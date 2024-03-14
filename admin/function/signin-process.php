<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
    // Include your database connection file (e.g., _db.php)
    require_once("../../_db.php");

    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user input (add more validation if needed)
    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Please provide both email and password.";
    } else {
        // Perform database query to check user credentials (use prepared statements for security)
        $query = "SELECT userid, email, password FROM admin WHERE email = ?";
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
                    // Store userid and email in sessions
                    $_SESSION['userid'] = $user['userid'];
                    $_SESSION['email'] = $user['email'];

                    // Redirect to a dashboard or home page
                    header('Location: ../home');
                    exit;
                } else {
                    // Incorrect password
                    $_SESSION['error_message'] = "Incorrect password.";
                }
            } else {
                // User not found
                $_SESSION['error_message'] = "User not found.";
            }
        } else {
            // Error in database query
            $_SESSION['error_message'] = "Error in database query.";
        }
    }
} else {
    // Invalid request
    $_SESSION['error_message'] = "Invalid request.";
}

// Redirect back to the login page with an error message, if any
header('Location: ../sign-in.php');
exit;
?>
