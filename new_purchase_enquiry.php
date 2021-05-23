<div class="row">
    <div class="page-title col-md-10">
        <h3>New Purchase Enquiry</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?purchase_enquiry" class="btn btn-primary" style="float:right;">Purchase Enquires</a>
    </div>
</div>
<form id="insert_raw_product" method="post" action="">
    <div class="row">
        <div class="col-md-4">
            <h6>Supplier</h6>
            <fieldset class="form-group">
                <select class="form-select" id="enquiry_supplier_id" name="enquiry_supplier_id" required>
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
        <div class="col-4">
            <div class="form-group">
                <label>Supplier Email</label>
                <input type="email" class="form-control" name="supplier_email" id="supplier_email" aria-describedby="" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Delivery Schedule</label>
                <input type="date" class="form-control" name="del_date" id="del_date" aria-describedby="" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Email Subject</label>
                <input type="text" class="form-control" name="email_subject" id="email_subject" aria-describedby="" placeholder="Enter Email Subject" required>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Email Content</label>
                <textarea class="form-control" id="snow" name="email_content" placeholder="Enter Email Note"
                    rows="3"></textarea>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Email Note</label>
                <textarea class="form-control" id="snow1" name="email_note" placeholder="Enter Email Note"
                    rows="3"></textarea>
            </div>
        </div>
    </div>
    <h5 class="text-uppercase">Products to be Requested</h5>
    <div class="form-group fieldGroup">
        <div class="input-group">
            <select class="form-control mx-5" id="raw_product_enquiry" name="raw_product_id[]" required>
                <option selected disabled value="">Choose the product</option>
                <?php 
                
                $get_raw_products = "select * from raw_products";
                $run_raw_products = mysqli_query($con,$get_raw_products);
                while($row_raw_products=mysqli_fetch_array($run_raw_products)){

                    $raw_products_id = $row_raw_products['raw_product_id'];
                    $raw_products_title = $row_raw_products['raw_product_title'];
                    $raw_products_unit = $row_raw_products['raw_product_unit'];

                    $get_enquires = "select * from purchase_enquires where purchase_enquiry_delivery_status='intiated'";
                    $run_enquires = mysqli_query($con,$get_enquires);
                    $comment = 0;
                    while($row_enquires = mysqli_fetch_array($run_enquires)){
                    $unserialized_array = unserialize($row_enquires['raw_product_array']);
                        $array_size = (count($unserialized_array)-1);
                        for($i=0; $i<=$array_size; $i++){

                            $item_id = $unserialized_array[$i][0];

                            if($raw_products_id==$item_id){
                                $comment += 1;
                            }else {
                                $comment += 0;
                            }
                        }
                    }

                        if($comment>0){
                            echo "<option class='text-danger' value='$raw_products_id'>$raw_products_title in $raw_products_unit (Already enquiry placed for this item)</option>";
                        }else {
                            echo "<option value='$raw_products_id'>$raw_products_title in $raw_products_unit </option>";
                        }
        }
                
                ?>
            </select>
            <input type="number" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Enter Qty required" required/>
            <div class="input-group-addon mx-3 mt-1">
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="add_raw_enquiry" id="add_raw_enquiry"  class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>
    
</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
            <select class="form-control mx-5" id="raw_product_enquiry" name="raw_product_id[]" required>
                <option selected disabled value="">Choose the product</option>
                    <?php 
                    
                    $get_raw_products = "select * from raw_products";
                    $run_raw_products = mysqli_query($con,$get_raw_products);
                    while($row_raw_products=mysqli_fetch_array($run_raw_products)){
    
                        $raw_products_id = $row_raw_products['raw_product_id'];
                        $raw_products_title = $row_raw_products['raw_product_title'];
                        $raw_products_unit = $row_raw_products['raw_product_unit'];

                        $get_enquires = "select * from purchase_enquires where purchase_enquiry_delivery_status='intiated'";
                        $run_enquires = mysqli_query($con,$get_enquires);
                        $comment = 0;
                        while($row_enquires = mysqli_fetch_array($run_enquires)){
                        $unserialized_array = unserialize($row_enquires['raw_product_array']);
                            $array_size = (count($unserialized_array)-1);
                            for($i=0; $i<=$array_size; $i++){

                                $item_id = $unserialized_array[$i][0];

                                if($raw_products_id==$item_id){
                                    $comment += 1;
                                }else {
                                    $comment += 0;
                                }
                            }
                        }

                            if($comment>0){
                                echo "<option class='text-danger' value='$raw_products_id'>$raw_products_title in $raw_products_unit (Already enquiry placed for this item)</option>";
                            }else {
                                echo "<option value='$raw_products_id'>$raw_products_title in $raw_products_unit </option>";
                            }
    
                    }
                        
                    ?>
            </select>
        <input type="number" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Enter Qty required" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/supplier.js"></script>
<?php 

//purchase enquiry insert query

if(isset($_POST['add_raw_enquiry'])){

    $enquiry_supplier_id = $_POST['enquiry_supplier_id'];
    $supplier_email = $_POST['supplier_email'];
    $del_date = $_POST['del_date'];
    $email_subject = $_POST['email_subject'];
    $email_content = $_POST['email_content'];
    $email_note = $_POST['email_note'];
    $itemArr = $_POST['raw_product_id'];
    $qtyArr = $_POST['raw_product_qty'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $purchase_enquiry_created_at = date('M d, Y',strtotime($today));

            $enquiry_product = array();
            if(!empty($itemArr)){
                    for($i = 0; $i < count($itemArr); $i++){
                        if(!empty($itemArr[$i])){
                            $item = $itemArr[$i];
                            $qty = $qtyArr[$i];
                            
                            $raw_array = array($item,$qty);
                            array_push($enquiry_product,$raw_array);

                        }
                    }
            }

        $serialized_array = serialize($enquiry_product); 

            $insert_purchase_enquiry = "INSERT into purchase_enquires (email_subject,
                                                                        email_content,
                                                                        email_note,
                                                                        supplier_id,
                                                                        raw_product_array,
                                                                        supplier_email,
                                                                        purchase_enquiry_schedule,
                                                                        purchase_enquiry_delivery_status,
                                                                        purchase_enquiry_created_at,
                                                                        purchse_enquiry_updated_at) 
                                                                        values 
                                                                        ('$email_subject',
                                                                         '$email_content',
                                                                         '$email_note',
                                                                         '$enquiry_supplier_id',
                                                                         '$serialized_array',
                                                                         '$supplier_email',
                                                                         '$del_date',
                                                                         'intiated',
                                                                         '$today',
                                                                         '$today')";
            $run_purchase_enquiry = mysqli_query($con,$insert_purchase_enquiry);

            if($run_purchase_enquiry){
                $insert_task = "insert into work_task_entries (user_id,
                                                                work_task_title,
                                                                work_task_content,
                                                                work_task_entry_created_at,
                                                                work_task_entry_updated_at)
                                                                values 
                                                                ('$user_id',
                                                                'Purchase enquiry placed',
                                                                'New purchase enquiry is been placed with subject-$email_subject and mail set to $supplier_email',
                                                                '$today',
                                                                '$today')";
                $run_insert_task = mysqli_query($con,$insert_task);
                }
        

            if($run_purchase_enquiry){
                include('direct_enquiry_mail.php');
                echo "<script>alert('Entry Done and mail sent')</script>";
                echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
            }else{
                echo "<script>alert('Failed, Try again')</script>";
            }

    }



?>