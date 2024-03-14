<?php   
  include_once './config.php' ;
  if(isset($_POST['signin'])){
    include_once 'process.php';
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
                            <h1 class="mb-0 dark-signin">Sign in</h1>
                            <p>Enter your email address and password to access admin panel.</p>
                           
                            <form class="needs-validation" novalidate method="post" action="function/signin-process.php">
                            <div class="form-group">
                                    <label for="validationCustom03">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please provide a valid email.
                                       <span class="danger" style="color: red; font-size: medium;"><?php echo isset($emailErr)? $emailErr:""?></span>
                                 </div>
                                </div>
                              <div class="form-row">
                                 <div class="col-md-12 mb-3">          
                                 <a href="recover-password" class="float-right">Forgot password?</a>                   
                                    <label for="validationCustom03">Password</label>
                                    <input type="password" class="form-control" name="password" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please provide a password.
                                       <span class="danger" style="color: red; font-size: medium;"><?php echo isset($emailErr)? $emailErr:""?></span>
                                 </div>
                                 </div>
                                 </div>
                              <div class="d-inline-block w-100">
                                    <button type="submit" name="signin" class="btn btn-primary float-right">Sign In</button>
                                </div>
                                <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">Don't have an account ? <a href="sign-up">Sign Up</a></span>
                                </div>
                           </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="../bancorp.png" class="img-fluid" alt="logo"></a>
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
      <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    // Check if the error parameter is set
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    // Function to show SweetAlert with the stored error message
    function showErrorAlert() {
        const errorMessage = "<?php echo isset($_SESSION['error_message']) ? $_SESSION['error_message'] : ''; ?>";

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                showConfirmButton: true,
            });
        }
    }

    // Call the function when the page loads
    window.onload = function () {
        showErrorAlert();
    };
    </script>

   </body>
</html>