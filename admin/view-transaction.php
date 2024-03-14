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
                              <h4 class="card-title">Transaction Information</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                        <?php  $transactionid= $_GET['id'];
							$sql= $conn->query(" SELECT * FROM transactions WHERE transactionid='$transactionid'");
							if($sql->num_rows>0){
							while($row=$sql->fetch_assoc()){  ?> 
                           <div class="row mx-2">
                           
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