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
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <select class="form-select" id="work_product_type" name="work_product_type" required>
                                <option value="" selected disabled>Select the Work type</option>
                                <option value="product_manufac">Product Manufacturing</option>
                                <option value="product_sale_raw">Products for sale raw</option>
                                <option value="product_sale_custom">Products for sale custom</option>
                                <option value="product_sale_both">Products for sale both</option>
                                <option value="product_manufac_sale_raw">Both Manufacturing and Sale Raw Product</option>
                                <option value="product_manufac_sale_custom">Both Manufacturing and Sale Custom Product</option>
                                <option value="product_manufac_sale_both">Both Manufacturing and Sale Both Product</option>
                            </select>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-3 d-none" id="manufac_select">
        <div class="card-body">
            <div class="form-group fieldGroup">
                <h4 class="card-title">Products for Manufacturing</h4>
                <div class="input-group">
                    <select class="form-control" name="manufac_product_id[]" id="manufac_product_id">
                    <option disabled selected value=''>Choose the product</option>
                    <?php 
                    
                    $get_manufac_product = "select * from custom_products";
                    $run_manufac_product = mysqli_query($con,$get_manufac_product);
                    while($row_manufac_product=mysqli_fetch_array($run_manufac_product)){
                        $manufac_product_id = $row_manufac_product['custom_product_id'];
                        $manufac_product_title = $row_manufac_product['custom_product_title'];
                        $manufac_product_unit = $row_manufac_product['custom_product_unit'];
                        $manufac_product_stock = $row_manufac_product['custom_product_stock'];
                        echo "<option value='$manufac_product_id'>$manufac_product_title ($manufac_product_stock $manufac_product_unit Available)</option>";
                    }
                    ?>
                    </select>
                    <label for=""></label>
                    <input type="text" name="manufac_product_qty[]" id="manufac_product_qty" class="form-control" placeholder="Quantity"/>
                    <div class="input-group-addon mx-4 mt-1"> 
                        <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3 d-none" id="raw_select">
        <div class="card-body">
            <div class="form-group fieldGroup1">
                <h4 class="card-title">Raw Products for Sale</h4>
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
                    <input type="text" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Quantity"/>
                    <div class="input-group-addon mx-4 mt-1"> 
                        <a href="javascript:void(0)" class="btn btn-success addMore1"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3 d-none" id="custom_select">
        <div class="card-body">
            <div class="form-group fieldGroup2">
                <h4 class="card-title">Custom Products for Sale</h4>
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
                        echo "<option value='$custom_product_id'>$custom_product_title ($custom_product_stock $custom_product_unit Available)</option>";
                    }
                    ?>
                    </select>
                    <label for=""></label>
                    <input type="text" name="custom_product_qty[]" id="custom_product_qty" class="form-control" placeholder="Quantity"/>
                    <div class="input-group-addon mx-4 mt-1"> 
                        <a href="javascript:void(0)" class="btn btn-success addMore2"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" name="add_work_order" id="add_work_order"  class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>
    
</form>

<!-- copy of  manufacturing products -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
        <select class="form-control" name="manufac_product_id[]" id="manufac_product_id" required>
        <option disabled selected value=''>Choose the product</option>
        <?php 
                    
        $get_manufac_product = "select * from custom_products";
        $run_manufac_product = mysqli_query($con,$get_manufac_product);
        while($row_manufac_product=mysqli_fetch_array($run_manufac_product)){
            $manufac_product_id = $row_manufac_product['custom_product_id'];
            $manufac_product_title = $row_manufac_product['custom_product_title'];
            $manufac_product_unit = $row_manufac_product['custom_product_unit'];
            $manufac_product_stock = $row_manufac_product['custom_product_stock'];
            echo "<option value='$manufac_product_id'>$manufac_product_title ($manufac_product_stock $manufac_product_unit Available)</option>";
        }
        ?>        
        </select>
        <input type="text" name="manufac_product_qty[]" id="manufac_product_qty" class="form-control" placeholder="Quantity" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>

<!-- copy of  raw sale products -->
<div class="form-group fieldGroupCopy1" style="display: none;">
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
        <input type="text" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Quantity" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove1"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>

<!-- copy of  custom sale products -->
<div class="form-group fieldGroupCopy2" style="display: none;">
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
            echo "<option value='$custom_product_id'>$custom_product_title ($custom_product_stock $custom_product_unit Available)</option>";
        }
        ?>
        </select>
        <input type="text" name="custom_product_qty[]" id="custom_product_qty" class="form-control" placeholder="Quantity" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove2"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>


