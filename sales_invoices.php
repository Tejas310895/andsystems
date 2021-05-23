<div class="row">
    <div class="page-title col-md-10">
        <h3>Sale Invoices</h3>
        <p class="text-subtitle text-muted">Below are the details of Sale invoices</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_sale_invoice" class="btn btn-primary" style="float:right;">New Sale Invoice</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Invoice no.</th>
                        <th>Customer Name</th>
                        <th>Products</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                    $get_sale_inc = "select * from sale_inc_entries where sale_inc_status='active'";
                    $run_sale_inc = mysqli_query($con,$get_sale_inc);
                    while($row_sale_inc = mysqli_fetch_array($run_sale_inc)){
                        
                        $sale_inc_entry_id = $row_sale_inc['sale_inc_entry_id'];
                        $sale_inc_no = $row_sale_inc['sale_inc_no'];

                ?>
                    <tr>
                        <td><?php echo date('d-M-Y',strtotime($row_sale_inc['sale_inc_date'])); ?></td>
                        <td><?php echo $sale_inc_no; ?></td>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-link bg-transparent border-0 text-dark" data-bs-toggle="modal"
                                data-bs-target="#sic<?php echo $row_sale_inc['sale_inc_no']; ?>">
                                   <?php echo $row_sale_inc['billed_title']; ?>
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="sic<?php echo $row_sale_inc['sale_inc_no']; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                <?php echo $row_sale_inc['billed_title']; ?> Details</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Billed Details: <br>
                                                Name : <?php echo $row_sale_inc['billed_title']; ?><br>
                                                Contact : <?php echo $row_sale_inc['billed_contact']; ?><br>
                                                GSTN : <?php echo $row_sale_inc['billed_gstn']; ?><br>
                                                Address : <?php echo $row_sale_inc['billed_address']; ?> <?php echo $row_sale_inc['billed_state']; ?><br>
                                                State Code : <?php echo $row_sale_inc['billed_state_code']; ?><br><br>

                                                Shipped Details: <br>
                                                Name : <?php echo $row_sale_inc['shipped_title']; ?><br>
                                                Contact : <?php echo $row_sale_inc['shipped_contact']; ?><br>
                                                GSTN : <?php echo $row_sale_inc['shipped_gstn']; ?><br>
                                                Address : <?php echo $row_sale_inc['shipped_address']; ?> <?php echo $row_sale_inc['shipped_state']; ?><br>
                                                State Code : <?php echo $row_sale_inc['shipped_state_code']; ?><br>
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
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#sp<?php echo $sale_inc_no; ?>">
                                View Here
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="sp<?php echo $sale_inc_no; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                Products For Invoice(<?php echo $sale_inc_no; ?>)</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Rate</th>
                                                        <th>Gst</th>
                                                        <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        
                                                        $get_inc_products = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                                                        $run_inc_products = mysqli_query($con,$get_inc_products);
                                                        $sale_total_amount = 0;
                                                        $sale_total_gst = 0;
                                                        while($row__inc_products=mysqli_fetch_array($run_inc_products)){
                                                            $sale_product_type = $row__inc_products['sale_product_type'];
                                                            $sale_product_id = $row__inc_products['sale_product_id'];
                                                            $sale_product_qty = $row__inc_products['sale_product_qty'];
                                                            $sale_product_unit_rate = $row__inc_products['sale_product_unit_rate'];
                                                            $sale_product_hsn_code = $row__inc_products['sale_product_hsn_code'];
                                                            $sale_product_gst_rate = $row__inc_products['sale_product_gst_rate'];
                                                            $sale_product_gst_type = $row__inc_products['sale_product_gst_type'];
                                                            $sale_product_discount = $row__inc_products['sale_product_discount'];

                                                            $sale_amount = $sale_product_unit_rate*$sale_product_qty;
                                                            $sale_gst = $sale_amount*($sale_product_gst_rate/100);

                                                            $sale_total_amount += $sale_amount;
                                                            $sale_total_gst += $sale_gst;

                                                            if($sale_product_type==='raw'){
                                                                $get_raw_products = "select * from raw_products where raw_product_id='$sale_product_id'";
                                                                $run_raw_products = mysqli_query($con,$get_raw_products);
                                                                $row_raw_products = mysqli_fetch_array($run_raw_products);

                                                                $sale_inc_product_title = $row_raw_products['raw_product_title'];
                                                            }elseif($sale_product_type==='custom'){
                                                                $get_custom_products = "select * from custom_products where custom_product_id='$sale_product_id'";
                                                                $run_custom_products = mysqli_query($con,$get_custom_products);
                                                                $row_custom_products = mysqli_fetch_array($run_custom_products);

                                                                $sale_inc_product_title = $row_custom_products['custom_product_title'];
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $sale_inc_product_title; ?></td>
                                                            <td><?php echo $sale_product_qty; ?></td>
                                                            <td><?php echo $sale_product_unit_rate; ?></td>
                                                            <td>
                                                                <?php echo $sale_gst; ?><br>
                                                                <small>
                                                                    <?php 
                                                                        if($sale_product_gst_type==='STA_TAX'){
                                                                            $gst_rate = $sale_product_gst_rate/2;
                                                                            echo "<small>($gst_rate% cgst + $gst_rate% sgst)</small>";
                                                                        }elseif($sale_product_gst_type==='CEN_TAX'){
                                                                            echo "<small>($sale_product_gst_rate% igst)</small>";
                                                                        }                                                                    
                                                                    ?>
                                                                </small>
                                                            </td>
                                                            <td><?php echo $sale_amount; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <th colspan="4" class="text-end">TOTAL</th>
                                                            <th><?php echo $sale_total_amount; ?></th>
                                                        </tr>
                                                        <tr>
                                                                <th colspan="4" class="text-end">GRAND TOTAL</th>
                                                                <th><?php echo $sale_total_amount+$sale_total_gst; ?></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
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
                        <td>
                        <a href="delete.php?sales_invoice=<?php echo $sale_inc_entry_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you?');">Delete</a>
                        <a href="sale_inc_print.php?sale_inc_print=<?php echo $sale_inc_entry_id; ?>" target="_blank" class="btn btn-info">Print</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>