<?php   
 include_once 'include/head.php' ;
 if(isset($_GET['id'])){
   $userId= $_GET['id'];
   if($_GET['status']=='delete'){
   //? delete user account
   $sql=$conn->query("DELETE FROM `users` WHERE userid='$userId'");
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
      
                              <h4 class="card-title">User Information</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>View Users</p>
                           <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <form class="mr-3 position-relative">
                                       <div class="form-group mb-0">
                                          <!-- <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table"> -->
                                          <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">

                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                              <div class="user-list-files d-flex float-right">
    <a class="iq-bg-primary" href="javascript:void();" onclick="table.button('0').trigger();">
        Print
    </a>
    <a class="iq-bg-primary" href="javascript:void();" onclick="table.button('2').trigger();">
        Excel
    </a>
    <a class="iq-bg-primary" href="javascript:void();" onclick="table.button('3').trigger();">
        Pdf
    </a>
</div>

                              </div>
                           </div>
                           <table id="user-list-table" class="table table-striped table-borderless mt-4" role="grid" aria-describedby="user-list-page-info">
                             <thead>
                                 <tr>
                                    <th>S/N </th>
                                 <th>Userid</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Account Number</th>
                               <th>Account Type</th>
                               <th>Account Currency</th>
                               <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                             <?php 
		$sql= $conn->query(" SELECT * FROM users ORDER BY id DESC ");
		if($sql->num_rows>0){
            $serialNumber = 1;
				while($row=$sql->fetch_assoc()){ 
                ?>
                                 <tr>
                              
                                 <td><?php echo $serialNumber++; ?></td>
                           <td><?php echo $row['userid'] ?></td>
                               <td><?php echo $row['full_name'] ?></td>
                               <td><?php echo $row['email'] ?></td>
                               <td><?php echo $row['account_number'] ?></td>
                               <td><?php echo $row['account_type'] ?></td>
                               <td><?php echo $row['currency'] ?></td>
                                
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary" href="view-user.php?id=<?= $row['userid']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#"><i class="ri-user-add-line"></i></a>
                                          <?php if($row['status']=='active'){?>
                                  <a class="iq-bg-primary" href="ban-users.php?status&id=<?php echo $row['userid'];?>&status=active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ban" href="#"><i class="ri-error-warning-line"></i></a>
                               
                               <?php }else{ ?>
                            <a href="ban-users.php?status&id=<?php echo $row['userid']; ?>&status=banned" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Unban" href="#"><i class="ri-database-line"></i></a>       

                            <?php } ?>
                            <!-- <a class="iq-bg-primary"  id="delete"><i class="ri-delete-bin-line"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>    -->
                                          <a href="manage-user.php?id=<?php echo $row ['userid']; ?>&status=delete" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                            
                                 
                                 <?php }} else {  ?>
              
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
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <?php include_once 'include/footer.php' ; ?>
   <?php include_once 'include/scripts.php' ; ?>
   <script>
$(document).ready(function () {
    var table = $('#user-list-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "paging": true
    });
});
</script>
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
