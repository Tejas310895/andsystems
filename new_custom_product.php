<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Custom Product</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?custom_products" class="btn btn-primary" style="float:right;">Custom Products</a>
    </div>
</div>
<form id="generate_custom_product" method="post" action="">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Product SKU</label>
                <?php
                                        
                $get_last_id = "select * from custom_products order by custom_product_id desc limit 1";
                $run_last_id = mysqli_query($con,$get_last_id);
                $row_last_id = mysqli_fetch_array($run_last_id);

                $last_id = $row_last_id['custom_product_id'];

                $num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
                $item_sku = $num.($last_id+1);
                
                ?>
                <input type="text" class="form-control" name="custom_product_sku" id="custom_product_sku" value="<?php echo "$item_sku";?>" aria-describedby="" required readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Product Title</label>
                <input type="text" class="form-control" name="custom_product_title" id="custom_product_title" aria-describedby="" placeholder="Enter Product title" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Product Unit</label>
                <input type="text" class="form-control" name="custom_product_unit" id="custom_product_unit" aria-describedby="" placeholder="Enter Product Unit" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Product Sub Unit</label>
                <input type="text" class="form-control" name="custom_product_subunit" id="custom_product_subunit" aria-describedby="" placeholder="Enter Product Sub Unit">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Product HSN</label>
                <input type="text" class="form-control" name="custom_product_hsn" id="custom_product_hsn" aria-describedby="" placeholder="Enter HSN CODE" required>
            </div>
        </div>
    </div>
    <h5 class="text-uppercase">Raw Products required to build new product</h5>
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
            <input type="number" name="raw_product_required_qty[]" id="raw_product_required_qty" class="form-control" placeholder="Enter Qty" required/>
            <div class="input-group-addon mx-3 mt-1">
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="add_custom_product" id="add_custom_product"  class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>
    
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
            <input type="number" name="raw_product_required_qty[]" id="raw_product_required_qty" class="form-control" placeholder="Enter Qty" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/supplier.js"></script>
<?php 

if(isset($_POST['add_custom_product'])){

    $custom_product_sku = $_POST['custom_product_sku'];
    $custom_product_title = $_POST['custom_product_title'];
    $custom_product_unit = $_POST['custom_product_unit'];
    $custom_product_subunit = $_POST['custom_product_subunit'];
    $custom_product_hsn = $_POST['custom_product_hsn'];
    $itemArr = $_POST['raw_product_id'];
    $qtyArr = $_POST['raw_product_required_qty'];



    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_check_pro = "select * from custom_products where custom_product_sku='$custom_product_sku'";
    $run_check_pro = mysqli_query($con,$get_check_pro);
    $count_pro = mysqli_num_rows($run_check_pro);

    if($count_pro<1){

        $insert_custom_product = "INSERT into custom_products (custom_product_title,
                                                                custom_product_sku,
                                                                custom_product_unit,
                                                                custom_product_subunit,
                                                                custom_product_hsn,
                                                                custom_product_status,
                                                                custom_product_created_at,
                                                                custom_product_updated_at) 
                                                                values 
                                                                ('$custom_product_title',
                                                                '$custom_product_sku',
                                                                '$custom_product_unit',
                                                                '$custom_product_subunit',
                                                                '$custom_product_hsn',
                                                                'active',
                                                                '$today',
                                                                '$today')";
        $run_insert_custom_product = mysqli_query($con,$insert_custom_product);

        if($run_insert_custom_product){
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$user_id',
                                                        'Custom Products Insert',
                                                        'New Custom product by name $custom_product_title has been added to the catlog',
                                                        '$today',
                                                        '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
        }


        if($run_insert_custom_product){
            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_product_required = "insert into custom_product_requirements (custom_product_sku,
                                                                                                raw_product_id,
                                                                                                raw_product_required_qty,
                                                                                                product_requirement_created_at,
                                                                                                product_requirement_updated_at) 
                                                                                                values 
                                                                                                ('$custom_product_sku',
                                                                                                '$item',
                                                                                                '$qty',
                                                                                                '$today',
                                                                                                '$today')";

                        $run_insert_product_required = mysqli_query($con,$insert_product_required);
                        
                    }
                }
            }

        }else {
            echo "<script>alert('Failed, Try again')</script>";
        }

            if($run_insert_custom_product){
                echo "<script>alert('Done')</script>";
                echo "<script>window.open('index.php?purchase_invoice','_self')</script>";
            }else{
                echo "<script>alert('Failed, Try again')</script>";
            }

    }else{
        echo "<script>alert('Dublicate SKU ID, Please try again')</script>";
    }
}

?>
