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
               $gender = $row['gender'];
               $state = $row['state'];
               $address = $row['address'];
               $maritalStatus = $row['marital_status'];
         ?>
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">

                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-body p-0">
                           <div class="iq-edit-list">
                            <ul class="iq-edit-profile d-flex nav nav-pills">
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link active"  href="profile-edit">
                                      Edit Personal Information
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link"  href="change-pwd">
                                       Change Password
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link"  href="change-pin">
                                       Change Pin
                                    </a>
                                 </li>
                                  <li class="col-md-3 p-0">
                                    <a class="nav-link"  href="manage-contact">
                                       Manage Contact
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-12">
                     <div class="iq-edit-list-data">
                        <div class="tab-content">
                           <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Personal Information</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                    <form  action="include/process/edit-profile.php" enctype="multipart/form-data" method="POST"  novalidate="">
                                       <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>">
                                       <div class="form-group row align-items-center">
                                          <div class="col-md-12">
                                             <div class="profile-img-edit">
                                                <?php if(!empty($row['profile_img'])){ ?>
                                                <img src="../profile/<?php echo $row['profile_img'] ?>" class="profile-pic" alt="profile-pic">
                                                <?php }else{ ?>
                                                   <img class="profile-pic" src="images/user/dummie.jpeg" alt="profile-pic">
                                                <?php }?>
                                                <div class="p-image">
                                                  <i class="ri-pencil-line upload-button"></i>
                                                  <input class="file-upload" type="file" id="profile_img" value="../profile/<?php echo $row['profile_img'] ?>" name="profile_img" accept="image/*"/>
                                               </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class=" row align-items-center">
                                          <div class="form-group col-sm-6">
                                             <label for="fname">First Name:</label>
                                             <input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo $row ['full_name'] ?>">
                                             <div class="invalid-feedback">
                                                Please Enter Full name
                                            </div>  
                                          </div>
                                          <div class="form-group col-sm-6">
                                             <label for="cname">City:</label>
                                             <input type="text" class="form-control" name="city" id="city" value="<?php echo $row ['city'] ?>">
                                          </div>
                                          <div class="form-group col-sm-6">
                                             <label class="d-block">Gender:</label>
                                             <select class="form-control" id="gender" name="gender">
                                                   <option value="male" <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
                                                   <option value="female" <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-sm-6">
                                             <label for="dob">Date Of Birth:</label>
                                             <input  class="form-control" id="dob" name="dob" value="<?php echo $row ['dob'] ?>" type="date">
                                          </div>
                                          <div class="form-group col-sm-6">
                                             <label>Marital Status:</label>
                                             <select class="form-control" id="maritalStatus" name="marital_status">
                                                   <option value="Single" <?php echo ($maritalStatus == 'Single') ? 'selected' : ''; ?>>Single</option>
                                                   <option value="Married" <?php echo ($maritalStatus == 'Married') ? 'selected' : ''; ?>>Married</option>
                                                   <option value="Widowed" <?php echo ($maritalStatus == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                                   <option value="Divorced" <?php echo ($maritalStatus == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                                   <option value="Separated" <?php echo ($maritalStatus == 'Separated') ? 'selected' : ''; ?>>Separated</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-sm-6">
                                             <label for="age">Age:</label>
                                             <input  class="form-control" name="age" id="age" value="<?php echo $row ['age'] ?>">
                                          </div>
                                          <?php
                                             require_once("../_db.php");
                                             // Fetch all countries from the database
                                             $query = "SELECT * FROM country";
                                             $result = $conn->query($query);

                                             // Check if the query was successful
                                             if ($result) {
                                                // Fetch the selected country (replace 'your_column_name' with the actual column name)
                                                $selectedCountry = $row['country']; // replace with the actual column name
                                                
                                                // HTML form with the dropdown dynamically populated
                                                ?>
                                                <div class="form-group col-sm-6">
                                                   <label for="country">Country:</label>
                                                   <select class="form-control" id="country" name="country">
                                                         <?php
                                                         // Loop through the result set
                                                         while ($row = $result->fetch_assoc()) {
                                                            $countryName = $row['name']; // replace with the actual column name
                                                            ?>
                                                            <option value="<?php echo $countryName; ?>" <?php echo ($selectedCountry == $countryName) ? 'selected' : ''; ?>>
                                                               <?php echo $countryName; ?>
                                                            </option>
                                                            <?php
                                                         }
                                                         ?>
                                                   </select>
                                                </div>
                                                <?php
                                             } else {
                                                echo "Error fetching countries from the database: " . $conn->error;
                                             }

                                             // Close the database connection
                                             $conn->close();
                                          ?>
                                          <div class="form-group col-sm-6">
                                             <label for="state">State:</label>
                                             <input  class="form-control" name="state" id="state" value="<?php echo $state ; ?>">
                                          </div>
                                          <div class="form-group col-sm-12">
                                             <label>Address:</label>
                                             <textarea class="form-control" name="address" id="address" rows="3" style="line-height: 22px;">
                                             <?php echo $address ; ?>
                                             </textarea>
                                          </div>
                                       </div>
                                       <button class="btn btn-primary mr-2"  onclick='create(this)' type="submit" id="div">Submit</button>
                                    </form>
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