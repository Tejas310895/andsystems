<div class="row">
    <div class="page-title col-md-10">
        <h3>Customer Details</h3>
        <p class="text-subtitle text-muted">Below are the details of Customer</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?customer_registration" class="btn btn-primary" style="float:right;">New Customer Registration</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>PAN</th>
                        <th>GSTN</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $get_customers = "select * from customers where customer_status='active'";
                $run_customers = mysqli_query($con,$get_customers);
                while($row_customers = mysqli_fetch_array($run_customers)){
                ?>
                    <tr>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-link bg-transparent border-0 text-dark" data-bs-toggle="modal"
                                data-bs-target="#sc<?php echo $row_customers['customer_id']; ?>">
                                   <?php echo $row_customers['customer_title']; ?>
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="sc<?php echo $row_customers['customer_id']; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                <?php echo $row_customers['customer_title']; ?> Address</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Address :-</strong> <p><?php echo $row_customers['customer_address']; ?></p>
                                            <strong>State :-</strong> <p><?php echo $row_customers['customer_state']; ?></p>
                                            <strong>State Code :-</strong> <p><?php echo $row_customers['customer_state_code']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $row_customers['customer_email']; ?></td>
                        <td><?php echo $row_customers['customer_contact']; ?></td>
                        <td><?php echo $row_customers['customer_pan']; ?></td>
                        <td><?php echo $row_customers['customer_gstn']; ?></td>
                        <td>
                        <a href="delete.php?customer=<?php echo $row_customers['customer_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>