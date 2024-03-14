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
                  <div class="col-sm-12 col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title" style="font-size: 17; font-weight:800">International Transfer</h4>
                           </div>
                        </div>
                        <br>
                        <center style="display: flex; flex-direction:row; justify-content:space-around">
                           <div>
                              <p style="font-weight: 800;">Main Balance</p>
                              <small style="position: relative; top:-20px; font-weight:800"><?php echo $row ['currency'] ?><?php echo number_format($row['main_balance'], 2); ?></small>
                           </div>
                           <div>
                              <p style="font-weight: 800;">Over Draft </p>
                              <small style="position: relative; top:-20px; font-weight:800"><?php echo $row ['currency'] ?><?php echo number_format($row['overdraft_balance'], 2); ?></small>
                           </div>
                        </center>
                        <center>
                           <h6 style="font-weight: 800;"  id="someDiv">TRANFER TO ANY BANK WORDWIDE</h6>
                        </center>
                        <br>
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
                                          <label class="col-md-3" for="smsnotification">Bank Name</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="form-group">
                                             <input type="text" class="form-control" >
                                          </div>
                                          </div>
                                       </div>

                                       <div class="form-group row align-items-center">
                                          <label class="col-md-3" for="smsnotification">Account Number</label>
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
                                       <div class="form-group row align-items-center">
                                       <label class="col-md-3" for="smsnotification">Remark (OPTIONAL)</label>
                                          <div class="col-md-12 custom-control custom-switch">
                                          <div class="form-group">
                                             <!-- <input type="text" class="form-control" > -->
                                             <textarea name="" id="" cols="150" class="form-control" placeholder="Remark (OPTIONAL)">
                                             </textarea>
                                          </div>
                                          </div>
                                       </div>
                                       <div class="form-group row align-i  tems-center">
                                          <label class="col-md-3" for="smsnotification">Transaction Pin</label>
                                          <div class="col-md-9 custom-control custom-switch">
                                          <div class="pin-container">
                                             <input type="password" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                             <input type="password" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                             <input type="password" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
                                             <input type="password" class="form-control" maxlength="1" pattern="\d" title="Please enter a digit" required>
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
      <?php }} ?>
      <!-- Wrapper END -->
     <!-- Footer -->
     <script>
      $("#someDiv").hide();
      setInterval(function(){
         $( "#someDiv" ).fadeIn(1000).fadeOut(2500);
      },0)
     </script>
     <?php include("include/footer.php");?>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      
      <?php include_once ('include/scripts.php'); ?>
   </body>
</html>