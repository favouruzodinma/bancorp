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
                  <style>

         .pin-container {
               display: flex;
               gap: 10px;
         }

        .pin-container input {
               width: 50px;
               height: 50px;
               text-align: center;
               font-size: 18px;
         }
         </style>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title" style="font-size: 17; font-weight:800">USDT Transfer</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                                    <form>
                                       <div class="form-group row align-items-center">
                                          <label class="col-md-3" for="emailnotification">Select Account</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="form-group">
                                          <input type="text" class="form-control" >
                                       </div>
                                          </div>
                                       </div>
                                       <div class="form-group row align-items-center">
                                          <label class="col-md-3" for="smsnotification">Wallet Address</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="form-group">
                                             <input type="text" class="form-control" >
                                          </div>
                                          </div>
                                       </div>

                                       <div class="form-group row align-items-center">
                                          <label class="col-md-3" for="smsnotification">Select Crypto</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="form-group">
                                             <input type="text" class="form-control" >
                                          </div>
                                          </div>
                                       </div>
                                       <div class="form-group row align-items-center">
                                          <label class="col-md-3" for="smsnotification">Amount</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="form-group">
                                             <input type="text" class="form-control" >
                                          </div>
                                          </div>
                                       </div>
                                       <div class="form-group row align-i  tems-center">
                                          <label class="col-md-3" for="smsnotification">Transaction Pin</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="pin-container">
                                             <input type="text" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                             <input type="text" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                             <input type="text" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                             <input type="text" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                          </div>
                                          </div>
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
      <!-- Wrapper END -->
     <!-- Footer -->
     <?php include("include/footer.php");?>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      
      <?php include_once ('include/scripts.php'); ?>
   </body>
</html>