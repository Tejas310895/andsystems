<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Purchase Invoice Entry</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?purchase_invoice" class="btn btn-primary" style="float:right;">Purchase Invoice Entries</a>
    </div>
</div>
<form id="insert_purchase_invoice" method="post" action="">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Purchase Invoice No.</label>
                <input type="text" class="form-control" name="purchase_inc_no" id="purchase_inc_no" aria-describedby="" placeholder="Enter Purchase Invoice No." required>
                <small class="d-none" id="dublicate_purchase_inc"><h6 class="text-danger">Same invoice is already inserted</h6></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Purchase Invoice Date</label>
                <input type="date" class="form-control" name="purchase_inc_date" aria-describedby="" required>
            </div>
        </div>
        <div class="col-md-4">
            <label>Supplier</label>
            <fieldset class="form-group">
                <select class="form-select" id="supplier_id" name="supplier_id" required>
                    <option disabled selected>Choose the Supplier</option>
                    <?php
                    
                        $get_supplier = "select * from suppliers";
                        $run_supplier = mysqli_query($con,$get_supplier);
                        while($row_supplier=mysqli_fetch_array($run_supplier)){
                            echo "<option class='text-uppercase' value='".$row_supplier['supplier_id']."'>".$row_supplier['supplier_title']."</option>";
                        }

                    ?>
                </select>
            </fieldset>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Total Custom Duty with tax</label>
                <input type="number" class="form-control" name="purchase_inc_custom_duty" aria-describedby="" placeholder="Total Custom Duty Applied on Invoice with tax">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Any Extra Charges Paid</label>
                <input type="number" class="form-control" name="transport_charges" aria-describedby="" placeholder="Enter Extra Charges Paid">
            </div>
        </div>
    </div>
    <h5 class="text-uppercase">Enter Product Details Below</h5>
    <div class="form-group fieldGroup">
        <div class="input-group">
            <select class="form-control" id="exampleFormControlSelect1" name="raw_product_id[]" id="raw_product_id" required>
                <option selected disabled value="">Choose the product</option>
                <?php 
                
                $get_raw_product = "select * from raw_products where raw_product_status='active'";
                $run_raw_product = mysqli_query($con,$get_raw_product);
                while($row_raw_product=mysqli_fetch_array($run_raw_product)){

                    $raw_product_id = $row_raw_product['raw_product_id'];
                    $raw_product_title = $row_raw_product['raw_product_title'];
                    $raw_product_unit = $row_raw_product['raw_product_unit'];

                    echo "<option value='$raw_product_id'>$raw_product_title (in $raw_product_unit)</option>";
                }
                
                ?>
            </select>
            <input type="number" name="purchase_inc_product_qty[]" id="purchase_inc_product_qty" class="form-control" placeholder="Enter Qty" required/>
            <input type="number" name="purchase_inc_product_hsn_code[]" id="purchase_inc_product_hsn_code" class="form-control" placeholder="Enter HSN CODE" required/>
            <input type="number" name="purchase_inc_product_unit_rate[]" id="purchase_inc_product_unit_rate" class="form-control" placeholder="Enter Unit Rate" required/>
            <select class="form-control" id="exampleFormControlSelect1" name="purchase_inc_product_gst_type[]" id="purchase_inc_product_gst_type" required>
                <option selected disabled value="">Choose the GST type</option>
                <option value="STA_TAX">State Tax</option>
                <option value="CEN_TAX">Center Tax</option>
            </select>
            <input type="number" name="purchase_inc_product_gst_rate[]" id="purchase_inc_product_gst_rate" class="form-control" placeholder="Enter GST Rate" required/>
            <div class="input-group-addon mx-3 mt-1">
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="add_purchase_product" id="add_purchase_product"  class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>
    
</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
            <select class="form-control" id="exampleFormControlSelect1" name="raw_product_id[]" id="raw_product_id" required>
                <option selected disabled value="">Choose the product</option>
                    <?php 
                    
                    $get_raw_product = "select * from raw_products where raw_product_status='active'";
                    $run_raw_product = mysqli_query($con,$get_raw_product);
                    while($row_raw_product=mysqli_fetch_array($run_raw_product)){
    
                        $raw_product_id = $row_raw_product['raw_product_id'];
                        $raw_product_title = $row_raw_product['raw_product_title'];    
                        $raw_product_unit = $row_raw_product['raw_product_unit'];

                        echo "<option value='$raw_product_id'>$raw_product_title (in $raw_product_unit)</option>";
                        }
                        
                    ?>
            </select>
            <input type="number" name="purchase_inc_product_qty[]" id="purchase_inc_product_qty" class="form-control" placeholder="Enter Qty" required/>
            <input type="number" name="purchase_inc_product_hsn_code[]" id="purchase_inc_product_hsn_code" class="form-control" placeholder="Enter HSN CODE" required/>
            <input type="number" name="purchase_inc_product_unit_rate[]" id="purchase_inc_product_unit_rate" class="form-control" placeholder="Enter Unit Rate" required/>
            <select class="form-control" id="exampleFormControlSelect1" name="purchase_inc_product_gst_type[]" id="purchase_inc_product_gst_type" required>
                <option selected disabled value="">Choose the GST type</option>
                <option value="STA_TAX">State Tax</option>
                <option value="CEN_TAX">Center Tax</option>
            </select>
            <input type="number" name="purchase_inc_product_gst_rate[]" id="purchase_inc_product_gst_rate" class="form-control" placeholder="Enter GST Rate" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/supplier.js"></script>
