<?php
include_once './include/head.php';


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';


if (isset($_POST['resetPass'])) {
    $email = $_POST['email'];
    $check_email = mysqli_query($conn, "SELECT * FROM `admin` WHERE email= '$email' ");
    $res = mysqli_num_rows($check_email);

    if ($res > 0) {
      // $resetToken = bin2hex(random_bytes(16)); // Generate a reset token
      $resetToken = rand(9087, 34576);
      $_SESSION['reset_token']= $resetToken;
        // Store the token and its expiration time in the database
        // Example query: UPDATE admin SET reset_token = '$resetToken', reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = '$email'
        $updateTokenQuery = "UPDATE admin SET reset_token = '$resetToken', reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = '$email'";
        mysqli_query($conn, $updateTokenQuery);

        $to = $email;
        $subject = "Reset Password";

        // Headers for HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // Your HTML and CSS content
        $message = "
        <html>
        <head>
          <style>
            body {
              font-family: Arial, sans-serif;
              background-color: #f4f4f4;
              color: #333;
            }
            .container {
              max-width: 500px;
              margin: 0 auto;
              padding: 20px;
              background-color: #fff;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
          </style>
        </head>
        <body>
          <div class='container'>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Here is your password reset Link <b><a href=\"http://localhost/bancorp/admin/reset-password?resetPass=" . $resetToken . "\"></a></b></p>
          </div>
        </body>
        </html>
        ";

        // Additional headers
        $headers .= "From: bancorp.org" . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            $emailErr = "
                <div class='alert alert-info alert-dismissible'>
                We've sent a reset link to your email - $email
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
                ";
                header('Location: confirm-mail');
        } else {
            echo "Failed to send email notification to the user.";
        }
    } else {
        $emailErr = "<div class='alert alert-danger alert-dismissible'>
      $email - We don't recognize this email!!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
}
?>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container mt-5 p-0 bg-white">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Reset Password</h1>
                            <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                            <form class="needs-validation" novalidate method="post" action="#">
                            <div class="form-group">
                                    <label for="validationCustom03">Email Address</label>
                                    <input type="email" placeholder="email@gmail.com" class="form-control" name="email" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please provide a valid email.
                                       <span class="danger" style="color: red; font-size: medium;"><?php echo isset($emailErr)? $emailErr:""?></span>
                                 </div>
                                </div>
                              <div class="d-inline-block w-100">
                                    <button type="submit" name="resetPass" class="btn btn-primary float-right">Reset Password</button>
                                </div>
                               
                              
                           </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid" alt="logo"></a>
                            <div class="slick-slider11">
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>