
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Sale Invoice</h3>
    </div>
    <div class="col-md-2">
        <a href="index.php?sales_invoices" class="btn btn-primary" style="float:right;">Sale Invoices</a>
    </div>
</div>
<section class="section">
<div class="row">
    <div class="col-12 grid-margin px-0">
            <form class="form-sample" id="invoice_form" action="" method="post">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h4 class="card-title">Company Details</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                        <label class="col-form-label" id="label_qty">Invoice Number</label>
                                            <input type="text" class="form-control" name="sale_inc_no" id="sale_inc_no" value="" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                        <label class="col-sm-12 col-form-label" id="label_qty">Invoice Date</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" name="sale_inc_date" id="sale_inc_date" required/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-form-label" id="label_qty">Due Date</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" name="sale_inc_due_date" id="sale_inc_due_date" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title">Transporter Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Transporter Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="transport_title" id="transport_title" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Vehicle Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="transport_vehicle_no" id="transport_vehicle_no" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">E-Way Bill Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="e_way_bill_no" id="e_way_bill_no" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Shipping Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="sale_supply_date" id="sale_supply_date" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Extra Paid</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="extra_paid" id="extra_paid" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title">Details Of Reciever (Billed To)</h4>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Partner Name</label>
                                            <div class="col-sm-9">
                                            <select class="form-control" name="billed_title" id="billed_title" required>
                                            <option disabled selected value>Choose the Customers</option>
                                            <?php 
                                            
                                            $get_customers = "select * from customers";
                                            $run_customers = mysqli_query($con,$get_customers);
                                            while($row_customers=mysqli_fetch_array($run_customers)){

                                                $customer_title = $row_customers['customer_title'];
                                                echo "<option value='$customer_title'>$customer_title</option>";
                                            }
                                            
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="billed_contact" id="billed_contact" value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                            <textarea class="form-control" name="billed_address" id="billed_address" value="" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">GSTIN Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="billed_gstn" id="billed_gstn" value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">State</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="billed_state" id="billed_state" value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">State Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="billed_state_code" id="billed_state_code" value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="form-check my-1 mx-4">
                                    <input type="checkbox" class="form-check-input" id="match_billed">
                                    <label class="form-check-label text-white" for="exampleCheck1"><h5><i class="fas fa-check"></i> if consignee details are same as Billed</h5></label>
                                </div>
                            <div class="card-body">
                                <h4 class="card-title">Details Of consignee (Shipped To)</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="shipped_title" id="shipped_title" value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="shipped_contact" id="shipped_contact" value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                            <textarea class="form-control" name="shipped_address" id="shipped_address"  value="" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">GSTIN Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="shipped_gstn" id="shipped_gstn"  value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">State</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="shipped_state" id="shipped_state"  value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" id="label_qty">State Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="shipped_state_code" id="shipped_state_code"  value="" placeholder="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="product_type" name="product_type" required>
                                                    <option value="" selected disabled>Select the product type</option>
                                                    <option value="raw">Raw Product</option>
                                                    <option value="custom">Custom Product</option>
                                                    <option value="both">Both Raw and Custom Product</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 d-none" id="raw_select">
                            <div class="card-body">
                                <div class="form-group fieldGroup">
                                    <h4 class="card-title">Add Raw Products</h4>
                                    <div class="input-group">
                                        <select class="form-control" name="raw_product_id[]" id="raw_product_id">
                                        <option disabled selected value=''>Choose the product</option>
                                        <?php 
                                        
                                        $get_raw_product = "select * from raw_products";
                                        $run_raw_product = mysqli_query($con,$get_raw_product);
                                        while($row_raw_product=mysqli_fetch_array($run_raw_product)){
                                            $raw_product_id = $row_raw_product['raw_product_id'];
                                            $raw_product_title = $row_raw_product['raw_product_title'];
                                            $raw_product_unit = $row_raw_product['raw_product_unit'];
                                            $raw_product_stock = $row_raw_product['raw_product_stock'];
                                            echo "<option value='$raw_product_id'>$raw_product_title ($raw_product_stock $raw_product_unit Available)</option>";
                                        }
                                        ?>
                                        </select>
                                        <label for=""></label>
                                        <input type="text" name="raw_hsn_code[]" id="raw_product_qty" class="form-control" placeholder="HSN CODE"/>
                                        <input type="text" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Quantity"/>
                                        <input type="text" name="raw_product_unit_rate[]" id="raw_product_unit_rate" class="form-control" placeholder="Unit Rate"/>
                                        <input type="text" name="raw_product_discount[]" id="raw_product_discount" class="form-control" placeholder="Discount %"/>
                                        <select class="form-control" name="raw_product_gst_type[]" id="raw_product_gst_type">
                                            <option disabled selected value=''>GST TYPE</option>
                                            <option value="STA_TAX">STATE TAX</option>
                                            <option value="CEN_TAX">CENTER TAX</option>
                                        </select>
                                        <input type="text" name="raw_product_gst_rate[]" id="raw_product_gst_rate" class="form-control" placeholder="GST RATE"/>
                                        <div class="input-group-addon mx-4 mt-1"> 
                                            <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 d-none" id="custom_select">
                            <div class="card-body">
                                <div class="form-group fieldGroup1">
                                    <h4 class="card-title">Add Custom Products</h4>
                                    <div class="input-group">
                                        <select class="form-control" name="custom_product_id[]" id="custom_product_id">
                                        <option disabled selected value=''>Choose the product</option>
                                        <?php 
                                        
                                        $get_custom_product = "select * from custom_products";
                                        $run_custom_product = mysqli_query($con,$get_custom_product);
                                        while($row_custom_product=mysqli_fetch_array($run_custom_product)){
                                            $custom_product_id = $row_custom_product['custom_product_id'];
                                            $custom_product_title = $row_custom_product['custom_product_title'];
                                            $custom_product_unit = $row_custom_product['custom_product_unit'];
                                            $custom_product_stock = $row_custom_product['custom_product_stock'];
                                            echo "<option value='$custom_product_id'>$custom_product_title($custom_product_stock $custom_product_unit Available)</option>";
                                        }
                                        ?>
                                        </select>
                                        <label for=""></label>
                                        <input type="text" name="custom_hsn_code[]" id="raw_product_qty" class="form-control" placeholder="HSN CODE"/>
                                        <input type="text" name="custom_product_qty[]" id="custom_product_qty" class="form-control" placeholder="Quantity"/>
                                        <input type="text" name="custom_product_unit_rate[]" id="custom_product_unit_rate" class="form-control" placeholder="Unit Rate"/>
                                        <input type="text" name="custom_product_discount[]" id="custom_product_discount" class="form-control" placeholder="Discount %"/>
                                        <select class="form-control" name="custom_product_gst_type[]" id="custom_product_gst_type">
                                            <option disabled selected value=''>GST TYPE</option>
                                            <option value="STA_TAX">STATE TAX</option>
                                            <option value="CEN_TAX">CENTER TAX</option>
                                        </select>
                                        <input type="text" name="custom_product_gst_rate[]" id="custom_product_gst_rate" class="form-control" placeholder="GST RATE"/>
                                        <div class="input-group-addon mx-4 mt-1"> 
                                            <a href="javascript:void(0)" class="btn btn-success addMore1"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="invoice_entry" name="invoice_entry" class="btn btn-success mr-2 btn-lg float-end py-2">Generate Invoice</button>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6">
                            </div>
                        </div> -->
                </form>
                <!-- copy of input fields group -->
                <div class="form-group fieldGroupCopy" style="display: none;">
                    <div class="input-group">
                        <select class="form-control" name="raw_product_id[]" id="raw_product_id" required>
                        <option disabled selected value=''>Choose the product</option>
                        <?php 
                                        
                        $get_raw_product = "select * from raw_products";
                        $run_raw_product = mysqli_query($con,$get_raw_product);
                        while($row_raw_product=mysqli_fetch_array($run_raw_product)){
                            $raw_product_id = $row_raw_product['raw_product_id'];
                            $raw_product_title = $row_raw_product['raw_product_title'];
                            $raw_product_unit = $row_raw_product['raw_product_unit'];
                            $raw_product_stock = $row_raw_product['raw_product_stock'];
                            echo "<option value='$raw_product_id'>$raw_product_title ($raw_product_stock $raw_product_unit Available)</option>";
                        }
                        ?>
                        </select>
                        <input type="text" name="raw_hsn_code[]" id="raw_product_qty" class="form-control" placeholder="HSN CODE"/>
                        <input type="text" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Quantity" required/>
                        <input type="text" name="raw_product_unit_rate[]" id="raw_product_unit_rate" class="form-control" placeholder="Unit Rate" required/>
                        <input type="text" name="raw_product_discount[]" id="raw_product_discount" class="form-control" placeholder="Discount %" required/>
                        <select class="form-control" name="raw_product_gst_type[]" id="raw_product_gst_type" required>
                            <option disabled selected value=''>GST TYPE</option>
                            <option value="STA_TAX">STATE TAX</option>
                            <option value="CEN_TAX">CENTER TAX</option>
                        </select>
                        <input type="text" name="raw_product_gst_rate[]" id="raw_product_gst_rate" class="form-control" placeholder="GST RATE" required/>
                        <div class="input-group-addon mx-4 mt-1"> 
                            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
                        </div>
                    </div>
                </div>
                <!-- copy of input fields group -->
                <div class="form-group fieldGroupCopy1" style="display: none;">
                    <div class="input-group">
                        <select class="form-control" name="custom_product_id[]" id="custom_product_id" required>
                        <option disabled selected value=''>Choose the product</option>
                        <?php 
                                        
                        $get_custom_product = "select * from custom_products";
                        $run_custom_product = mysqli_query($con,$get_custom_product);
                        while($row_custom_product=mysqli_fetch_array($run_custom_product)){
                            $custom_product_id = $row_custom_product['custom_product_id'];
                            $custom_product_title = $row_custom_product['custom_product_title'];
                            $custom_product_unit = $row_custom_product['custom_product_unit'];
                            $custom_product_stock = $row_custom_product['custom_product_stock'];
                            echo "<option value='$custom_product_id'>$custom_product_title($custom_product_stock $custom_product_unit Available)</option>";
                        }
                        ?>
                        </select>
                        <input type="text" name="custom_hsn_code[]" id="raw_product_qty" class="form-control" placeholder="HSN CODE"/>
                        <input type="text" name="custom_product_qty[]" id="custom_product_qty" class="form-control" placeholder="Quantity" required/>
                        <input type="text" name="custom_product_unit_rate[]" id="custom_product_unit_rate" class="form-control" placeholder="Unit Rate" required/>
                        <input type="text" name="custom_product_discount[]" id="custom_product_discount" class="form-control" placeholder="Discount %" required/>
                        <select class="form-control" name="custom_product_gst_type[]" id="custom_product_gst_type" required>
                            <option disabled selected value=''>GST TYPE</option>
                            <option value="STA_TAX">STATE TAX</option>
                            <option value="CEN_TAX">CENTER TAX</option>
                        </select>
                        <input type="text" name="custom_product_gst_rate[]" id="custom_product_gst_rate" class="form-control" placeholder="GST RATE" required/>
                        <div class="input-group-addon mx-4 mt-1"> 
                            <a href="javascript:void(0)" class="btn btn-danger remove1"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/sales.js"></script>
