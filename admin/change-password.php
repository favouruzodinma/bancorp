<?php 
include_once 'include/head.php'; 

?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "include/sidebar.php" ?>

<body>

<!-- Loader Start -->
<div id="loading">
   <div id="loading-center"></div>
</div>
<!-- Loader END -->

<!-- Wrapper Start -->
<div class="wrapper">

   <?php include_once 'include/navbar.php' ; ?>

   <?php  
      $userid=$_SESSION['userid'];
      $sql= $conn->query(" SELECT * FROM admin WHERE userid='$userid'");
      if($sql->num_rows>0){
         while($row=$sql->fetch_assoc()){  
   ?>  

   <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="iq-card">
                  <div class="iq-card-body p-0">
                     <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                           <li class="col-md-6 p-0">
                              <a class="nav-link "  href="profile">
                                 Personal Information
                              </a>
                           </li>
                           <li class="col-md-6 p-0">
                              <a class="nav-link active"  href="change-password">
                                 Change Password
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>

            

            
            <div class="col-lg-12">
               <div class="iq-edit-list-data">
                  <div class="tab-content">
                     <div class="">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Change Password</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                    <form class="needs-validation" novalidate method="post" action="change-password">
                                    <?php
                              if (isset($_POST['change_pass'])){
                                 
                              $password = (cleanInput($_POST['password']));
                              $newpass = (cleanInput($_POST['newpass']));
                              $cnewpass = (cleanInput($_POST['cnewpass']));
                              $email = $_SESSION['email'];

                              $sql = $conn->query("SELECT email  AND password FROM admin WHERE email='$email' AND password='$password' ");
                              if($sql->num_rows > 0){
                                 if($newpass === $cnewpass){
                              $sql = $conn->query("UPDATE admin SET password='$newpass' WHERE email='$email' AND password='$password' ");
                              header('Location: change-password.php?status=success&message=Password updated successfully!');
                              exit;
                              //  echo 'You have successfully updated your password ';
                              }else {
                                 header('Location: change-password?status=error&message=New password and verify password do not match');
                                 exit;
                              }
                              }else {
                                 
                              header('Location: change-password?status=error&message=Wrong Password details');
                              exit;
                              }
                              }
                              ?>
                              <div class="form-row">
                                 <div class="col-md-12 mb-3">          
                                 <a href="recover-password" class="float-right">Forgot password?</a>                   
                                    <label for="validationCustom03">Current Password:</label>
                                    <input type="text" class="form-control" minlength="6" name="password" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please provide your current password.
                                       <span class="danger" style="color: red; font-size: medium;"><?php echo isset($passErr)? $passErr:""?></span>
                                 </div>
                                 </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="validationCustom03">New Password:</label>
                                    <input type="text" class="form-control" minlength="6" name="newpass" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please provide  your new password.
                                       <span class="danger" style="color: red; font-size: medium;"><?php echo isset($passErr)? $passErr:""?></span>
                                 </div>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom03">Verify Password:</label>
                                    <input type="text" class="form-control" minlength="6" name="cnewpass" id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                       Please re-enter your new password.
                                       <span class="danger" style="color: red; font-size: medium;"><?php echo isset($passErr)? $passErr:""?></span>
                                 </div>
                                 
                                </div>
                                <button type="submit" name="change_pass" class="btn btn-primary mr-2">Submit</button>
                           </form>
                                 </div>
                              </div>
                           </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php }} ?>

   <!-- Wrapper END -->

   <!-- Footer -->
   <?php include_once 'include/footer.php' ; ?>
   <div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
      <div id="ErrorToast" class="alert text-white bg-danger toast" role="alert"  aria-live="assertive" aria-atomic="true">
            <div class="iq-alert-icon">
               <i class="ri-information-line"></i>
            </div>
            <div class="iq-alert-text toast-body"> 
               
               </div>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="ri-close-line"></i>
            </button>
         </div>
      </div>
      
     


      <div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
         <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
               <img src="../Bancorp.png" alt="" class="me-2" height="18">
                  <strong class="me-auto">Success</strong>
                  <small>Now..</small>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background-color:#c8f560;">
               
         </div>
      </div>
   </div>
</body>
<?php include_once "include/scripts.php" ?>
</html>

     