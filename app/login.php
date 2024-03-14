﻿<!doctype html>
<html lang="en">
<?php
session_start();

// Check if the 'userid' session is not set
if (isset($_SESSION['userid'])) {
    // Redirect to the login page
    header("location: ../user/dashboard");
    exit();
}

// ... rest of the dashboard code
include_once ('../_db.php')
?>
<head>
        <meta charset="utf-8">
        <title>bancorp | ACCOUNT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue to Bancorp.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                       
                            <div class="card-body pt-0"> 
                                <div class="auth-logo">
                                    <a class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>

                                    <a class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <!-- <p class="response"></p> -->
                                    <form class="form-horizontal" method="POST" id="login_form">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email | Account Number</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Or Account Number">
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" id="password">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                       <!--  <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-check">
                                            <label class="form-check-label" for="remember-check">
                                                Remember me
                                            </label>
                                        </div> -->
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                        </div>
            
                                        <div class="mt-4 text-center">
                                             <p>Don't have an account ? <a href="signup" class="fw-medium text-primary"> Signup now </a> </p>
                                        </div>

                                        <!-- <div class="mt-4 text-center">
                                            <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                        </div> -->
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>©<script>document.write(new Date().getFullYear())</script> Powered by <i class="bx bx-check-shield text-success"></i> by bancorp</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

 <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- validation init -->
        <script src="assets/js/pages/validation.init.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <!-- Bootstrap Toasts Js -->
        <script src="assets/js/pages/bootstrap-toastr.init.js"></script>

    </body>
</html>
<script src="//code.tidio.co/zldbtzujw9nyceuxopifmfzsvkmzoumw.js" async=""></script>
<style>
    /* Positioning for the floating WhatsApp button */
#floating-whatsapp {
  position: fixed;
  bottom: 40px;
  left: 20px;
  z-index: 9999;
}

/* Styling for WhatsApp icons */
.whatsapp-icon {
  width: 50px;
  height: 50px;
  margin: 5px;
}
</style>
<div id="floating-whatsapp">
    <a href="https://api.whatsapp.com/send?phone=447477466492" target="_blank">
      <img class="whatsapp-icon" src="../whatsapp-icon.png" alt="WhatsApp Support 1">
    </a>
</div>
<div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
    <div id="ErrorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../bancorp.png" alt="" class="me-2" height="18">
            <strong class="me-auto">Error</strong>
            <small>Now..</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="background-color:red;">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>


<div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../bancorp.png" alt="" class="me-2" height="18">
            <strong class="me-auto">Success</strong>
            <small>Now..</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="background-color:#c8f560;">
           

        </div>
    </div>
</div>



<script src="../npm/sweetalert2%4011"></script>
<script>
$(document).ready(function(){
    $('#login_form').on('submit', function(e){
        e.preventDefault();
        $(".response").html("Loading...<div class='spinner-border spinner-border-sm' role='status'><span class='sr-only'>Loading...</span></div>")
        var email = $('#email').val();
        var password = $('#password').val();

        if(email == '' || password == '') {
            $(".toast-body").html('Enter all fields');
            $("#ErrorToast").toast("show");
            $(".response").html("");
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: 'authenticate/login_process.php',
            data: {email: email, password: password},
            dataType: "json",
            success: function(data){
                $(".response").html(data.content);

                if (data.status === 'success') {
                    // Registration successful
                    $(".toast-body").html(data.content);
                    $("#successToast").toast("show");
                    
                    // Redirect after 5 seconds
                    if (data.redirect) {
                        setTimeout(function () {
                            window.location.href = data.redirect;
                        }, 2000);
                    }
                    // Optionally, you can redirect the user to another page or perform additional actions
                } else if(data.status === 'error') {
                    // Registration failed
                    $(".toast-body").html(data.content);
                    $("#ErrorToast").toast("show");
                }
            },

            error: function(data, errorThrown){
               Swal.fire('The Internet?', 'Check network connection!', 'question');
            }
        });
    });
});


</script>

<script>
function login(id){
    id.innerHTML = "Verifying account..";
    setTimeout(function(){
    id.innerHTML = "Log in";
    }, 3000);
    }
</script>