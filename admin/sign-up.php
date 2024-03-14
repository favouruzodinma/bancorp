<?php   
 include_once './include/head.php' ;
  if(isset($_POST['signUp'])){
    include_once 'process.php';
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
        <section class="sign-in-">
            <div class="container mt-5 p-0 bg-white">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Sign Up</h1>
                            <p>Admin | Unauthorized Access.</p>
                            <span class="text-success"><?php echo isset($response)? $response: ""?></span>
                            
                            <form class="needs-validation" novalidate method="post" action="sign-up.php">
                              <div class="form-row">
                                 <div class="col-md-12 mb-3">
                                    <label for="validationCustom02">Full name</label>
                                    <input type="text" class="form-control" name="fullname" id="validationCustom01"  required>
                                    <div class="invalid-feedback">
                                       Please provide Full name.
                                    </div>
                                 </div>
                              
                                 <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="validationCustom03" required>
                                    <span class="text-danger" style="color: red; font-size:smaller;" ><?php echo isset($emailErr)? $emailErr:""?></span>
                                    <div class="invalid-feedback">
                                       Please provide a valid email.
                                    </div>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" id="validationCustom03" required>
                                    <span class="text-danger" style="color: red; font-size:smaller;"><?php echo isset($phoneErr)? $phoneErr:""?></span>
                                    <div class="invalid-feedback">
                                       Please provide a phone number.
                                    </div>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="validationCustom05">Password</label>
                                    <input minlength="6" type="text" class="form-control" name="pass" id="validationCustom05" required>
                                    <div class="invalid-feedback">
                                       Please provide a password.
                                       <span class="text-danger" style="color: red; font-size:smaller;"><?php echo isset($passErr)? $passErr:""?></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="validationCustom05">Confirm Password</label>
                                    <input minlength="6" type="text" class="form-control" name="cpass" id="validationCustom05" required>
                                    <div class="invalid-feedback">
                                       Please confirm password.
                                    </div>
                                 </div>
                              </div>
                              <div class="d-inline-block w-100">
                                    <button type="submit" name="signUp" class="btn btn-primary float-right">Sign Up</button>
                                </div>
                                <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">Already Have Account ? <a href="sign-in">Log In</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div>
                              
                           </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="#"><img src="images/bancorp.png" class="img-fluid" alt="logo"></a>
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
      <?php   
 include_once './scripts.php' ;
?>