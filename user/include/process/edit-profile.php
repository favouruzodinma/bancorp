<?php
// Include your database connection file (e.g., _db.php)
require_once("../../../_db.php");

// Start the session (if not already started)
session_start();

// Function to handle profile image upload
function uploadProfileImage() {
    $uploadDir = '../../../profile/'; // Set the path to your upload directory
    $uploadFile = $uploadDir . basename($_FILES['profile_img']['name']);

    if (move_uploaded_file($_FILES['profile_img']['tmp_name'], $uploadFile)) {
        return basename($_FILES['profile_img']['name']);
    } else {
        return false;
    }
}

// Function to update user profile
function updateUserProfile($conn, $userid, $full_name, $marital_status, $country, $city, $age, $address, $gender, $dob, $state, $profile_img) {
    $updateFields = array();
    $bindTypes = "";
    $bindParams = array();

    if (!empty($full_name)) {
        $updateFields[] = "full_name=?";
        $bindTypes .= "s";
        $bindParams[] = $full_name;
    }

    if (!empty($marital_status)) {
        $updateFields[] = "marital_status=?";
        $bindTypes .= "s";
        $bindParams[] = $marital_status;
    }

    if (!empty($country)) {
        $updateFields[] = "country=?";
        $bindTypes .= "s";
        $bindParams[] = $country;
    }

    if (!empty($city)) {
        $updateFields[] = "city=?";
        $bindTypes .= "s";
        $bindParams[] = $city;
    }

    if (!empty($age)) {
        $updateFields[] = "age=?";
        $bindTypes .= "s";
        $bindParams[] = $age;
    }

    if (!empty($address)) {
        $updateFields[] = "address=?";
        $bindTypes .= "s";
        $bindParams[] = $address;
    }

    if (!empty($gender)) {
        $updateFields[] = "gender=?";
        $bindTypes .= "s";
        $bindParams[] = $gender;
    }

    if (!empty($dob)) {
        $updateFields[] = "dob=?";
        $bindTypes .= "s";
        $bindParams[] = $dob;
    }

    if (!empty($state)) {
        $updateFields[] = "state=?";
        $bindTypes .= "s";
        $bindParams[] = $state;
    }

    if (!empty($profile_img)) {
        $updateFields[] = "profile_img=?";
        $bindTypes .= "s";
        $bindParams[] = $profile_img;
    }

    // Check if any field is being updated
    if (empty($updateFields)) {
        return false; // No fields to update
    }

    // Construct the SQL query dynamically
    $sql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE userid=?";
    $bindTypes .= "s";
    $bindParams[] = $userid;

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($bindTypes, ...$bindParams);

    return $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $full_name = $_POST['full_name'];
    $marital_status = $_POST['marital_status'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];

    // Assuming you have a user ID stored in the session
    $userid = $_SESSION['userid'];

    // Handle profile image upload
    $profile_img = uploadProfileImage();

    // Update user profile in the database
    if (updateUserProfile($conn, $userid, $full_name, $marital_status, $country, $city, $age, $address, $gender, $dob, $state, $profile_img)) {
        // $response = array("status" => "success", "message" => "Profile updated successfully");
        header('Location: ../../profile-edit.php?status=success&message=Profile updated successfully');
        exit;
    } else {
        // $response = array("status" => "error", "content" => "Error updating profile");
        header('Location: ../../profile-edit.php?status=error&message=Error updating profile');
        exit;
        
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array("status" => "error", "content" => "Invalid request");
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
