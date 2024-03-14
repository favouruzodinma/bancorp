<!doctype html>
<html lang="en">
   <?php include_once ('include/head.php'); ?>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <?php include_once ('include/navbar.php'); ?>

         
         <!-- TOP Nav Bar -->
         <?php include_once ('include/topbar.php'); ?>
          
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <?php 
         require_once("../_db.php");
            $userid = $_SESSION['userid'];

            // Prepare a statement
            $stmt = $conn->prepare("SELECT* FROM users WHERE userid = ?");
            $stmt->bind_param("s", $userid);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {   
               // Your data retrieval
               $gender = $row['gender'];
               $state = $row['state'];
               $address = $row['address'];
               $maritalStatus = $row['marital_status'];
         ?>
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">

                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-body p-0">
                           <div class="iq-edit-list">
                             <ul class="iq-edit-profile d-flex nav nav-pills">
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link "  href="profile-edit">
                                      Edit Personal Information
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link"  href="change-pwd">
                                       Change Password
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link"  href="change-pin">
                                       Change Pin
                                    </a>
                                 </li>
                                  <li class="col-md-3 p-0">
                                    <a class="nav-link active"  href="manage-contact">
                                       Manage Contact
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
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Manage Contact</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                    <form>
                                       <div class="form-group">
                                          <label for="cno">Phone Number:</label>
                                          <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                                       </div>
                                       <div class="form-group">
                                          <label for="email">Email:</label>
                                          <input type="text" class="form-control" id="email" value="nikjone@demo.com">
                                       </div>
                                       <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
      <?php include("include/footer.php");?>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
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
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      
      <?php include_once ('include/scripts.php'); ?>
   </body>
</html>