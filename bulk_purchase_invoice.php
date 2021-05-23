<form action="ajax/bulk_excel_purchase_invoice.php" method="post">
    <section class="section">
        <div class="card">
            <div class="card-header pb-1">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-title">
                            <h2 class="mb-0">Purchase Invoice Reports</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="purchase_excel" class="btn btn-icon btn-success float-end mx-2">Excel <i data-feather="download"></i></button>
                        <button type="submit" name="purchase_xml" class="btn btn-icon btn-warning float-end mx-2">XML<i data-feather="download"></i></button>
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
                                        <input type="checkbox" id="purchase_check_all" class='form-check-input'>
                                        <label for="checkbox1">Select all</label>
                                    </div>
                                </div>
                            </th>
                            <th>Date</th>
                            <th>Invoice no.</th>
                            <th>Supplier Name</th>
                            <th>Products</th>
                            <th>Taxable Value</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_purchase_inc = "select * from purchase_inc_entries where purchase_inc_status='active'";
                    $run_purchase_inc = mysqli_query($con,$get_purchase_inc);
                    while($row_purchase_inc = mysqli_fetch_array($run_purchase_inc)){
                        
                        $purchase_inc_entry_id = $row_purchase_inc['purchase_inc_entry_id'];
                        $supplier_id = $row_purchase_inc['supplier_id'];
                        $purchase_inc_no = $row_purchase_inc['purchase_inc_no'];

                        
                        $get_amount = "select * from purchase_inc_products where purchase_inc_no='$purchase_inc_no'";
                        $run_amount = mysqli_query($con,$get_amount);
                        $purchase_amount = 0;
                        while($row_amount = mysqli_fetch_array($run_amount)){
                            $purchase_inc_product_unit_rate = $row_amount['purchase_inc_product_unit_rate'];
                            $purchase_inc_product_qty = $row_amount['purchase_inc_product_qty'];
                            $sub_amt = $purchase_inc_product_unit_rate*$purchase_inc_product_qty;
                            $purchase_amount += $sub_amt;
                        }

                        $get_supplier = "select * from suppliers where supplier_id='$supplier_id'";
                        $run_suppliers = mysqli_query($con,$get_supplier);
                        $row_supplier = mysqli_fetch_array($run_suppliers);
                ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" id="purchase_check" class='form-check-input' name="purchase_inc[]" value="<?php echo $purchase_inc_no; ?>">
                            </div>
                        </td>
                        <td><?php echo date('d-M-Y',strtotime($row_purchase_inc['purchase_inc_date'])); ?></td>
                        <td><?php echo $purchase_inc_no; ?></td>
                        <td><?php echo $row_supplier['supplier_title']; ?></td>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#pi<?php echo $purchase_inc_entry_id; ?>">
                                View Here
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="pi<?php echo $purchase_inc_entry_id; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                Products For Invoice(<?php echo $purchase_inc_no; ?>)</h5>
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
                                                        $total_purchase = 0;
                                                        $total_gst = 0;
                                                        $get_purchase_products = "select * from purchase_inc_products where purchase_inc_no='$purchase_inc_no'";
                                                        $run_purchase_products = mysqli_query($con,$get_purchase_products);
                                                        while($row_purchase_products=mysqli_fetch_array($run_purchase_products)){

                                                            $raw_product_id = $row_purchase_products['raw_product_id'];
                                                            $raw_product_unit_rate = $row_purchase_products['purchase_inc_product_unit_rate'];
                                                            $raw_product_gst_type = $row_purchase_products['purchase_inc_product_gst_type'];
                                                            $raw_product_gst_rate = $row_purchase_products['purchase_inc_product_gst_rate'];
                                                            $product_total_rate = ($row_purchase_products['purchase_inc_product_qty'])*$raw_product_unit_rate;
                                                            $product_total_gst = $product_total_rate*($raw_product_gst_rate/100);

                                                            $total_purchase += $product_total_rate;
                                                            $total_gst += $product_total_gst;

                                                            $get_raw_product = "select * from raw_products where raw_product_id='$raw_product_id'";
                                                            $run_raw_product = mysqli_query($con,$get_raw_product);
                                                            $row_raw_product = mysqli_fetch_array($run_raw_product);
                                                    ?>
                                                        <tr>
                                                        <td class="text-bold-500"><?php echo $row_raw_product['raw_product_title']; ?></td>
                                                        <td><?php echo $row_purchase_products['purchase_inc_product_qty']." ".$row_raw_product['raw_product_unit']; ?></td>
                                                        <td><?php echo $raw_product_unit_rate; ?></td>
                                                        <td><?php echo $product_total_rate; ?></td>
                                                        <td>
                                                            <?php 

                                                                echo $product_total_gst."<br>";

                                                                if($raw_product_gst_type==='STA_TAX'){
                                                                    $gst_rate = $raw_product_gst_rate/2;
                                                                    echo "<small>($gst_rate% cgst + $gst_rate% sgst)</small>";
                                                                }elseif($raw_product_gst_type==='CEN_TAX'){
                                                                    echo "<small>($raw_product_gst_rate% igst)</small>";
                                                                }
                                                            
                                                            ?>
                                                        </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <th colspan="3" class="text-end">TOTAL</th>
                                                            <th><?php echo $total_purchase; ?></th>
                                                            <th><?php echo $total_gst; ?></th>
                                                        </tr>
                                                        <tr>
                                                                <th colspan="4" class="text-end">GRAND TOTAL</th>
                                                                <th><?php echo $total_purchase+$total_gst; ?></th>
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
                        <td><?php echo $purchase_amount; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</form>