 
<?php include_once "include/head.php" ?>


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
         <?php include_once "include/sidebar.php" ?>
         <!-- TOP Nav Bar -->
         <?php  include_once 'include/navbar.php' ; ?>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <?php 
         require_once("../_db.php");
            $userid = $_SESSION['userid'];

            // Prepare a statement
            $stmt = $conn->prepare("SELECT* FROM admin WHERE userid = ?");
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
                     <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                           <div class="profile-header">
                           <div class="bg-primary card">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h6 class="text-light">Welcome Back !</h6>
                                            <p class="text-light" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight:900; font-size:20px"><?php echo ucfirst($row['name']); ?>.</p>
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
                  <?php }} ?>
                  
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-lg-6">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h6 class="card-title">Pendng KYC</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h4 class="mb-0" style="position: relative; left:-26px"><?php echo 
                    $conn->query("SELECT * FROM `users` where kyc_status='pending'") ->num_rows;?></</h4>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
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
                                    <h6 class="card-title">Crypto Transfers</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h4 class="mb-0" style="position: relative; left:-26px">0</h4>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
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
                                    <h6 class="card-title">Loan Request</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h4 class="mb-0" style="position: relative; left:-26px">0</h4>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
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
                                    <h6 class="card-title">Manage Users</h6>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                              <div class="media" style="display: flex; justify-content:space-between; align-items:center">
                                     <div class="media-body ml-3">
                                       <h4 class="mb-0" style="position: relative; left:-26px"><?php echo 
                    $conn->query("SELECT * FROM `users`") ->num_rows;?></h4>
                                    </div>
                                    <div class="rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
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
                              <h5 class="card-title">Recent Bank Transactions</h5>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>No Transaction Found!</p>
                           <!-- HTML to write -->
                           <a href="transactions" data-toggle="tooltip" title="more transactions!">View More</a>
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
               </div>
            </div>
         </div>
      </div>
      <!-- <?php # }} ?> -->
      <!-- Wrapper END -->
      <!-- Footer -->
   <?php include_once "include/footer.php" ?>
   <?php include_once "include/scripts.php" ?>
   </body>
</html>