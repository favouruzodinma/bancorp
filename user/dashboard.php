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
         ?>
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card ">
                        <div class="iq-card-body profile-page p-0">
                           <div class="profile-header">
                           <div class="bg-primary card">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h6 class="text-light">Welcome Back !</h6>
                                            <p class="text-light" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight:900; font-size:20px"><?php echo ucfirst($row['full_name']); ?>.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-lg-6">
                           <div class="iq-card ">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h6 class="card-title" style="font-size: 13px;">Account Balance</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content: space-between; align-items: center">
                                 <div class="media-body ml-3">
                                    <h5 class="mb-0" id="balanceDisplay" style="position: relative; left: -14px; font-weight: 900">
                                          <?php echo $row['currency'] ?><?php echo str_repeat('*', strlen(number_format($row['main_balance'], 2))); ?>
                                    </h5>
                                 </div>
                                 <div class="rounded" id="eyeIcon" onclick="toggleVisibility()">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                    <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                                 </svg>
                                 </div>
                              </div>
                              <script>
                                 function toggleVisibility() {
                                    var balanceElement = document.getElementById('balanceDisplay');
                                    var eyeIconElement = document.getElementById('eyeIcon');

                                    // Toggle visibility of the balance and change the eye icon
                                    if (balanceElement.innerHTML.includes('*')) {
                                          balanceElement.innerHTML = '<?php echo $row['currency'] ?>' + '<?php echo number_format($row['main_balance'], 2); ?>';
                                          eyeIconElement.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/></svg>';
                                    } else {
                                          balanceElement.innerHTML = '<?php echo $row['currency'] ?>' + '<?php echo str_repeat('*', strlen(number_format($row['main_balance'], 2))); ?>';
                                          eyeIconElement.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/><path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/></svg>';
                                    }
                                 }
                              </script>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h6 class="card-title" style="font-size: 13px;">Overdraft</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h5 class="mb-0" style="position: relative; left:-12px ;font-weight:900"><?php echo $row ['currency'] ?>0</h5>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="font-weight:900" width="26" height="36" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                                    </svg>
                                    </div>
                              </div>
                              </div>
                           </div>
      
                        </div>
                     </div>
                  </div>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-lg-6">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h6 class="card-title" style="font-size: 13px;">Account Number</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h5 class="mb-0" style="position: relative; left:-18px; font-weight: 900;"><?php echo $row ['account_number'] ?></h5>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16" style="font-weight:900">
                                    <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
                                    </svg>
                                    </div>
                              </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h6 class="card-title" style="font-size: 13px;" >Account Type</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h5 class="mb-0" style="position: relative; left:-18px ; font-weight:900"><?php echo $row ['account_type'] ?> Account</h5>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
                                    <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293z"/>
                                    </svg>
                                    </div>
                              </div>
                              </div>
                           </div>
      
                        </div>
                     </div>
                  </div>
                  


                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h5 class="card-title" style="font-weight: 900;">Recent Bank Transactions</h5>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>No Transaction Found!</p>
                           <!-- HTML to write -->
                           <a href="#" data-toggle="tooltip" title="Some tooltip text!">View More</a>
                           <!-- Generated markup by the plugin -->
                           <!-- <div class="tooltip bs-tooltip-top" role="tooltip">
                              <div class="arrow"></div>
                              <div class="tooltip-inner">
                                 Some tooltip text!
                              </div>
                           </div> -->
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h5 class="card-title" style="font-weight: 900;">Recent Crypto  Transactions</h5>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>No Transaction Found!</p>
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
      <?php include_once ('include/scripts.php'); ?>
   </body>
</html>