<?php
include_once "../admin/config.php";

$isError = false;
// $response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sign Up Process
    if (isset($_POST['signUp'])) {
        $fullname = cleanInput($_POST['fullname']);

        if (empty($_POST['email'])) {
            $emailErr = "Email is required!";
            $isError = true;
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Email is Invalid!';
            $isError = true;
        } else {
            $email = cleanInput($_POST['email']);
            $sql = $conn->query("SELECT email FROM admin WHERE email='$email'");
            if ($sql->num_rows > 0) {
                $emailErr = "Email is already taken!!!";
                $isError = true;
            }
        }

        if (empty($_POST['phone'])) {
            $phoneErr = "Phone Number is required!";
            $isError = true;
        } elseif (strlen($_POST['phone']) < 10) {
            $phoneErr = "Phone Number is invalid!!";
            $isError = true;
        } else {
            $phone = cleanInput($_POST['phone']);
            $sql = $conn->query("SELECT phone FROM admin WHERE phone='$phone'");
            if ($sql->num_rows > 0) {
                $phoneErr = "Phone Number is already taken!!!";
                $isError = true;
            }
        }

        if (empty($_POST['pass'])) {
            $isError = true;
        } elseif (strlen($_POST['pass']) < 6) {
            $passErr = "Password is too short!!";
            $isError = true;
        } else {
            $password = cleanInput($_POST['pass']);
        }

        if (empty($_POST['cpass'])) {
            $isError = true;
        } else {
            $confirmpass = cleanInput($_POST['cpass']);
            if ($password !== $confirmpass) {
                $isError = true;
            }
        }

        if ($isError === false) {
            // Generate userid
            $userid = rand(90876, 34576);
            $sql = $conn->query("INSERT INTO admin SET userid='$userid', fullname='$fullname', email='$email', phone='$phone', password='$password', confirmPassword='$confirmpass'");
            if ($sql) {
                $response = '<div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">Registration Successful</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>';
                
            } else {
                $response = '<div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">Registration Failed</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>';
            }
            header('Location: sign-up');
        }
    } elseif (isset($_POST['signin'])) {
        // Admin Sign In Process
        $email = cleanInput($_POST['email']);
        $password = cleanInput($_POST['password']);
        $sql = $conn->query("SELECT * FROM `admin` WHERE password='$password' AND email='$email'");
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $_SESSION['signin'] = true;
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            ?>
            <script>alert('Welcome');
                window.location.replace('home')</script>
            <?php
        } else {
            ?>
            <script>alert('Email or Password is Incorrect!')</script>
            <?php
        }
    }
}
?>
