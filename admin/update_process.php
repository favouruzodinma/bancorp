<?php   require_once './config.php';
  if(isset($_POST['update'])){
    $userid= mysqli_real_escape_string($conn, $_POST['userid']);
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $phone =mysqli_real_escape_string($conn, $_POST['phone']);
    // $lastName =mysqli_real_escape_string($conn, $_POST['lastName']);
    $email =mysqli_real_escape_string($conn, $_POST['email']);

   
   $sql= $conn->query("UPDATE admin SET name='$name', email='$email', phone='$phone' WHERE userid='$userid' "); 
   if ($sql){
    header('Location: ../../account-settings.php?status=error&message=Current password is incorrect');
    exit;
  //   $status = '<div class="alert alert-success alert-dismissible" role="alert">
  //    Details Updated Successfuly
  //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  // </div>' ; 
 }else{
     $status = '<div class="alert alert-danger alert-dismissible" role="alert">
     Sorry something went wrong
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>' ; 
 }
   
}
//  Handle profile picture update
 else{
  if(isset($_POST['update_pic'])){ 
    $userid= mysqli_real_escape_string($conn, $_POST['userid']);
    $target_dir = "profile-img/";
    $target_file = $target_dir . basename($_FILES["admin_pic"]["name"]);
    $uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["update_pic"])) {
$check = getimagesize($_FILES["admin_pic"]["tmp_name"]);
if(empty($check)) {
    $status =   "<div class='alert bg-danger' role='alert'>
 <div class='iq-alert-text'>File does not exist</div>
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
     <i class='ri-close-line'></i>
 </button>
</div>";  ; 
}
if($check !== false) {
// echo "File is an image - " . $check["mime"] . ".";
$uploadOk = true;
} else {
$_SESSION['mgs'] = '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>File is not an image...</strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
$uploadOk = false;
}
}

// Check file size
if ($_FILES["admin_pic"]["size"] > 800000000) {
$_SESSION['mgs'] = '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Sorry, your file is too large...</strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
$uploadOk = false;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
$_SESSION['mgs'] = '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Sorry, only JPG, JPEG, PNG & GIF files are allowed..</strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
$uploadOk = false;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == false) {
$_SESSION['mgs'] = '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Sorry, your file was not uploaded.</strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["admin_pic"]["tmp_name"], $target_file)) {
    $status = '<div class="alert alert-danger alert-dismissible" role="alert">
    The file ". htmlspecialchars( basename( $_FILES["admin_pic"]["name"])). " has been uploaded.
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>' ; 

} else {
$_SESSION['mgs'] = '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Sorry, there was an error uploading your file</strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}

if($uploadOk === true){

$sql= $conn->query("UPDATE admin SET admin_pic='$target_file' WHERE userid='$userid' "); 
if ($sql){
   $status =  "<div class='alert bg-success' role='alert'>
 <div class='iq-alert-text'>Profile Picture Updated Successfuly</div>
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
     <i class='ri-close-line'></i>
 </button>
</div>"; 
 
}else{
    $status =  "<div class='alert bg-danger' role='alert'>
 <div class='iq-alert-text'>Sorry something went wrong</div>
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
     <i class='ri-close-line'></i>
 </button>
</div>"; 
}

}  
}
}
}