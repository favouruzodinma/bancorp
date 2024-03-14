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
                              <h4 class="card-title">Loan Request</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>View Requests</p>
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
                                 <th>id</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Loan Amount</th>
                               <th>Account Type</th>
                               <th>Status</th>
                               <th>Currency</th>
                               <th>Date</th>
                               <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                             <?php 
		$sql= $conn->query(" SELECT * FROM loans ORDER BY id DESC ");
		if($sql->num_rows>0){
            $serialNumber = 1;
				while($row=$sql->fetch_assoc()){ 
                ?>
                                 <tr>
                                 <td><?php echo $serialNumber++; ?></td>
                           <td><?php echo $row['loanid'] ?></td>
                               <td><?php echo $row['user_name'] ?></td>
                               <td><?php echo $row['user_email'] ?></td>
                               <td><?php echo $row['loan_amount'] ?></td>
                               <td><?php echo $row['account_type'] ?></td>
                               <td><?php echo $row['status'] ?></td>
                               <td><?php echo $row['currency'] ?></td>
                               <td><?php echo $row['date'] ?></td>
                                
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary" href="view-loan.php?id=<?= $row['loanid']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#"><i class="ri-user-add-line"></i></a>
                                        
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                           Aprove
                           </button>
                           <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalCenterTitle">Approve Loan Request</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to approve this Loan Request?
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <a href="approve-loan?status&id=<?php echo $row['loanid']; ?>&status=pending"   class="btn h-auto w-auto text-center btn-primary">Yes, Approve</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                                        
                                          <a href="approve-loan?id=<?php echo $row ['loanid']; ?>&status=delete" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
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
   <?php include_once 'include/footer.php' ; ?>
   <?php include_once "include/scripts.php" ?>
</body>
</html>