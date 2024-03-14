<?php
// kyc.php
// session_start();
require_once("../../../_db.php"); // Make sure to include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload-kyc'])) {
    // Get the user ID
    $userid = $_POST['userid']; // Replace this with the actual user ID

    // File upload handling
    if (isset($_FILES['kyc']) && $_FILES['kyc']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['kyc']['tmp_name'];
        $fileName = $_FILES['kyc']['name'];
        
        // Specify the directory where you want to store the uploaded file
        $uploadDirectory = "kyc-folder/"; // Change this to your desired directory

        // Ensure the target directory exists
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Move the uploaded file to the specified directory
        $targetFilePath = $uploadDirectory . basename($fileName);

        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            // Update the user_login table with the file path for the user's KYC
            $updateQuery = "UPDATE users SET kyc = ? WHERE userid = ?";
            $stmt = $conn->prepare($updateQuery);

            if ($stmt) {
                $stmt->bind_param("ss", $targetFilePath, $userid);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo "KYC image uploaded successfully!";
                    header('Location: ' . $_SERVER["HTTP_REFERER"]);
                    exit();
                } else {
                    echo "Failed to update KYC image!";
                }

                $stmt->close();
            } else {
                echo "Prepare statement error: " . $conn->error;
            }
        } else {
            echo "File upload failed!";
        }
    } else {
        echo "No file uploaded or an error occurred during upload.";
    }
}
?>
