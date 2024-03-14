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
                              <h4 class="card-title">View Loan</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                        <?php  $loanid= $_GET['id'];
							$sql= $conn->query(" SELECT * FROM loans WHERE loanid='$loanid'");
							if($sql->num_rows>0){
							while($row=$sql->fetch_assoc()){  ?> 
                           <div class="row mx-2">
                            <div class="col-md-6 ">
                           <div class="form-group row align-items-center mb-5">
                                          <div class="col-md-12 text-center">
                                             <div class="profile-img-edit">
                                             <?php if(!empty($row['profile_img'])){ ?>
                                                <img src="../profile/<?php echo $row['profile_img'] ?>" class="avatar-100 img-fluid rounded-circle" alt="user">
                                                <?php }else{ ?>
                                                <img src="../user/images/user/dummie.jpeg" alt="profile-img " class="avatar-100 img-fluid rounded-circle" />
                                                <?php }?>
                                               
                                                <h5><?php echo $row['user_name'];   ?></h5>
                                                <?php if($row['status']=='approved'){?>
                                                    <button type="submit"  class="btn btn-sm btn-primary mr-2 ">Approved</button>                                  
                               
                               <?php }else{ ?>
                                 <button type="submit"  class="btn btn-sm  btn-warning text-white mr-2 ">Pending</button>                     

                            <?php } ?>
                            
                                             
                                               </div>
                                               </div>
                                             </div>
                                             <!-- <hr > -->
                                           
                                          </div>
                                          <div class="col-md-6">
                                           
                                              <h3 class="mb-3">Loan details</h3 >
                                              <span class="text-success"><?php echo isset($transactionErr)? $transactionErr: ""?></span>
                                              <div class="my-1" style="display: flex; flex-direction: column; gap: 8px;">       
                                              <h6 for="fname"><span style="font-size: small;">Loan Id:</span> <?php echo $row['loanid'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Email Address:</span> <?php echo $row['user_email'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Phone Number:</span> <?php echo $row['phone_number'];?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Status:</span> <?php echo $row['status'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Account Type:</span> <?php echo $row['account_type']; ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Loan Amount:</span> <?php echo $row['currency']; ?><?php echo $row['loan_amount']; ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Loan Description:</span> <p><?php echo $row['description']; ?> </p> </h6>
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