<?php 

if(isset($_POST['add_work_order'])){

    $work_order_note = $_POST['work_order_note'];
    $work_order_date = $_POST['work_order_date'];
    $work_product_type = $_POST['work_product_type'];

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


        if($work_product_type==='product_manufac'){

            $itemArr = $_POST['manufac_product_id'];
            $qtyArr = $_POST['manufac_product_qty'];        

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'manufac',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }
            
        }elseif($work_product_type==='product_sale_raw'){

            $itemArr = $_POST['raw_product_id'];
            $qtyArr = $_POST['raw_product_qty'];        

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'raw',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

        }elseif($work_product_type==='product_sale_custom'){

            $itemArr = $_POST['custom_product_id'];
            $qtyArr = $_POST['custom_product_qty'];        

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }
            
        }elseif($work_product_type==='product_sale_both'){

            $ritemArr = $_POST['raw_product_id'];
            $rqtyArr = $_POST['raw_product_qty'];        

            if(!empty($ritemArr)){
                for($i = 0; $i < count($ritemArr); $i++){
                    if(!empty($ritemArr[$i])){
                        $item = $ritemArr[$i];
                        $qty = $rqtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'raw',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

            $citemArr = $_POST['custom_product_id'];
            $cqtyArr = $_POST['custom_product_qty'];        

            if(!empty($citemArr)){
                for($i = 0; $i < count($citemArr); $i++){
                    if(!empty($citemArr[$i])){
                        $item = $citemArr[$i];
                        $qty = $cqtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }


            
        }elseif($work_product_type==='product_manufac_sale_raw'){

            $itemArr = $_POST['manufac_product_id'];
            $qtyArr = $_POST['manufac_product_qty'];        

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'manufac',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

            $ritemArr = $_POST['raw_product_id'];
            $rqtyArr = $_POST['raw_product_qty'];        

            if(!empty($ritemArr)){
                for($i = 0; $i < count($ritemArr); $i++){
                    if(!empty($ritemArr[$i])){
                        $item = $ritemArr[$i];
                        $qty = $rqtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'raw',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }
            
        }elseif($work_product_type==='product_manufac_sale_custom'){

            $itemArr = $_POST['manufac_product_id'];
            $qtyArr = $_POST['manufac_product_qty'];        

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'manufac',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

            $citemArr = $_POST['custom_product_id'];
            $cqtyArr = $_POST['custom_product_qty'];        

            if(!empty($citemArr)){
                for($i = 0; $i < count($citemArr); $i++){
                    if(!empty($citemArr[$i])){
                        $item = $citemArr[$i];
                        $qty = $cqtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }
            
        }elseif($work_product_type==='product_manufac_sale_both'){

            $itemArr = $_POST['manufac_product_id'];
            $qtyArr = $_POST['manufac_product_qty'];        

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'manufac',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

            $ritemArr = $_POST['raw_product_id'];
            $rqtyArr = $_POST['raw_product_qty'];        

            if(!empty($ritemArr)){
                for($i = 0; $i < count($ritemArr); $i++){
                    if(!empty($ritemArr[$i])){
                        $item = $ritemArr[$i];
                        $qty = $rqtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'raw',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }

            $citemArr = $_POST['custom_product_id'];
            $cqtyArr = $_POST['custom_product_qty'];        

            if(!empty($citemArr)){
                for($i = 0; $i < count($citemArr); $i++){
                    if(!empty($citemArr[$i])){
                        $item = $citemArr[$i];
                        $qty = $cqtyArr[$i];

                        $insert_work_order_task = "insert into work_order_task (work_order_ref_no,
                                                                                work_order_type,
                                                                                work_order_product_type,
                                                                                work_product_id,
                                                                                work_product_qty,
                                                                                work_order_task_created_at,
                                                                                work_order_task_updated_at) 
                                                                                values 
                                                                                ('$work_order_ref_no',
                                                                                'sale',
                                                                                'custom',
                                                                                '$item',
                                                                                '$qty',
                                                                                '$today',
                                                                                '$today')";
                        $run_required = mysqli_query($con,$insert_work_order_task);
                        
                    }
                }
            }
            
        }


            if($run_required){
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

            if($run_insert_task){
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

<script src="jquery/dist/jquery.min.js"></script>
<script src="js/ready_stock.js"></script>
