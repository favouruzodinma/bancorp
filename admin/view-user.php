<?php   
 include_once 'include/head.php' ;
 if(isset($_POST['fund'])){
   include_once 'fund-user.php';
} 
?>
   <body>
      <!-- loader Start -->
      <!-- <div id="loading">
         <div id="loading-center">
         </div> -->
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
   <div id="content-page" class="content-page">
   <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
                  <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">User Information</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                        <?php  $userid= $_GET['id'];
							$sql= $conn->query(" SELECT * FROM users WHERE userid='$userid'");
							if($sql->num_rows>0){
							while($row=$sql->fetch_assoc()){  ?> 
                           <div class="row mx-2">
                            <div class="col-md-6 ">
                           <div class="form-group row align-items-center mb-5">
                                          <div class="col-md-12 text-center">
                                             <div class="profile-img-edit">
                                                <img class="profile-pic" src="images/user/11.png" alt="profile-pic">
                                                <h5><?php echo $row['full_name'];   ?></h5>
                                                <?php if($row['status']=='active'){?>
                                                    <button type="submit" disabled  name="update" class="btn  btn-primary mr-2 ">Enabled User</button>                                  
                               
                               <?php }else{ ?>
                                 <button type="submit" disabled  name="update" class="btn  btn-danger mr-2 ">Disabled User</button>                     

                            <?php } ?>
                            
                                             
                                               </div>
                                               </div>
                                             </div>
                                             <hr >
                                             <div class="my-5" style="display: flex; flex-direction: column; gap: 8px;">       
                                                <h6 for="fname"><span style="font-size: small;">User Id:</span> <?php echo $row['userid'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Email Address:</span> <?php echo $row['email'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Phone Number:</span> <?php echo $row['phone_number'];?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Country:</span> <?php echo $row['country'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Phone Number:</span> <?php echo $row['phone_number'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Account Type:</span> <?php echo $row['account_type'];   ?></h6>
                                          
                                             <h6 for="fname"><span style="font-size: small;">Account Number:</span> <?php echo $row['account_number'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Main Balance:</span> <?php echo $row['currency'];?><?php echo $row['main_balance'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Overdraft:</span><?php echo $row['currency'];?><?php echo $row['overdraft_balance'];   ?></h6>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <h6 class="mb-2">KYC verification for all users. kindly process ID before you aprove verification</h6>
                                              <h3 class="mb-3">FUND WALLET</h3 >
                                              <span class="text-success"><?php echo isset($transactionErr)? $transactionErr: ""?></span>
                                          <form method="POST" action="#" >
                                          <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>">
                                       <div class="form-group row align-items-center">
                                          
                                       <div class=" row align-items-center">
                                       <div class="form-group col-sm-12">
                                             <label for="phone">Account Number:</label>
                                             <input type="text"  name="account_number" class="form-control"  value="<?php echo $row['account_number'] ?>"  >
                                          </div>
                                          <div class="form-group col-sm-12">
                                             <label for="fname">Account Balance</label>
                                             <select  name="acct_balance" id="" class="form-control">
                                                <option value="Main Balance" selected>Main Balance</option>
                                                <option value="Overdraft " >Overdraft</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-sm-12">
                                             <label  for="fname">Currency</label>
                                             <select name="currency" value="" id="?php echo $row['currency'] ?>" class="form-control">
                                                    <option value="€">EURO(€)</option>
                                                    <option value="$">DOLLAR($)</option>
                                                    <option value="£">POUNDS(£)</option>
                                                    <option value="฿">Thai Baht(฿)</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-sm-12">
                                             <label for="amount">Enter Amount in Value:</label>
                                             <input type="number"  name="amount" required class="form-control" id="email"  value=''>
                                          </div>
                                       </div>
                                       <button type="submit" name="fund" class="btn btn-lg btn-primary mr-2 ">Fund Account</button>
                                    </form>
                                          </div>
                                       </div>
                                       <?php }} ?>
                           </div>
                        </div>
                     </div>
            </div>
         </div>

      </div>
   </div>
   </div>
   </div>
   </div>
   <!-- Wrapper END -->
   <?php include_once 'include/footer.php' ; ?>
   <?php include_once 'include/scripts.php' ; ?>
</body>
</html>