<?php   
  include_once './config.php' ;
  $isError = false;
  $passErr = '';
  
  // Check if the reset code is set
  if (isset($_GET['resetPass'])) {
      $token = $_GET['resetPass'];
  
      // Check if the new password form is submitted
      if (isset($_POST['new_password'])) {
          $new_pass = mysqli_real_escape_string($conn, $_POST['password']);
          $new_pass_c = mysqli_real_escape_string($conn, $_POST['cpass']);
  
          // Grab the token from the session
          $session_token = $_SESSION['reset_token'];
  
          // Check if the session token matches the token in the URL
          if ($token != $session_token) {
              $isError = true;
              $passErr = "
                  <div class='alert text-white bg-danger' role='alert'>
                    <div class='iq-alert-text'><strong>Invalid reset code! Please use the correct reset link.</strong></div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>
              ";
          }
          // The passwords must be more than 6 characters
          elseif (strlen($new_pass) < 7) {
            $isError = true;
            $passErr = "
                <div class='alert text-white bg-danger' role='alert'>
                    <div class='iq-alert-text'><strong>Password must be at least 7 characters long!</strong></div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>
            ";
            
        }
          // Check if passwords match
          elseif ($new_pass !== $new_pass_c) {
              $isError = true;
              $passErr = "
                  <div class='alert text-white bg-danger' role='alert'>
                    <div class='iq-alert-text'><strong>New Password and Confirm Password don't match!</strong></div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>
              ";
          }
  
          // If there are no errors, proceed with the password update
          elseif ($isError == false) {
              // Select the email address of the user from the admin table
              $sql = "SELECT email FROM `admin` WHERE reset_token='$token' ";
              $results = mysqli_query($conn, $sql);
              $email = mysqli_fetch_assoc($results)['email'];
  
              if ($email) {
                  // Update the user's password
                  $sql = "UPDATE `admin` SET password='$new_pass' WHERE email='$email'";
              $results = mysqli_query($conn, $sql);
              if ($results) {
                $passErr = "
                <div class='alert text-white bg-success' role='alert'>
                    <div class='iq-alert-text'><strong>Password successfully changed</strong></div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>
                ";
  
                // Add a timer to redirect the user after 5 seconds
                echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var successMessage = document.getElementById('successMessage');
                        if (successMessage) {
                            setTimeout(function() {
                                window.location.href = 'sign-in';
                            }, 5000); // 5000 milliseconds = 5 seconds
                        }
                    });
                </script>
                ";
            }
             
              }
          }
      }
  } else {
      // If resetPass is not set in the URL, display an error
      $isError = true;
      $passErr = "
          <div class='alert  alert-danger' role='alert'>
                    <div class='iq-alert-text'><strong>No reset code found! Please use the correct reset link.</strong></div>
                    <button type='button' class='close text-danger' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>
      ";
  }
  ?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Bancorp | Admin</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/bancorp-img.jpeg" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0 dark-signin">Reset Password</h1>
                            <!-- <p>Enter your email address and password to access admin panel.</p> -->
                          
                            <form class="needs-validation" novalidate method="post" action="reset-password?resetPass=<?php echo $token; ?>">
                                <span class="danger" id="successMessage" style="color: red; font-size: medium;"><?php echo isset($passErr)? $passErr:""?></span>
                                 <div class="form-group">
                                    <label for="validationCustom03">New Password:</label>
                                    <input type="text" name="password" class="form-control" minlength="6" name="newpass" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please provide  your new password.
                                 </div>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom03">Verify Password:</label>
                                    <input type="text" name="cpass" class="form-control" minlength="6" name="cnewpass" id="validationCustom03" required>
                                    <!-- <span class="danger" style="color: red; font-size: medium;"><?php echo isset($passErr)? $passErr:""?></span> -->
                                    <div class="invalid-feedback">
                                       Please re-enter your new password.
                                 </div>
                                </div>
                                <button type="submit" name="new_password" class="btn btn-primary mr-2">Submit</button>
                           </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="images/bancorp.png" class="img-fluid" alt="logo"></a>
                            <div class="slick-slider11" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage Users</h4>
                            <p>Efficiently handle user accounts, view details, and manage access permissions with Bancorp's user management system.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage Transactions</h4>
                            <p>Keep track of all transactions, view transaction history, and ensure smooth financial operations using Bancorp's transaction management features.</p>
                                </div>
                                <div class="item">
                                    <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Card Verification</h4>
                            <p>Securely verify and manage card information to ensure the integrity and safety of financial transactions within Bancorp's platform.</p>
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
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>