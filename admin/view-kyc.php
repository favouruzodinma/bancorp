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
                              <h4 class="card-title">User details</h4>
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
                                             <?php if(!empty($row['profile_img'])){ ?>
                                                <img src="../profile/<?php echo $row['profile_img'] ?>" class="avatar-100 img-fluid rounded-circle" alt="user">
                                                <?php }else{ ?>
                                                <img src="../user/images/user/dummie.jpeg" alt="profile-img " class="avatar-100 img-fluid rounded-circle" />
                                                <?php }?>
                                               
                                                <h5><?php echo $row['full_name'];   ?></h5>
                                                <?php if($row['kyc_status']=='active'){?>
                                                    <button type="submit"  class="btn btn-sm btn-primary mr-2 ">Verified</button>                                  
                               
                               <?php }else{ ?>
                                 <button type="submit"  class="btn btn-sm  btn-warning text-white mr-2 ">Pending</button>                     

                            <?php } ?>
                            
                                             
                                               </div>
                                               </div>
                                             </div>
                                             <hr >
                                             <div class="my-5" style="display: flex; flex-direction: column; gap: 8px;">       
                                                <h6 for="fname"><span style="font-size: small;">User Id:</span> <?php echo $row['userid'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Email Address:</span> <?php echo $row['email'];   ?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Phone Number:</span> <?php echo $row['phone_number'];?></h6>
                                             <h6 for="fname"><span style="font-size: small;">Status:</span> <?php echo $row['kyc_status'];   ?></h6>
                                             
                                          
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <h6 class="mb-2">KYC verification for all users. kindly process ID before you aprove verification</h6>
                                              <h3 class="mb-3">Kyc details</h3 >
                                              <span class="text-success"><?php echo isset($transactionErr)? $transactionErr: ""?></span>
                                              <div class="row">
                                          <div class="profile-img-edit ">
                                             <?php 
                                                if (empty($row['kyc'])) { 
                                             ?>  
                                               <p class="text-center">No Uploaded Kyc</p>
                                             <?php 
                                                } else { 
                                             ?> 
                                                <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>" >
                                                <img src="..\user\include\process\<?php echo $row['kyc']; ?>" alt="kyc-Image" class="profile-picture " id="" style="width:100%; height:100%;"/>
                                             <?php 
                                                } 
                                             ?>
                                         
                                          </div>
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