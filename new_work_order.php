<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Work Order Entry</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?work_orders" class="btn btn-primary" style="float:right;">Work Order Entries</a>
    </div>
</div>
<form id="insert_work_order" method="post" action="">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label><h5>Work Order Note</h5></label>
                <input type="text" class="form-control" name="work_order_note" aria-describedby="" placeholder="Enter Note for the staff" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label><h5>Work Order Date</h5></label>
                <input type="date" class="form-control" name="work_order_date" aria-describedby="" required>
            </div>
        </div>
    </div>
    <h5 class="text-uppercase">Products to be manufactured</h5>
    <div class="form-group fieldGroup">
        <div class="input-group">
            <select class="form-control mx-5" id="exampleFormControlSelect1" name="custom_product_id[]" id="custom_product_id" required>
                <option selected disabled value="">Choose the product</option>
                <?php 
                
                $get_custom_product = "select * from custom_products";
                $run_custom_product = mysqli_query($con,$get_custom_product);
                while($row_custom_product=mysqli_fetch_array($run_custom_product)){

                    $custom_product_id = $row_custom_product['custom_product_id'];
                    $custom_product_title = $row_custom_product['custom_product_title'];

                    echo "<option value='$custom_product_id'>$custom_product_title</option>";
                }
                
                ?>
            </select>
            <input type="number" name="custom_product_qty[]" id="custom_product_qty" class="form-control" placeholder="Enter Qty required per item" required/>
            <div class="input-group-addon mx-3 mt-1">
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="add_work_order" id="add_work_order"  class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>
    
</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
            <select class="form-control mx-5" id="exampleFormControlSelect1" name="custom_product_id[]" id="custom_product_id" required>
                <option selected disabled value="">Choose the product</option>
                    <?php 
                    
                    $get_custom_product = "select * from custom_products";
                    $run_custom_product = mysqli_query($con,$get_custom_product);
                    while($row_custom_product=mysqli_fetch_array($run_custom_product)){

                        $custom_product_id = $row_custom_product['custom_product_id'];
                        $custom_product_title = $row_custom_product['custom_product_title'];

                        echo "<option value='$custom_product_id'>$custom_product_title</option>";
                    }
                    
                    ?>
            </select>
        <input type="number" name="custom_product_qty[]" id="custom_product_qty" class="form-control" placeholder="Enter Qty required per item" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>

<?php 

if(isset($_POST['add_work_order'])){

    $work_order_note = $_POST['work_order_note'];
    $work_order_date = $_POST['work_order_date'];
    $itemArr = $_POST['custom_product_id'];
    $qtyArr = $_POST['custom_product_qty'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_last_id = "SELECT * from work_order_entry order by work_order_entry_id desc limit 1";
    $run_last_id = mysqli_query($con,$get_last_id);
    $row_last_id = mysqli_fetch_array($run_last_id);

    $last_id = $row_last_id['work_order_entry_id'];

    $ref_no = rand();

    $work_order_ref_no = $ref_no.$last_id; 

    $get_check_ref = "select * from work_order_entry where work_order_ref_no='$work_order_ref_no'";
    $run_check_ref = mysqli_query($con,$get_check_ref);
    $count_ref = mysqli_num_rows($run_check_ref);

    if($count_ref<1){

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                custom_product_id,
                                                                                custom_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

            $insert_work_order = "INSERT into work_order_entry (work_order_ref_no,
                                                                work_order_status,
                                                                work_order_date,
                                                                work_order_note,
                                                                work_order_created_at,
                                                                work_order_updated_at) 
                                                                values 
                                                                ('$work_order_ref_no',
                                                                'active',
                                                                '$work_order_date',
                                                                '$work_order_note',
                                                                '$today',
                                                                '$today')";
            $run_work_order = mysqli_query($con,$insert_work_order);

            if($run_work_order){
                $insert_task = "insert into work_task_entries (user_id,
                                                                work_task_title,
                                                                work_task_content,
                                                                work_task_entry_created_at,
                                                                work_task_entry_updated_at)
                                                                values 
                                                                ('$user_id',
                                                                'Work order created',
                                                                'Work order for products is been created with reference id-$work_order_ref_no',
                                                                '$today',
                                                                '$today')";
                $run_insert_task = mysqli_query($con,$insert_task);
            }

            if($run_work_order){
                echo "<script>alert('Done')</script>";
                echo "<script>window.open('index.php?work_orders','_self')</script>";
            }else{
                echo "<script>alert('Failed, Try again')</script>";
            }

    }else{
        echo "<script>alert('Same Ref No., Please try again')</script>";
    }
}


?>
