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
<?php

// Assuming you have user and device information
$userName = $row['full_name']; // Replace with the actual user data
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$loginLocation = "Africa/Lagos";



// Get the current date and time in the user's timezone
$dateTime = new DateTime('now', new DateTimeZone($loginLocation));

// Extract device information from the user agent string
// $deviceInfo = getDeviceInfo($userAgent);
$deviceInfo = $userAgent;


// Check if the device information has changed
if (!isset($_SESSION['lastDevice']) || $_SESSION['lastDevice'] !== $deviceInfo) {
    // Generate the message
    $message = "Hello $userName, a new device ($deviceInfo) has logged into your account. ";
    $message .= "Location: $loginLocation. Contact us if you are not in support of that activity.";

    // Store the notification in a session variable
    $_SESSION['notificationMessage'] = $message;
    $_SESSION['lastDevice'] = $deviceInfo;
} else {
    $_SESSION['notificationMessage'] = ''; // No new device login
}
?>



<div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <div class="iq-sidebar-logo">
                  <div class="top-logo">
                     <a href="dashboard" class="logo">
                     <div class="iq-light-logo">
                  <img src="images/bancorp2.png" class="img-fluid" alt="">
               </div>
               <div class="iq-dark-logo">
                  <img src="images/bancorp2.png" class="img-fluid" alt="">
               </div>
                     <span>bancorp</span>
                     </a>
                  </div>
               </div>
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="navbar-left">
                 
               </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                     </div>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                           <a class="search-toggle iq-waves-effect language-title" href="#"> Account Balance <i class="ri-arrow-down-s-line"></i></a>
                           <div class="iq-sub-dropdown">
                              <a class="iq-sub-card" href="#" style="font-weight:900">Available Balance <br><?php echo $row ['currency'] ?><?php echo number_format($row['main_balance'], 2); ?></a>
                              <a class="iq-sub-card" href="#" style="font-weight:900">Main Balance:<br><?php echo $row ['currency'] ?><?php echo number_format($row['main_balance'], 2); ?></a>
                              <a class="iq-sub-card" href="#" style="font-weight:900">Overdraft Balance: <br><?php echo $row ['currency'] ?><?php echo number_format($row['overdraft_balance'], 2); ?></a>
                              <a class="iq-sub-card" href="#" style="font-weight:900">Internal Transfer: Open</a>
                              <a class="iq-sub-card" href="#" style="font-weight:900">Domestic Transfer: Open</a>
                              <a class="iq-sub-card" href="#" style="font-weight:900">International Transfer: Open</a>

                           </div>
                        </li>
                        
                        <li class="nav-item">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <div id="lottie-beil"></div>
                              <span class="bg-danger dots"></span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0">
                                       <div class="bg-primary p-1">
                                          <h5 class="mb-0 text-white">Notifications</h5>
                                       </div>

                                       <a href="#" class="iq-sub-card">
                                          <div class="media align-items-center">
                                             <div class="media-body">
                                                   <?php if (!empty($_SESSION['notificationMessage'])) : ?>
                                                      <h6 class="mb-0" style="font-size: 13px;"><?php echo $_SESSION['notificationMessage']; ?></h6>
                                                      <small class="float-right font-size-12"><?php echo $dateTime->format('Y-m-d H:i:s'); ?></small>
                                                   <?php else : ?>
                                                      <!-- You can customize this part for no new notifications -->
                                                      <h6 class="mb-0">No new notifications</h6>
                                                   <?php endif; ?>
                                             </div>
                                          </div>
                                       </a>
                                 </div>
                              </div>
                           </div>

                        </li>
                     </ul>
                  </div>
                  <ul class="navbar-list">
                      <li>
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                           <?php if(!empty($row['profile_img'])){ ?>
                           <img src="../profile/<?php echo $row['profile_img'] ?>" class="img-fluid rounded mr-3" alt="user">
                           <?php }else{ ?>
                           <img src="images/user/dummie.jpeg" class="img-fluid rounded mr-3" alt="user">
                           <?php }?>
                           <div class="caption">
                              <h6 class="mb-0 line-height text-white"><?php echo ucfirst($row['full_name']); ?></h6>
                              <span class="font-size-12 text-white">
                                <?php switch ($row['status']) {
                                
                                case 'active':
                                    echo "<span class='badge badge-pill badge-success'>Verified</span>";
                                    break;
                                case 'ban':
                                    echo "<span class='badge badge-pill badge-danger'>Banned</span>";
                                    break;
                                case 'pending':
                                    echo "<span class='badge badge-pill badge-warning'>Pending</span>";
                                    break; } ?>
                                </span>
                           </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <a href="user-profile" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-file-user-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">My Profile</h6>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="profile-edit" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="profile-edit" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-account-box-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Account settings</h6>
                                       </div>
                                    </div>
                                 </a>
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <a class="btn btn-primary dark-btn-primary text-light" id='logout' role="button" >Sign out<i class="ri-login-box-line ml-2"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </nav>
               

            </div>
         </div>
    <?php }} ?>