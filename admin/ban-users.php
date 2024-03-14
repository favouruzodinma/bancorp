<?php
include_once('config.php');
$status= $_GET ['status'];
$userid = $_GET['id'];
$id= $_GET['id'];
if($status=='active'){
    $sql = $conn->query("UPDATE users SET status='banned' WHERE userid='$userid' ");
    header("location:manage-user");
    $selectSql = $conn->query("SELECT * FROM users WHERE userid='$userid'");
    if ($sql->num_rows >0) {
       while ($row=$sql->fetch_assoc()) {
      $userName = $row['full_name'];
       }
    }
    if ($status == "active") {   
    echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
      $userName has been banned!!
     <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
     </div>";
     
     // JavaScript code to delay showing the warning message
     echo '<script>
     setTimeout(function(){
         document.getElementById("timeoutMessage").innerHTML = \'\';
     }, 6000);
     </script>';
}
else{
    $status = "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
    An error occured!!!!!!
   <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
   </div>";
   
   // JavaScript code to delay showing the warning message
   echo '<script>
   setTimeout(function(){
       document.getElementById("timeoutMessage").innerHTML = \'\';
   }, 6000);
   </script>';
}
}
else{
    $sql = $conn->query("UPDATE users SET status='active' WHERE userid='$userid' ");
    header("location:manage-user");
}



