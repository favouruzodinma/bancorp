<?php   
 include_once 'include/head.php' ;
 if(isset($_GET['id'])){
   $transactionid= $_GET['id'];
   if($_GET['status']=='delete'){
   //? delete user account
   $sql=$conn->query("DELETE FROM `transactions` WHERE transactionid='$transactionid'");
   header('Location: manage-user'); 
   } }
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
                              <h4 class="card-title">Transaction History</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>View transactions</p>
                           <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <form class="mr-3 position-relative">
                                       <div class="form-group mb-0">
                                          <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="user-list-files d-flex float-right">
                                    <a class="iq-bg-primary" href="javascript:void();" >
                                       Print
                                     </a>
                                    <a class="iq-bg-primary" href="javascript:void();">
                                       Excel
                                     </a>
                                     <a class="iq-bg-primary" href="javascript:void();">
                                       Pdf
                                     </a>
                                   </div>
                              </div>
                           </div>
                           <table id="user-list-table" class="table table-striped table-borderless mt-4" role="grid" aria-describedby="user-list-page-info">
                             <thead>
                                 <tr>
                                    <th>S/N </th>
                                 <th>Transaction id</th>
                               <th>Customer Name</th>
                               <th>Transfer Method</th>
                               <th>Amount Paid</th>
                               <th>Account Type</th>
                               <th>Date/Time</th>
                               <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                             <?php
                                            require_once('config.php'); // Include your database connection script

                                            // Check if the 'status' parameter is set in the URL
                                            if (isset($_GET['transfer_type'])) {
                                                $transfer_type = $_GET['transfer_type'];
                                                $sql = "SELECT * FROM transactions WHERE transfer_type = ? ORDER BY id DESC";

                                                // Prepare a parameterized statement
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("s", $transfer_type);
                                                $stmt->execute();

                                                $result = $stmt->get_result();
                                            } else {
                                                // If 'status' parameter is not set, fetch all records from 'user_login'
                                                $sql = "SELECT * FROM transactions ORDER BY id";
                                                $result = $conn->query($sql);
                                            }

                                            if ($result) {            
                              if($result->num_rows>0){
                                    $serialNumber = 1;
                                    while($row=$result->fetch_assoc()){ 
                                          ?>
                                 <tr>
                                 <td><?php echo $serialNumber++; ?></td>
                           <td><?php echo $row['transactionid'] ?></td>
                               <td><?php echo $row['customer_name'] ?></td>
                               <td><?php echo $row['transfer_type'] ?></td>
                               <td><?php echo $row['customer_phone'] ?></td>
                               <td><?php echo $row['account_type'] ?></td>
                               <td><?php echo $row['transfer_type'] ?></td>
                                
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary" href="view-transaction.php?id=<?= $row['transactionid']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#"><i class="ri-user-add-line"></i></a>
                             
                                        
                                          <a href="transaction.php?id=<?php echo $row ['transactionid']; ?>&status=delete" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                            
                                 
                                 <?php }}} else {  ?>
              
              </div>
    <h3 colspan='6' class="text-bold">
    <span style="color:red;"> No user available!!</span>
    </h3>
    <?php } ?>
                             </tbody>
                           </table>
                        </div>
                           <div class="row justify-content-between mt-3">
                              <div id="user-list-page-info" class="col-md-6">
                                 <span>Showing 1 to 5 of 5 entries</span>
                              </div>
                              <div class="col-md-6">
                                 <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                       <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                       </li>
                                       <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       <li class="page-item">
                                          <a class="page-link" href="#">Next</a>
                                       </li>
                                    </ul>
                                 </nav>
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
   </div>
   </div>
   </div>
   <!-- Wrapper END -->
   <?php include_once 'include/footer.php' ; ?>
   <?php include_once 'include/scripts.php' ; ?>
</body>
</html>


<script>
$(document).ready(function(){
    // Add an event listener for the search input
    $('#exampleInputSearch').on('input', function() {
        // Get the search value
        var searchText = $(this).val().toLowerCase();

        // Iterate through each row in the table
        $('#user-list-table tbody tr').each(function() {
            var rowData = $(this).text().toLowerCase();

            // Show or hide the row based on the search text
            $(this).toggle(rowData.indexOf(searchText) > -1);
        });
    });
});
</script>