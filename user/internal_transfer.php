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
                              <h4 class="card-title" style="font-size: 17; font-weight:800">Internal Transfer</h4>
                           </div>
                        </div>
                        <br>

                        <center style="display: flex; flex-direction:row; justify-content:space-around">
                           <div>
                              <p style="font-weight: 800;">Main Balance</p>
                              <small style="position: relative; top:-20px; font-weight:800"><?php echo $row ['currency'] ?><?php echo number_format($row['main_balance'], 2); ?></small>
                           </div>
                           <div>
                              <p style="font-weight: 800;">Over Draft</p>
                              <small style="position: relative; top:-20px; font-weight:800"><?php echo $row ['currency'] ?><?php echo number_format($row['overdraft_balance'], 2); ?></small>
                           </div>
                        </center>
                        <div class="iq-card-body">
                           <form method="POST" action="include/process/internal-transfer.php">
                              <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>">
                              <input type="hidden" name="wallet_balance" value="<?php echo $row['main_balance'] ?>">
                              <div class="form-group row align-items-center">
                                 <label class="col-md-3" for="emailnotification">Select Account</label>
                                 <div class="col-md-9 custom-control custom-switch">
                                 <div class="form-group">
                                 <!-- <input type="text" class="form-control" > -->
                                 <select name="main_balace" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="main_balace">Main Balance (<?php echo $row ['currency'] ?><?php echo number_format($row['main_balance'], 2); ?>)</option>
                                    <option value="overdraft_balance">Overdraft (<?php echo $row ['currency'] ?><?php echo number_format($row['overdraft_balance'], 2); ?>)</option>
                                 </select>
                                 </div>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-md-3" for="smsnotification">Bank Name</label>
                                 <div class="col-md-9 custom-control custom-switch">
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="bank_name" value="<?php echo $row['bank_name'] ?>" >
                                 </div>
                                 </div>
                              </div>

                              <div class="form-group row align-items-center">
                                 <label class="col-md-3" for="smsnotification">Account Number</label>
                                 <div class="col-md-9 custom-control custom-switch">
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="account_number" placeholder="015*******908" onkeyup="showHint(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "15">
                                 </div>
                                 <span style="position: relative; top:-15px" id="txtHint">Validating.....</span>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-md-3" for="smsnotification">Amount</label>
                                 <div class="col-md-9 custom-control custom-switch">
                                 <div class="form-group">
                                    <input type="number" class="form-control" name="amount" step="any" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" placeholder="<?php echo $row ['currency'] ?> 0.00">
                                 </div>
                                 <!-- <span style="position: relative; top:-15px" id="txtHint2"></span> -->
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-md-3" for="smsnotification">Transaction Pin</label>
                                 <div class="col-md-9 custom-control custom-switch">
                                 <div class="pin-container">
                                    <input type="password" class="form-control" maxlength="1" name="pin1" pattern="\d" title="Please enter a digit" required>
                                    <input type="password" class="form-control" maxlength="1" name="pin2" pattern="\d" title="Please enter a digit" required>
                                    <input type="password" class="form-control" maxlength="1" name="pin3" pattern="\d" title="Please enter a digit" required>
                                    <input type="password" class="form-control" maxlength="1" name="pin4" pattern="\d" title="Please enter a digit" required>
                                 </div>
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-primary mr-2"  name="internal_transfer">Submit</button>
                           </form>
                        </div>
                     </div>
                     <?php }} ?>
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
      <script>
         function showHint(str) {
         if (str.length == 0) {
         document.getElementById("txtHint").innerHTML = "";
         return;
         } else {
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
            if (this.readyState == 3 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            }
         }
         xmlhttp.open("GET", "include/process/get_user.php?q="+str, true);
         xmlhttp.send();
         }
         }
      </script>


      <?php include_once ('include/scripts.php'); ?>
   </body>
</html>