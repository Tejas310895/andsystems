<div class="row">
    <div class="page-title col-md-10">
        <h3>Purchase Enquires</h3>
        <p class="text-subtitle text-muted">Below are the details of purchase enquires</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_purchase_enquiry" class="btn btn-primary" style="float:right;">New Purchase Enquiry</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Schedule</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $get_purchase_entries = "select * from purchase_enquires order by purchase_enquiry_delivery_status ASC";
                $run_purchase_entries = mysqli_query($con,$get_purchase_entries);
                while($row_purchase_entries=mysqli_fetch_array($run_purchase_entries)){

                    $supplier_id = $row_purchase_entries['supplier_id'];

                   $get_supplier = "select * from suppliers where supplier_id='$supplier_id'";
                   $run_supplier = mysqli_query($con,$get_supplier);
                   $row_supplier = mysqli_fetch_array($run_supplier);
                ?>
                    <tr>
                        <td><?php echo date('d-M-y / H:i a',strtotime($row_purchase_entries['purchase_enquiry_created_at'])); ?></td>
                        <td class="text-uppercase"><?php echo $row_supplier['supplier_title']; ?></td>
                        <td><?php echo $row_purchase_entries['supplier_email']; ?></td>
                        <td><?php echo date('d-M-y',strtotime($row_purchase_entries['purchase_enquiry_schedule'])); ?></td>
                        <td class="text-uppercase"><?php echo $row_purchase_entries['purchase_enquiry_delivery_status']; ?></td>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn icon btn-info" data-bs-toggle="modal"
                                data-bs-target="#pp<?php echo $row_purchase_entries['purchase_enquiry_id']; ?>">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="pp<?php echo $row_purchase_entries['purchase_enquiry_id']; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                Purchase Enquiry Details</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close" title="View mail">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                            <span class="badge bg-primary">Date - <?php echo date('d-M-y / H:i A',strtotime($row_purchase_entries['purchase_enquiry_created_at'])); ?></span>
                                            <span class="badge bg-primary">Email - <?php echo $row_purchase_entries['supplier_email']; ?></span>
                                            </p>
                                            <h4>Subject :- <?php echo $row_purchase_entries['email_subject']; ?></h4><br>
                                            <h5><?php echo $row_purchase_entries['email_content']; ?></h5>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    
                                                    $unserialized_array = unserialize($row_purchase_entries['raw_product_array']);
                                                    $array_size = (count($unserialized_array)-1);
                                                    for($i=0; $i<=$array_size; $i++){

                                                        $item_id = $unserialized_array[$i][0];
                                                        $item_qty = $unserialized_array[$i][1];

                                                        $get_raw_id = "select * from raw_products where raw_product_id='$item_id'";
                                                        $run_raw_id = mysqli_query($con,$get_raw_id);
                                                        $row_raw_id = mysqli_fetch_array($run_raw_id);
                                                        $raw_title = $row_raw_id['raw_product_title'];
                                                        $raw_unit = $row_raw_id['raw_product_unit'];

                                                        echo "
                                                            <tr>
                                                                <td class='text-bold-500'>$raw_title</td>
                                                                <td>$item_qty $raw_unit</td>
                                                            </tr>
                                                        ";
                                                    }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h6>Note :-</h6>
                                            <p class="font-italic"><?php echo $row_purchase_entries['email_note']; ?></p>
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
                            <a href="enquiry_mail?purchase_enquiry_mail=<?php echo $row_purchase_entries['purchase_enquiry_id']; ?>" class="btn icon btn-primary <?php if($row_purchase_entries['purchase_enquiry_delivery_status']==='shipped' || $row_purchase_entries['purchase_enquiry_delivery_status']==='cancelled'){echo"d-none";} ?>" title="Resend Mail"><i class="fas fa-envelope"></i></a>
                            <a href="index.php?purchase_enquiry_edit=<?php echo $row_purchase_entries['purchase_enquiry_id']; ?>" class="btn icon btn-warning <?php if($row_purchase_entries['purchase_enquiry_delivery_status']==='shipped' || $row_purchase_entries['purchase_enquiry_delivery_status']==='cancelled'){echo"d-none";} ?>" title="edit"><i class="fas fa-pen-square"></i></i></a>
                            <a href="update.php?purchase_enquiry=<?php echo $row_purchase_entries['purchase_enquiry_id']; ?>" class="btn icon btn-success text-capitalize <?php if($row_purchase_entries['purchase_enquiry_delivery_status']==='shipped' || $row_purchase_entries['purchase_enquiry_delivery_status']==='cancelled'){echo"d-none";} ?>" onclick="return confirm('Are you sure you?');" title="Update Shipped"><i class="fas fa-check"></i></i></i></a>
                            <a href="delete.php?purchase_enquiry=<?php echo $row_purchase_entries['purchase_enquiry_id']; ?>" class="btn icon btn-danger text-capitalize <?php if($row_purchase_entries['purchase_enquiry_delivery_status']==='shipped' || $row_purchase_entries['purchase_enquiry_delivery_status']==='cancelled'){echo"d-none";} ?>" onclick="return confirm('Are you sure you?');" title="Cancel"><i class="fas fa-times"></i></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>