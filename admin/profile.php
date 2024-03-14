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
         <?php include_once ('include/sidebar.php'); ?>
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
                              <div class="bg-primary ">
                                 <div class="row">
                                       <div class="col-7">
                                          <div class="text-primary p-4">
                                             <h6 class="text-light">Profile Page !</h6>
                                             <p class="text-light" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight:900; font-size:20px"><?php echo ucfirst($row['name']); ?>.</p>
                                          </div>
                                       </div>
                                       <div class="col-5 align-self-end">
                                          <img src="images/profile-img.png" alt="" class="img-fluid">
                                       </div>
                                 </div>
                              </div>
                              </div>   
                              <div class="profile-info p-4">
                                 <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                       <div class="user-detail pl-5">
                                          <div class="d-flex flex-wrap align-items-center">
                                             <div class="profile-img pr-4">
                                                <?php if(!empty($row['admin_pic'])){ ?>
                                                <img src="../profile/<?php echo $row['admin_pic'] ?>" class="avatar-100 img-fluid" alt="user">
                                                <?php }else{ ?>
                                                <img src="images/user/dummie.jpeg" alt="profile-img" class="avatar-100 img-fluid" />
                                                <?php }?>
                                             </div>
                                             <style>
                                                /* Default styles */
                                                .profile-detail {
                                                flex-direction: column;
                                                justify-content: start;
                                                position: relative;
                                                top: -25px;
                                                }

                                                /* Media query for small screens (adjust the max-width as needed) */
                                                @media (max-width: 768px) {
                                                .profile-detail {
                                                   position: static; /* or any other default position value */
                                                   top: 0;
                                                }
                                                }
                                             </style>
                                             <div class="profile-detail d-flex align-items-start" >
                                                <p><?php echo $row['account_type'] ?> Account</p>
                                                <span class="font-size-12 text-white" style="position: relative; top:-12px">
                                                <?php switch ($row['status']) {
                                                
                                                case 'active':
                                                      echo "<span class='badge badge-pill badge-success' style='padding:8px'>Verified</span>";
                                                      break;
                                                case 'ban':
                                                      echo "<span class='badge badge-pill badge-danger' style='padding:8px'>Banned</span>";
                                                      break;
                                                case 'pending':
                                                      echo "<span class='badge badge-pill badge-warning' style='padding:8px'>Pending</span>";
                                                      break; } ?>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                       <ul class="nav nav-pills d-flex align-items-end float-right profile-feed-items p-0 m-0">
                                       
                                          <li>
                                             <a class="nav-link " data-toggle="pill" href="#profile-profile">View profile</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="row">
                        <div class="col-lg-7 profile-center">
                           <div class="tab-content">
                              <div class="tab-pane fade" id="profile-profile" role="tabpanel">
                                 <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Profile</h4>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                      <!-- <div class="user-bio">
                                          <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
                                      </div> -->
                                      <div class="mt-2">
                                       <h6>Joined:</h6>
                                       <p>
                                       <?php
                                       // Assuming $row['registeration_date'] is a valid timestamp or date string
                                       $registrationDate = strtotime($row['registration_date']); // Convert to timestamp if it's a date string

                                       // Format the date
                                       $formattedDate = date('F j, Y', $registrationDate); // Adjust the format as needed

                                       // Output the formatted date
                                       echo $formattedDate;
                                       ?>
                                       </p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Country:</h6>
                                       <p><a href="#" target="_blank"><?php echo $row['country'] ?></a></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Address:</h6>
                                       <p><?php echo $row['address'] ?></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Email:</h6>
                                       <p><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Contact:</h6>
                                       <p><a href="#"><?php echo $row['phone_number'] ?></a></p>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 profile-right">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Account Limit</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <div class="about-info m-0 p-0">
                                    <div class="row">
                                       <div class="col-7">Sending (Per Transaction):</div>
                                       <div class="col-5" style="font-weight:900"><a href="#"><?php echo $row['currency'] ?> 1,000,000</a></div>
                                       <div class="col-7">Receiving (Per Transaction) :</div>
                                       <div class="col-5" style="font-weight:900"><a href="#"><?php echo $row['currency'] ?> 500,000</a></div>
                                       <div class="col-7">Daily Transaction Limit :</div>
                                       <div class="col-5" style="font-weight:900"><a href="#"><?php echo $row['currency'] ?> 500,000</a></div>
                                       <div class="col-7">Debit Card Limit:</div>
                                       <div class="col-5" style="font-weight:900"><a href="#"><?php echo $row['currency'] ?> 500,000</a></div>
                                       <div class="col-7">Maximum Balance :</div>
                                       <div class="col-5" style="font-weight:900"><a href="#">Unlimited</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 profile-right">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title" style="font-weight:700">Kyc</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body row">
                                 <div class="about-info m-0 p-0 col-md-6">
                                 <?php if (!empty($row['kyc'])): ?>
                                 <div class="profile-img pr-4" style="position: relative; top:70px">
                                    <img src="include/process/<?php echo $row['kyc']; ?>" alt="User-kyc" class="avatar-100 img-fluid" />
                                 </div>
                                 <span class="font-size-12 text-white" style="position: relative; right:-20px">
                                    <?php
                                    $kycStatus = $row['kyc_status'];
                                    $badgeClass = '';
                                    switch ($kycStatus) {
                                          case 'active':
                                             $badgeClass = 'badge-success';
                                             break;
                                          case 'ban':
                                             $badgeClass = 'badge-danger';
                                             break;
                                          case 'pending':
                                             $badgeClass = 'badge-warning';
                                             break;
                                    }
                                    echo "<span class='badge badge-pill $badgeClass' style='padding:8px'>" . ucfirst($kycStatus) . "</span>";
                                    ?>
                                 </span>
                                 <br><br><br>
                              <?php else: ?>
                                 <ul class="text-dark" style="position: relative; left:-25px ; font-weight:600">
                                    <li style="margin-bottom: -30px;"> <small style="font-size: 30px; font-weight:900">.</small> Diver's License</li>
                                    <li style="margin-bottom: -30px;"> <small style="font-size: 30px; font-weight:900">.</small> International Passport</li>
                                    <li style="margin-bottom: -30px;"> <small style="font-size: 30px; font-weight:900">.</small> National ID card</li>
                                 </ul>
                                 <br>
                              <?php endif; ?>

                                 </div>
                                 <form enctype="multipart/form-data" method="POST" action="include/process/kyc.php" class="col-md-6 d-flex align-items-center" style="flex-direction:column">
                                       <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>">
                                       <small class="text-dark" style="font-weight: 800;">Valid ID Required</small class="text-dark" style="font-weight: 800;">
                                       <div class="form-group row align-items-center">
                                          <div class="col-md-12">
                                             <div class="profile-img-edit">
                                                <img class="profile-pic" src="images/kyc.png" alt="profile-pic">
                                                <div class="p-image">
                                                  <i class="ri-pencil-line upload-button"></i>
                                                  <input class="file-upload" type="file" id="kyc" name="kyc" accept="image/*"/>
                                               </div>
                                             </div>
                                          </div>
                                       </div>
                                       <button class="btn btn-primary mr-2" name="upload-kyc"  onclick='create(this)' type="submit" id="div">Upload Kyc</button>
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
      <?php include("include/footer.php");?>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      
      <?php include_once ('include/scripts.php'); ?>
   </body>
</html>