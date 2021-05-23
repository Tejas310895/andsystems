<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>Ready Stock Manufacturing</h3>
    </div>
    <div class="col-md-2">
        <a href="index.php?ready_stock" class="btn btn-primary" style="float:right;">Ready Stocks</a>
    </div>
</div>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title">Multiple Column</h4> -->
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="new_ready_stock" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Product</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="custom_product_id" name="custom_product_id" required>
                                            <option disabled selected value="">Choose the Trade</option>
                                            <?php 
                                            
                                            $get_products = "select * from custom_products where custom_product_status='active'";
                                            $run_products = mysqli_query($con,$get_products);
                                            while($row_products = mysqli_fetch_array($run_products)){
                                            ?>
                                            <option value="<?php echo $row_products['custom_product_id']; ?>"><?php echo $row_products['custom_product_title']; ?> in <?php echo $row_products['custom_product_unit']; ?><?php if(strlen(($row_products['custom_product_subunit'])>0)){echo"(".$row_products['custom_product_subunit'].")";};?></option>
                                            <?php } ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Product Quantity</label>
                                        <input type="text" id="ready_stock_product_qty" class="form-control" placeholder="Enter product quantity"
                                            name="product_qty" required>
                                            <small class="d-none" id="stock_alert"><h6 class="text-danger">No raw stock available to manufacture your requested quantity</h6></small>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="ready_stock_insert" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/ready_stock.js"></script>
<?php 

if(isset($_POST['ready_stock_insert'])){

    $custom_product_id = $_POST['custom_product_id'];
    $product_qty = $_POST['product_qty'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_last_id = "select * from ready_stock order by ready_stock_id desc limit 1";
    $run_last_id = mysqli_query($con,$get_last_id);
    $row_last_id = mysqli_fetch_array($run_last_id);

    $ready_stock_id = $row_last_id['ready_stock_id'];

    $print_id = $ready_stock_id+1;

    $get_product_sku = "select * from custom_products where custom_product_id='$custom_product_id'";
    $run_product_sku = mysqli_query($con,$get_product_sku);
    $row_product_sku = mysqli_fetch_array($run_product_sku);

    $product_sku = $row_product_sku['custom_product_sku'];
    $stock_available = 0;
    $get_raw_required = "select * from custom_product_requirements where custom_product_sku='$product_sku'";
    $run_raw_required = mysqli_query($con,$get_raw_required);
    while($row_raw_required=mysqli_fetch_array($run_raw_required)){

        $raw_product_id = $row_raw_required['raw_product_id'];
        $raw_product_required_qty = $row_raw_required['raw_product_required_qty'];

        $required_qty = $product_qty*$raw_product_required_qty;

        $get_raw_stock = "select * from raw_products where raw_product_id='$raw_product_id'";
        $run_raw_stock = mysqli_query($con,$get_raw_stock);
        $row_raw_stock = mysqli_fetch_array($run_raw_stock);

        $raw_product_stock = $row_raw_stock['raw_product_stock'];

        if($required_qty<=$raw_product_stock){
            $check_stock = 0;
        }else {
            $check_stock = 1;
        }

        $stock_available += $check_stock;
    }

    if($stock_available<=0){

    $insert_product = "insert into ready_stock (print_id,
                                                product_id,
                                                product_qty,
                                                ready_stock_status,
                                                ready_stock_created_at,
                                                ready_stock_updated_at)
                                                Values 
                                                ('$print_id',
                                                '$custom_product_id',
                                                '$product_qty',
                                                'active',
                                                '$today',
                                                '$today')";
    $run_insert_product = mysqli_query($con,$insert_product);

    if($insert_product){

        $get_custom_product_sku = "select * from custom_products where custom_product_id='$custom_product_id'";
        $run_custom_product_sku = mysqli_query($con,$get_custom_product_sku);
        $row_custom_product_sku = mysqli_fetch_array($run_custom_product_sku);

        $custom_product_sku = $row_custom_product_sku['custom_product_sku'];
        $custom_product_title = $row_custom_product_sku['custom_product_title'];

        $get_raw_product_id = "select * from custom_product_requirements where custom_product_sku='$custom_product_sku'";
        $run_raw_product_id =  mysqli_query($con,$get_raw_product_id);
        while($row_raw_product_id=mysqli_fetch_array($run_raw_product_id)){
            $raw_product_id = $row_raw_product_id['raw_product_id'];
            $raw_product_required_qty = $row_raw_product_id['raw_product_required_qty'];

            $reduce_stock = $raw_product_required_qty*$product_qty;

            $update_stock = "update raw_products set raw_product_stock=raw_product_stock-'$reduce_stock' where raw_product_id='$raw_product_id'";
            $run_update_stock = mysqli_query($con,$update_stock);

        }

        $update_custom_stock = "update custom_products set custom_product_stock=custom_product_stock+'$product_qty' where custom_product_id='$custom_product_id'";
        $run_update_custom_stock = mysqli_query($con,$update_custom_stock);

            $insert_task = "insert into work_task_entries (user_id,
                                                            work_task_title,
                                                            work_task_content,
                                                            work_task_entry_created_at,
                                                            work_task_entry_updated_at)
                                                            values 
                                                            ('$user_id',
                                                            'Ready Stock Entry done',
                                                            'New ready stock entry is been done for the product $custom_product_title',
                                                            '$today',
                                                            '$today')";
            $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_insert_product){
        echo "<script>alert('Done')</script>";
        echo "<script>window.open('index.php?ready_stock','_self')</script>";
    }else{
        echo "<script>alert('Failed, Try again')</script>";
    }

    }else {
        echo "<script>alert('Raw Stock Unavailable')</script>";
    }
}

?>