<?php 

if(isset($_POST['invoice_entry'])){
    //variables//
    $sale_inc_no = $_POST['sale_inc_no'];
    $sale_inc_date = $_POST['sale_inc_date'];
    $sale_inc_due_date = $_POST['sale_inc_due_date'];
    $transport_title = $_POST['transport_title'];
    $transport_vehicle_no = $_POST['transport_vehicle_no'];
    $e_way_bill_no = $_POST['e_way_bill_no'];
    $sale_supply_date = $_POST['sale_supply_date'];
    $extra_paid = $_POST['extra_paid'];
    $billed_title = $_POST['billed_title'];
    $billed_contact = $_POST['billed_contact'];
    $billed_address = $_POST['billed_address'];
    $billed_gstn = $_POST['billed_gstn'];
    $billed_state = $_POST['billed_state'];
    $billed_state_code = $_POST['billed_state_code'];
    $shipped_title = $_POST['shipped_title'];
    $shipped_contact = $_POST['shipped_contact'];
    $shipped_address = $_POST['shipped_address'];
    $shipped_gstn = $_POST['shipped_gstn'];
    $shipped_state = $_POST['shipped_state'];
    $shipped_state_code = $_POST['shipped_state_code'];
    $extra_paid = $_POST['extra_paid'];
    $product_type = $_POST['product_type'];
    //arrays//
    // $invoice_no = $invoice_pre.$invoice_suf;

    if($product_type==='raw'){

    $raw_product_idArr = $_POST['raw_product_id'];
    $raw_hsn_codeArr = $_POST['raw_hsn_code'];
    $raw_product_qtyArr = $_POST['raw_product_qty'];
    $raw_product_unit_rateArr = $_POST['raw_product_unit_rate'];
    $raw_product_discountArr = $_POST['raw_product_discount'];
    $raw_product_gst_typeArr = $_POST['raw_product_gst_type'];
    $raw_product_gst_rateArr = $_POST['raw_product_gst_rate'];

    }elseif($product_type==='custom'){

    $custom_product_idArr = $_POST['custom_product_id'];
    $custom_hsn_codeArr = $_POST['custom_hsn_code'];
    $custom_product_qtyArr = $_POST['custom_product_qty'];
    $custom_product_unit_rateArr = $_POST['custom_product_unit_rate'];
    $custom_product_discountArr = $_POST['custom_product_discount'];
    $custom_product_gst_typeArr = $_POST['custom_product_gst_type'];
    $custom_product_gst_rateArr = $_POST['custom_product_gst_rate'];

    }elseif($product_type==='both'){

    $raw_product_idArr = $_POST['raw_product_id'];
    $raw_hsn_codeArr = $_POST['raw_hsn_code'];
    $raw_product_qtyArr = $_POST['raw_product_qty'];
    $raw_product_unit_rateArr = $_POST['raw_product_unit_rate'];
    $raw_product_discountArr = $_POST['raw_product_discount'];
    $raw_product_gst_typeArr = $_POST['raw_product_gst_type'];
    $raw_product_gst_rateArr = $_POST['raw_product_gst_rate'];

    $custom_product_idArr = $_POST['custom_product_id'];
    $custom_hsn_codeArr = $_POST['custom_hsn_code'];
    $custom_product_qtyArr = $_POST['custom_product_qty'];
    $custom_product_unit_rateArr = $_POST['custom_product_unit_rate'];
    $custom_product_discountArr = $_POST['custom_product_discount'];
    $custom_product_gst_typeArr = $_POST['custom_product_gst_type'];
    $custom_product_gst_rateArr = $_POST['custom_product_gst_rate'];

    }
    

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    //raw product stock check
    if(!empty($raw_product_idArr)){
        $count_raw_product=0;
        $raw_product_stock=0;
        for($i = 0; $i < count($raw_product_idArr); $i++){
            if(!empty($raw_product_idArr[$i])){
                $raw_product_id = $raw_product_idArr[$i];
                $raw_product_qty = $raw_product_qtyArr[$i];

                $get_raw_stock = "select * from raw_products where raw_product_id='$raw_product_id'";
                $run_raw_stock = mysqli_query($con,$get_raw_stock);
                $row_raw_stock = mysqli_fetch_array($run_raw_stock);
                $avai_raw_quantity = $row_raw_stock['raw_product_stock'];
                if($avai_raw_quantity<$raw_product_qty){
                    $raw_product_stock=0;
                }else{
                    $raw_product_stock=++$raw_product_stock;
                }

            }
            $count_raw_product=++$count_raw_product;
        }
    }

    //custom product stock check
    if(!empty($custom_product_idArr)){
        $count_custom_product=0;
        $custom_product_stock=0;
        for($i = 0; $i < count($custom_product_idArr); $i++){
            if(!empty($custom_product_idArr[$i])){
                $custom_product_id = $custom_product_idArr[$i];
                $custom_product_qty = $custom_product_qtyArr[$i];

                $get_custom_stock = "select * from custom_products where custom_product_id='$custom_product_id'";
                $run_custom_stock = mysqli_query($con,$get_custom_stock);
                $row_custom_stock = mysqli_fetch_array($run_custom_stock);
                $avai_custom_quantity = $row_custom_stock['custom_product_stock'];
                if($avai_custom_quantity<$custom_product_qty){
                    $custom_product_stock=0;
                }else{
                    $custom_product_stock=++$custom_product_stock;
                }

            }
            $count_custom_product=++$count_custom_product;
        }
    }

    $get_invoice = "select * from sale_inc_entries where sale_inc_no='$sale_inc_no' and sale_inc_status='active'";
    $run_invoice = mysqli_query($con,$get_invoice);
    $count_invoice = mysqli_num_rows($run_invoice);

    if($count_invoice==0){

        if($product_type==='raw'){

            if($raw_product_stock==$count_raw_product){

                $insert_sale_invoice = "insert into sale_inc_entries (sale_inc_no,
                                                                    sale_inc_date,
                                                                    sale_inc_due_date,
                                                                    sale_supply_date,
                                                                    transport_title,
                                                                    transport_vehicle_no,
                                                                    e_way_bill_no,
                                                                    billed_title,
                                                                    billed_contact,
                                                                    billed_address,
                                                                    billed_state,
                                                                    billed_state_code,
                                                                    billed_gstn,
                                                                    shipped_title,
                                                                    shipped_contact,
                                                                    shipped_address,
                                                                    shipped_state,
                                                                    shipped_state_code,
                                                                    shipped_gstn,
                                                                    extra_paid,
                                                                    sale_inc_status,
                                                                    sale_inc_created_at,
                                                                    sale_inc_updated_at)
                                                                    values
                                                                    ('$sale_inc_no',
                                                                    '$sale_inc_date',
                                                                    '$sale_inc_due_date',
                                                                    '$sale_supply_date',
                                                                    '$transport_title',
                                                                    '$transport_vehicle_no',
                                                                    '$e_way_bill_no',
                                                                    '$billed_title',
                                                                    '$billed_contact',
                                                                    '$billed_address',
                                                                    '$billed_state',
                                                                    '$billed_state_code',
                                                                    '$billed_gstn',
                                                                    '$shipped_title',
                                                                    '$shipped_contact',
                                                                    '$shipped_address',
                                                                    '$shipped_state',
                                                                    '$shipped_state_code',
                                                                    '$shipped_gstn',
                                                                    '$extra_paid',
                                                                    'active',
                                                                    '$today',
                                                                    '$today')";
                $run_sale_invoice = mysqli_query($con,$insert_sale_invoice);

                if($run_sale_invoice){
                    $insert_task = "insert into work_task_entries (user_id,
                                                                    work_task_title,
                                                                    work_task_content,
                                                                    work_task_entry_created_at,
                                                                    work_task_entry_updated_at)
                                                                    values 
                                                                    ('$user_id',
                                                                    'Sale invoice entry done',
                                                                    'Sale Invoice with Invoice number $sale_inc_no is been inserted',
                                                                    '$today',
                                                                    '$today')";
                    $run_insert_task = mysqli_query($con,$insert_task);
                }
                if($run_sale_invoice){
                    if(!empty($raw_product_idArr)){
                        for($i = 0; $i < count($raw_product_idArr); $i++){
                            if(!empty($raw_product_idArr[$i])){
                                $raw_product_id = $raw_product_idArr[$i];
                                $raw_product_qty = $raw_product_qtyArr[$i];
                                $raw_product_unit_rate = $raw_product_unit_rateArr[$i];
                                $raw_product_discount = $raw_product_discountArr[$i];
                                $raw_product_gst_type = $raw_product_gst_typeArr[$i];
                                $raw_product_gst_rate = $raw_product_gst_rateArr[$i];
                                $raw_hsn_code = $raw_hsn_codeArr[$i];
                    
                                // $get_raw_hsn = "select * from raw_products where raw_product_id='$raw_product_id'";
                                // $run_raw_hsn = mysqli_query($con,$get_raw_hsn);
                                // $row_raw_hsn = mysqli_fetch_array($run_raw_hsn);
                                // $raw_hsn_code = $row_raw_hsn['raw_product_hsn'];
                    
                    
                                $insert_raw_product = "insert into sale_inc_products (sale_inc_no,
                                                                                    sale_product_type,
                                                                                    sale_product_id,
                                                                                    sale_product_qty,
                                                                                    sale_product_unit_rate,
                                                                                    sale_product_hsn_code,
                                                                                    sale_product_gst_rate,
                                                                                    sale_product_gst_type,
                                                                                    sale_product_discount,
                                                                                    sale_product_created_at,
                                                                                    sale_product_updated_at) 
                                                                                    values 
                                                                                    ('$sale_inc_no',
                                                                                    'raw',
                                                                                    '$raw_product_id',
                                                                                    '$raw_product_qty',
                                                                                    '$raw_product_unit_rate',
                                                                                    '$raw_hsn_code',
                                                                                    '$raw_product_gst_rate',
                                                                                    '$raw_product_gst_type',
                                                                                    '$raw_product_discount',
                                                                                    '$today',
                                                                                    '$today')";
                    
                                $run_raw_product = mysqli_query($con,$insert_raw_product);
                    
                                $update_raw_stock = "update raw_products set raw_product_stock=raw_product_stock-'$raw_product_qty' where raw_product_id='$raw_product_id'";
                                $run_update_raw_stock = mysqli_query($con,$update_raw_stock);
                                
                            }
                        }
                    }
                }

                if($run_raw_product){
                    echo "<script>alert('Invoice Entry Successfully Done')</script>";
                }

            }else{
                echo "<script>alert('Raw Product Out Of Stock')</script>";
            }
        
        }elseif($product_type==='custom'){

            if($custom_product_stock==$count_custom_product){

                $insert_sale_invoice = "insert into sale_inc_entries (sale_inc_no,
                                                                    sale_inc_date,
                                                                    sale_inc_due_date,
                                                                    sale_supply_date,
                                                                    transport_title,
                                                                    transport_vehicle_no,
                                                                    e_way_bill_no,
                                                                    billed_title,
                                                                    billed_contact,
                                                                    billed_address,
                                                                    billed_state,
                                                                    billed_state_code,
                                                                    billed_gstn,
                                                                    shipped_title,
                                                                    shipped_contact,
                                                                    shipped_address,
                                                                    shipped_state,
                                                                    shipped_state_code,
                                                                    shipped_gstn,
                                                                    extra_paid,
                                                                    sale_inc_status,
                                                                    sale_inc_created_at,
                                                                    sale_inc_updated_at)
                                                                    values
                                                                    ('$sale_inc_no',
                                                                    '$sale_inc_date',
                                                                    '$sale_inc_due_date',
                                                                    '$sale_supply_date',
                                                                    '$transport_title',
                                                                    '$transport_vehicle_no',
                                                                    '$e_way_bill_no',
                                                                    '$billed_title',
                                                                    '$billed_contact',
                                                                    '$billed_address',
                                                                    '$billed_state',
                                                                    '$billed_state_code',
                                                                    '$billed_gstn',
                                                                    '$shipped_title',
                                                                    '$shipped_contact',
                                                                    '$shipped_address',
                                                                    '$shipped_state',
                                                                    '$shipped_state_code',
                                                                    '$shipped_gstn',
                                                                    '$extra_paid',
                                                                    'active',
                                                                    '$today',
                                                                    '$today')";
                $run_sale_invoice = mysqli_query($con,$insert_sale_invoice);

                if($run_sale_invoice){
                    $insert_task = "insert into work_task_entries (user_id,
                                                                    work_task_title,
                                                                    work_task_content,
                                                                    work_task_entry_created_at,
                                                                    work_task_entry_updated_at)
                                                                    values 
                                                                    ('$user_id',
                                                                    'Sale invoice entry done',
                                                                    'Sale Invoice with Invoice number $sale_inc_no is been inserted',
                                                                    '$today',
                                                                    '$today')";
                    $run_insert_task = mysqli_query($con,$insert_task);
                }

                if($run_sale_invoice){
                    if(!empty($custom_product_idArr)){
                        for($i = 0; $i < count($custom_product_idArr); $i++){
                            if(!empty($custom_product_idArr[$i])){
                                $custom_product_id = $custom_product_idArr[$i];
                                $custom_product_qty = $custom_product_qtyArr[$i];
                                $custom_product_unit_rate = $custom_product_unit_rateArr[$i];
                                $custom_product_discount = $custom_product_discountArr[$i];
                                $custom_product_gst_type = $custom_product_gst_typeArr[$i];
                                $custom_product_gst_rate = $custom_product_gst_rateArr[$i];
                                $custom_hsn_code = $custom_hsn_codeArr[$i];

                    
                                // $get_custom_hsn = "select * from custom_products where custom_product_id='$custom_product_id'";
                                // $run_custom_hsn = mysqli_query($con,$get_custom_hsn);
                                // $row_custom_hsn = mysqli_fetch_array($run_custom_hsn);
                                // $custom_hsn_code = $row_custom_hsn['custom_product_hsn'];
                    
                    
                                $insert_custom_product = "insert into sale_inc_products (sale_inc_no,
                                                                                    sale_product_type,
                                                                                    sale_product_id,
                                                                                    sale_product_qty,
                                                                                    sale_product_unit_rate,
                                                                                    sale_product_hsn_code,
                                                                                    sale_product_gst_rate,
                                                                                    sale_product_gst_type,
                                                                                    sale_product_discount,
                                                                                    sale_product_created_at,
                                                                                    sale_product_updated_at) 
                                                                                    values 
                                                                                    ('$sale_inc_no',
                                                                                    'custom',
                                                                                    '$custom_product_id',
                                                                                    '$custom_product_qty',
                                                                                    '$custom_product_unit_rate',
                                                                                    '$custom_hsn_code',
                                                                                    '$custom_product_gst_rate',
                                                                                    '$custom_product_gst_type',
                                                                                    '$custom_product_discount',
                                                                                    '$today',
                                                                                    '$today')";
                    
                                $run_custom_product = mysqli_query($con,$insert_custom_product);
                    
                                $update_custom_stock = "update custom_products set custom_product_stock=custom_product_stock-'$custom_product_qty' where custom_product_id='$custom_product_id'";
                                $run_update_custom_stock = mysqli_query($con,$update_custom_stock);
                                
                            }
                        }
                    }
                }
    
                if($run_custom_product){
                    echo "<script>alert('Invoice Entry Successfully Done')</script>";
                }
    
            }else{
                echo "<script>alert('Custom Product Out Of Stock')</script>";
            }
    
        }elseif($product_type==='both'){
    
            if($raw_product_stock==$count_raw_product && $custom_product_stock==$count_custom_product){

                $insert_sale_invoice = "insert into sale_inc_entries (sale_inc_no,
                                                                    sale_inc_date,
                                                                    sale_inc_due_date,
                                                                    sale_supply_date,
                                                                    transport_title,
                                                                    transport_vehicle_no,
                                                                    e_way_bill_no,
                                                                    billed_title,
                                                                    billed_contact,
                                                                    billed_address,
                                                                    billed_state,
                                                                    billed_state_code,
                                                                    billed_gstn,
                                                                    shipped_title,
                                                                    shipped_contact,
                                                                    shipped_address,
                                                                    shipped_state,
                                                                    shipped_state_code,
                                                                    shipped_gstn,
                                                                    extra_paid,
                                                                    sale_inc_status,
                                                                    sale_inc_created_at,
                                                                    sale_inc_updated_at)
                                                                    values
                                                                    ('$sale_inc_no',
                                                                    '$sale_inc_date',
                                                                    '$sale_inc_due_date',
                                                                    '$sale_supply_date',
                                                                    '$transport_title',
                                                                    '$transport_vehicle_no',
                                                                    '$e_way_bill_no',
                                                                    '$billed_title',
                                                                    '$billed_contact',
                                                                    '$billed_address',
                                                                    '$billed_state',
                                                                    '$billed_state_code',
                                                                    '$billed_gstn',
                                                                    '$shipped_title',
                                                                    '$shipped_contact',
                                                                    '$shipped_address',
                                                                    '$shipped_state',
                                                                    '$shipped_state_code',
                                                                    '$shipped_gstn',
                                                                    '$extra_paid',
                                                                    'active',
                                                                    '$today',
                                                                    '$today')";
                $run_sale_invoice = mysqli_query($con,$insert_sale_invoice);

                if($run_sale_invoice){
                    $insert_task = "insert into work_task_entries (user_id,
                                                                    work_task_title,
                                                                    work_task_content,
                                                                    work_task_entry_created_at,
                                                                    work_task_entry_updated_at)
                                                                    values 
                                                                    ('$user_id',
                                                                    'Sale invoice entry done',
                                                                    'Sale Invoice with Invoice number $sale_inc_no is been inserted',
                                                                    '$today',
                                                                    '$today')";
                    $run_insert_task = mysqli_query($con,$insert_task);
                }

                if($run_sale_invoice){
                    if(!empty($raw_product_idArr)){
                        for($i = 0; $i < count($raw_product_idArr); $i++){
                            if(!empty($raw_product_idArr[$i])){
                                $raw_product_id = $raw_product_idArr[$i];
                                $raw_product_qty = $raw_product_qtyArr[$i];
                                $raw_product_unit_rate = $raw_product_unit_rateArr[$i];
                                $raw_product_discount = $raw_product_discountArr[$i];
                                $raw_product_gst_type = $raw_product_gst_typeArr[$i];
                                $raw_product_gst_rate = $raw_product_gst_rateArr[$i];
                                $raw_hsn_code = $raw_hsn_codeArr[$i];
                    
                                // $get_raw_hsn = "select * from raw_products where raw_product_id='$raw_product_id'";
                                // $run_raw_hsn = mysqli_query($con,$get_raw_hsn);
                                // $row_raw_hsn = mysqli_fetch_array($run_raw_hsn);
                                // $raw_hsn_code = $row_raw_hsn['raw_product_hsn'];
                    
                    
                                $insert_raw_product = "insert into sale_inc_products (sale_inc_no,
                                                                                    sale_product_type,
                                                                                    sale_product_id,
                                                                                    sale_product_qty,
                                                                                    sale_product_unit_rate,
                                                                                    sale_product_hsn_code,
                                                                                    sale_product_gst_rate,
                                                                                    sale_product_gst_type,
                                                                                    sale_product_discount,
                                                                                    sale_product_created_at,
                                                                                    sale_product_updated_at) 
                                                                                    values 
                                                                                    ('$sale_inc_no',
                                                                                    'raw',
                                                                                    '$raw_product_id',
                                                                                    '$raw_product_qty',
                                                                                    '$raw_product_unit_rate',
                                                                                    '$raw_hsn_code',
                                                                                    '$raw_product_gst_rate',
                                                                                    '$raw_product_gst_type',
                                                                                    '$raw_product_discount',
                                                                                    '$today',
                                                                                    '$today')";
                    
                                $run_raw_product = mysqli_query($con,$insert_raw_product);
                    
                                $update_raw_stock = "update raw_products set raw_product_stock=raw_product_stock-'$raw_product_qty' where raw_product_id='$raw_product_id'";
                                $run_update_raw_stock = mysqli_query($con,$update_raw_stock);
                                
                            }
                        }
                    }
                    if(!empty($custom_product_idArr)){
                        for($i = 0; $i < count($custom_product_idArr); $i++){
                            if(!empty($custom_product_idArr[$i])){
                                $custom_product_id = $custom_product_idArr[$i];
                                $custom_product_qty = $custom_product_qtyArr[$i];
                                $custom_product_unit_rate = $custom_product_unit_rateArr[$i];
                                $custom_product_discount = $custom_product_discountArr[$i];
                                $custom_product_gst_type = $custom_product_gst_typeArr[$i];
                                $custom_product_gst_rate = $custom_product_gst_rateArr[$i];
                                $custom_hsn_code = $custom_hsn_codeArr[$i];
                    
                                $get_custom_hsn = "select * from custom_products where custom_product_id='$custom_product_id'";
                                $run_custom_hsn = mysqli_query($con,$get_custom_hsn);
                                $row_custom_hsn = mysqli_fetch_array($run_custom_hsn);
                                $custom_hsn_code = $row_custom_hsn['custom_product_hsn'];
                    
                    
                                $insert_custom_product = "insert into sale_inc_products (sale_inc_no,
                                                                                    sale_product_type,
                                                                                    sale_product_id,
                                                                                    sale_product_qty,
                                                                                    sale_product_unit_rate,
                                                                                    sale_product_hsn_code,
                                                                                    sale_product_gst_rate,
                                                                                    sale_product_gst_type,
                                                                                    sale_product_discount,
                                                                                    sale_product_created_at,
                                                                                    sale_product_updated_at) 
                                                                                    values 
                                                                                    ('$sale_inc_no',
                                                                                    'custom',
                                                                                    '$custom_product_id',
                                                                                    '$custom_product_qty',
                                                                                    '$custom_product_unit_rate',
                                                                                    '$custom_hsn_code',
                                                                                    '$custom_product_gst_rate',
                                                                                    '$custom_product_gst_type',
                                                                                    '$custom_product_discount',
                                                                                    '$today',
                                                                                    '$today')";
                    
                                $run_custom_product = mysqli_query($con,$insert_custom_product);
                    
                                $update_custom_stock = "update custom_products set custom_product_stock=custom_product_stock-'$custom_product_qty' where custom_product_id='$custom_product_id'";
                                $run_update_custom_stock = mysqli_query($con,$update_custom_stock);
                                
                            }
                        }
                    }

                    if($run_custom_product && $raw_product_idArr){
                        echo "<script>alert('Invoice Entry Successfully Done')</script>";
                    }

                }
    
    
            }else{
                echo "<script>alert('Anyone Of both Product Out Of Stock')</script>";
            }

        }else{
            echo "<script>alert('Select product type first')</script>";
        }
    
    }else{
        echo "<script>alert('Invoice Number Already Used')</script>";
    }
}

?>