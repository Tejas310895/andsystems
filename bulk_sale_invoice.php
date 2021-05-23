<form action="ajax/bulk_excel_sale_invoice.php" method="post">
    <section class="section">
        <div class="card">
            <div class="card-header pb-1">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-title">
                            <h2 class="mb-0">Sale Invoice Reports</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="sale_excel" class="btn btn-icon btn-success float-end mx-2">Excel <i data-feather="download"></i></button>
                        <button type="submit" name="sale_xml" class="btn btn-icon btn-warning float-end mx-2">XML<i data-feather="download"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>
                                <div class='form-check'>
                                    <div class="checkbox">
                                        <input type="checkbox" id="sale_check_all" class='form-check-input'>
                                        <label for="checkbox1">Select all</label>
                                    </div>
                                </div>
                            </th>
                            <th>Date</th>
                            <th>Invoice no.</th>
                            <th>Customer Name</th>
                            <th>Products</th>
                            <th>Taxable Value</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_sale_inc = "select * from sale_inc_entries where sale_inc_status='active'";
                    $run_sale_inc = mysqli_query($con,$get_sale_inc);
                    while($row_sale_inc = mysqli_fetch_array($run_sale_inc)){
                        
                        $sale_inc_entry_id = $row_sale_inc['sale_inc_entry_id'];
                        $sale_inc_no = $row_sale_inc['sale_inc_no'];
                        $sale_inc_date = $row_sale_inc['sale_inc_date'];
                        $billed_title = $row_sale_inc['billed_title'];

                        
                        $get_amount = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                        $run_amount = mysqli_query($con,$get_amount);
                        $sale_amount = 0;
                        while($row_amount = mysqli_fetch_array($run_amount)){
                            $sale_product_unit_rate = $row_amount['sale_product_unit_rate'];
                            $sale_product_qty = $row_amount['sale_product_qty'];
                            $sub_amt = $sale_product_unit_rate*$sale_product_qty;
                            $sale_amount += $sub_amt;
                        }

                ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" id="sale_check" class='form-check-input' name="sale_inc[]" value="<?php echo $sale_inc_no; ?>">
                            </div>
                        </td>
                        <td><?php echo date('d-M-Y',strtotime($sale_inc_date)); ?></td>
                        <td><?php echo $sale_inc_no; ?></td>
                        <td><?php echo $billed_title; ?></td>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#pi<?php echo $sale_inc_entry_id; ?>">
                                View Here
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="pi<?php echo $sale_inc_entry_id; ?>" tabindex="-1" role="dialog"
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
                                                        <th>Amount</th>
                                                        <th>Gst</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        $total_sale = 0;
                                                        $total_gst = 0;
                                                        $get_sale_products = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                                                        $run_sale_products = mysqli_query($con,$get_sale_products);
                                                        while($row_sale_products=mysqli_fetch_array($run_sale_products)){

                                                            $sale_product_id = $row_sale_products['sale_product_id'];
                                                            $sale_product_qty = $row_sale_products['sale_product_qty'];
                                                            $sale_product_type = $row_sale_products['sale_product_type'];
                                                            $sale_product_unit_rate = $row_sale_products['sale_product_unit_rate'];
                                                            $sale_product_gst_rate = $row_sale_products['sale_product_gst_rate'];
                                                            $sale_product_gst_type = $row_sale_products['sale_product_gst_type'];
                                                            $product_total_rate = $sale_product_qty*$sale_product_unit_rate;
                                                            $product_total_gst = $product_total_rate*($sale_product_gst_rate/100);

                                                            $total_sale += $product_total_rate;
                                                            $total_gst += $product_total_gst;

                                                            if($sale_product_type==='raw'){

                                                                $get_raw_product = "select * from raw_products where raw_product_id='$sale_product_id'";
                                                                $run_raw_product = mysqli_query($con,$get_raw_product);
                                                                $row_raw_product = mysqli_fetch_array($run_raw_product); 
                                                                
                                                                $product_title = $row_raw_product['raw_product_title'];
                                                                $product_unit = $row_raw_product['raw_product_unit'];
                                                                $product_subunit = $row_raw_product['raw_product_subunit'];

                                                            }elseif($sale_product_type==='custom'){

                                                                $get_custom_product = "select * from custom_products where custom_product_id='$sale_product_id'";
                                                                $run_custom_product = mysqli_query($con,$get_custom_product);
                                                                $row_custom_product = mysqli_fetch_array($run_custom_product);  
                                                                
                                                                $product_title = $row_custom_product['custom_product_title'];
                                                                $product_unit = $row_custom_product['custom_product_unit'];
                                                                $product_subunit = $row_custom_product['custom_product_subunit'];

                                                            }

                                                    ?>
                                                        <tr>
                                                        <td class="text-bold-500"><?php echo $product_title; ?></td>
                                                        <td><?php echo $sale_product_qty." ".$product_unit; ?></td>
                                                        <td><?php echo $sale_product_unit_rate; ?></td>
                                                        <td><?php echo $product_total_rate; ?></td>
                                                        <td>
                                                            <?php 

                                                                echo $product_total_gst."<br>";

                                                                if($sale_product_gst_type==='STA_TAX'){
                                                                    $gst_rate = $sale_product_gst_rate/2;
                                                                    echo "<small>($gst_rate% cgst + $gst_rate% sgst)</small>";
                                                                }elseif($sale_product_gst_type==='CEN_TAX'){
                                                                    echo "<small>($sale_product_gst_rate% igst)</small>";
                                                                }
                                                            
                                                            ?>
                                                        </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <th colspan="3" class="text-end">TOTAL</th>
                                                            <th><?php echo $total_sale; ?></th>
                                                            <th><?php echo $total_gst; ?></th>
                                                        </tr>
                                                        <tr>
                                                                <th colspan="4" class="text-end">GRAND TOTAL</th>
                                                                <th><?php echo $total_sale+$total_gst; ?></th>
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
                        <td><?php echo $sale_amount; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</form>