<?php 

if(isset($_POST['add_purchase_product'])){

    $purchase_inc_no = $_POST['purchase_inc_no'];
    $purchase_inc_date = $_POST['purchase_inc_date'];
    $supplier_id = $_POST['supplier_id'];
    $purchase_inc_custom_duty = $_POST['purchase_inc_custom_duty'];
    $transport_charges = $_POST['transport_charges'];
    $itemArr = $_POST['raw_product_id'];
    $qtyArr = $_POST['purchase_inc_product_qty'];
    $hsnArr = $_POST['purchase_inc_product_hsn_code'];
    $unit_rateArr = $_POST['purchase_inc_product_unit_rate'];
    $gst_typeArr = $_POST['purchase_inc_product_gst_type'];
    $gst_rateArr = $_POST['purchase_inc_product_gst_rate'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_check_inc = "select * from purchase_inc_entries where purchase_inc_no='$purchase_inc_no' and purchase_inc_status='active'";
    $run_check_inc = mysqli_query($con,$get_check_inc);
    $count_inc = mysqli_num_rows($run_check_inc);

    if($count_inc<1){

        $insert_purchase_entries = "INSERT into purchase_inc_entries (purchase_inc_no,
                                                                        purchase_inc_date,
                                                                        supplier_id,
                                                                        purchase_inc_custom_duty,
                                                                        transport_charges,
                                                                        purchase_inc_status,
                                                                        purchase_inc_created_at,
                                                                        purchase_inc_updated_at) 
                                                                        values 
                                                                        ('$purchase_inc_no',
                                                                        '$purchase_inc_date',
                                                                        '$supplier_id',
                                                                        '$purchase_inc_custom_duty',
                                                                        '$transport_charges',
                                                                        'active',
                                                                        '$today',
                                                                        '$today')";
        $run_insert_purchase_entries = mysqli_query($con,$insert_purchase_entries);

        if($run_insert_purchase_entries){
            $insert_task = "insert into work_task_entries (user_id,
                                                            work_task_title,
                                                            work_task_content,
                                                            work_task_entry_created_at,
                                                            work_task_entry_updated_at)
                                                            values 
                                                            ('$user_id',
                                                            'New purchase invoice entry done',
                                                            'New purchase invoice is been insert to the system with invoice number $purchase_inc_no',
                                                            '$today',
                                                            '$today')";
            $run_insert_task = mysqli_query($con,$insert_task);
            }

        if($run_insert_purchase_entries){
            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];
                        $hsn = $hsnArr[$i];
                        $unit_rate = $unit_rateArr[$i];
                        $gst_type = $gst_typeArr[$i];
                        $gst_rate = $gst_rateArr[$i];

                        $insert_purchase_products = "insert into purchase_inc_products (purchase_inc_no,
                                                                                        raw_product_id,
                                                                                        purchase_inc_product_hsn_code,
                                                                                        purchase_inc_product_unit_rate,
                                                                                        purchase_inc_product_qty,
                                                                                        purchase_inc_product_gst_type,
                                                                                        purchase_inc_product_gst_rate,
                                                                                        purchase_inc_product_created_at,
                                                                                        purchase_inc_product_updated_at) 
                                                                                        values 
                                                                                        ('$purchase_inc_no',
                                                                                        '$item',
                                                                                        '$hsn',
                                                                                        '$unit_rate',
                                                                                        '$qty',
                                                                                        '$gst_type',
                                                                                        '$gst_rate',
                                                                                        '$today',
                                                                                        '$today')";

                        $run_insert_purchase_products = mysqli_query($con,$insert_purchase_products);

                        $update_raw_stock = "update raw_products set raw_product_stock=raw_product_stock+'$qty' where raw_product_id='$item'";
                        $run_update_raw_stock = mysqli_query($con,$update_raw_stock);
                        
                    }
                }
            }

        }else {
            echo "<script>alert('Failed, Try again')</script>";
        }

            if($run_insert_purchase_entries){
                echo "<script>alert('Done')</script>";
                echo "<script>window.open('index.php?purchase_invoice','_self')</script>";
            }else{
                echo "<script>alert('Failed, Try again')</script>";
            }

    }else{
        echo "<script>alert('Dublicate Inc.no, Please try again')</script>";
    }
}

?>
