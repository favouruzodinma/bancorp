<!doctype html>
<html lang="en">
<?php
session_start();

// Check if the 'userid' session is not set
if (isset($_SESSION['userid'])) {
    // Redirect to the login page
    header("location: ../user/dashboard");
    exit();
}

// ... rest of the dashboard code
include_once ('../_db.php')
?>
<head>
        <meta charset="utf-8">
        <title>Bancorp | ACCOUNT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head><div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-6">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Free Register</h5>
                                            <p>Get your free Bancorp account now.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a>
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form method="POST" id="regester" class="needs-validation" novalidate="">
                                        
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter FullName">
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                        </div>

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required="">  
                                            <div class="invalid-feedback">
                                                Please Enter Address
                                            </div>      
                                        </div>

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Mobile Number</label>
                                            <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Enter mobile Number" required="">  
                                            <div class="invalid-feedback">
                                                Please Enter mobile Number
                                            </div>      
                                        </div>

                                        <?php
                                             require_once("../_db.php");
                                             // Fetch all countries from the database
                                             $query = "SELECT * FROM country";
                                             $result = $conn->query($query);

                                             // Check if the query was successful
                                             if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {  
                                                // Fetch the selected country (replace 'your_column_name' with the actual column name)
                                                $selectedCountry = $row['name']; // replace with the actual column name
                                                
                                                // HTML form with the dropdown dynamically populated
                                                ?>
                                                <div class="form-group col-sm-12">
                                                   <label for="country">Country:</label>
                                                   <select class="form-control" id="exampleFormControlSelect3" name="country">
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
                                             } }  else {
                                                echo "Error fetching countries from the database: " . $conn->error;
                                             }
                                            
                                             // Close the database connection
                                             $conn->close();
                                             ?> <br>    
                                        <div class="col-md-12">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="account_type" name="account_type" aria-label="Floating label select example" required="">
                                                    <option selected="">select</option>
                                                    <option value="Savings">Savings</option>
                                                    <option value="Current">Current</option>
                                                </select>
                                                <label for="floatingSelectGrid">Account Type</label>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="currency" name="currency" aria-label="Floating label select example" required="">
                                                    <option>select</option>
                                                    <option value="€">EURO(€)</option>
                                                    <option value="$">DOLLAR($)</option>
                                                    <option value="£">POUNDS(£)</option>
                                                    <option value="฿">Thai Baht(฿)</option>
                                                </select>
                                                <label for="floatingSelectGrid">Account Currency</label>
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" id="password" name="password">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                
                                       <div class="mb-3">
                                            <label class="form-label">Re-Type Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon1" id="password2" name="password2">
                                                <button class="btn btn-light " type="button" id="password-addon1"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                    
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" onclick='create(this)' type="submit" id="div">Register</button>
                                        </div><br>
                                        <p class="response"></p>
                
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">By registering you agree to the Bancorp <a href="#" class="text-primary">Terms of Use</a></p>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>Already have an account ? <a href="login" class="fw-medium text-primary"> Login</a> </p>
                                <p>©<script>document.write(new Date().getFullYear())</script> Powered by <i class="bx bx-check-shield text-success"></i> by Bancorp</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
    <div id="ErrorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../Bancorp.png" alt="" class="me-2" height="18">
            <strong class="me-auto">Error</strong>
            <small>Now..</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="background-color:red;">
            
        </div>
    </div>
</div>

<div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../Bancorp.png" alt="" class="me-2" height="18">
            <strong class="me-auto">Success</strong>
            <small>Now..</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="background-color:#c8f560;">
            
        </div>
    </div>
</div>
 <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- validation init -->
        <script src="assets/js/pages/validation.init.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <!-- Bootstrap Toasts Js -->
        <script src="assets/js/pages/bootstrap-toastr.init.js"></script>

    
</html>
<script src="//code.tidio.co/zldbtzujw9nyceuxopifmfzsvkmzoumw.js" async=""></script>
<style>
    /* Positioning for the floating WhatsApp button */
#floating-whatsapp {
  position: fixed;
  bottom: 40px;
  left: 20px;
  z-index: 9999;
}

/* Styling for WhatsApp icons */
.whatsapp-icon {
  width: 50px;
  height: 50px;
  margin: 5px;
}
</style>
<div id="floating-whatsapp">
    <a href="https://api.whatsapp.com/send?phone=447477466492" target="_blank">
      <img class="whatsapp-icon" src="../whatsapp-icon.png" alt="WhatsApp Support 1">
    </a>
</div>
<script>
function create(id){
    id.innerHTML = "submitting request...";
    $("#div").fadeOut(1000);
    setTimeout(function(){
    $('#div').show();
    id.innerHTML = "Register";
    }, 2000);
    }
</script>

<script src="../npm/sweetalert2%4011"></script>
 <script>
 $(document).ready(function(){
                $('#regester').on('submit', function(e){
                    e.preventDefault();
                    
                    var full_name = $('#full_name').val();
                    var email = $('#email').val();
                    var address = $('#address').val();
                    var country = $('#country').val();
                    var phone_number = $('#phone_number').val();
                    var account_type = $('#account_type').val();
                    var currency = $('#currency').val();
                    var password = $('#password').val();
                    var password2 = $('#password2').val();


                 if(full_name=="" ||  email=="" ||  address=="" || country=="" || phone_number=="" || account_type=="" || currency=="" || password=="" || password2==""){
                       $(".toast-body").html('Enter all field');
                       $("#ErrorToast").toast("show");
                       return false;
                    }

                    if(password.length<5 || password2.length<5) {
                      $(".toast-body").html('Enter A Stronger Password !');
                      $("#ErrorToast").toast("show");
                      $("#password, $password2").val('');
                       return false;
                    }
                  
                    
                    if(password!=password2){
                     $(".toast-body").html('Password mismatched Check And Try Again!');
                     $("#ErrorToast").toast("show");
                     $("#pin_two").val('');
                       return false;
                    }
                    
                    $.ajax({
                        type: "POST",
                        url: "authenticate/signup_process.php",
                        data: $('form').serialize(),
                        dataType: "json",
                        success: function(data){
                            if (data.status === 'success') {
                                // Registration successful
                                $(".toast-body").html(data.message);
                                $("#successToast").toast("show");

                                // Optionally, you can redirect the user to another page or perform additional actions
                            } else {
                                // Registration failed
                                $(".toast-body").html(data.content);
                                $("#ErrorToast").toast("show");
                            }
                        },
                        error: function(data, errorThrown){
                            Swal.fire('The Internet?','Check network connection!','question');
                        }
                    });
                });
            });
</script>