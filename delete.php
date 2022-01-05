<?php 

include("includes/db.php");
session_start();

if(isset($_GET['work_order_delete'])){

    $work_order_entry_id = $_GET['work_order_delete'];

    $delete_work_order = "update work_order_entry set work_order_status='inactive' where work_order_entry_id='$work_order_entry_id'";
    $run_delete_work_order = mysqli_query($con,$delete_work_order);

    $get_work_ref = "select * from work_order_entry where work_order_entry_id='$work_order_entry_id'";
    $run_work_ref = mysqli_query($con,$get_work_ref);
    $row_work_ref = mysqli_fetch_array($run_work_ref);

    $work_order_ref_no = $row_work_ref['work_order_ref_no'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    if($run_delete_work_order){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Work Order Delete',
                                                         'Work order with reference number $work_order_ref_no is been deleted',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_work_order){
        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?work_orders','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?work_orders','_self')</script>";
    }
}

if(isset($_GET['supplier'])){

    $supplier_id = $_GET['supplier'];

    $delete_supplier = "update suppliers set supplier_status='inactive' where supplier_id='$supplier_id'";
    $run_delete_supplier = mysqli_query($con,$delete_supplier);

    $get_supplier = "select * from suppliers where supplier_id='$supplier_id'";
    $run_supplier = mysqli_query($con,$get_supplier);
    $row_supplier = mysqli_fetch_array($run_supplier);

    $supplier_title = $row_supplier['supplier_title'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    if($run_delete_supplier){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Supplier Delete',
                                                         'Supplier by name $supplier_title has been deleted',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_supplier){
        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?suppliers','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?suppliers','_self')</script>";
    }
}

if(isset($_GET['raw_product'])){

    $raw_product_id = $_GET['raw_product'];

    $delete_raw_products = "update raw_products set raw_product_status='inactive' where raw_product_id='$raw_product_id'";
    $run_delete_raw_products = mysqli_query($con,$delete_raw_products);

    $get_raw_product = "select * from raw_products where raw_product_id='$supplier_id'";
    $run_raw_product = mysqli_query($con,$get_raw_product);
    $row_raw_product = mysqli_fetch_array($run_raw_product);

    $raw_title = $row_raw_product['raw_product_title'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    if($run_delete_raw_products){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Raw Product Delete',
                                                         'Raw product by name $raw_title has been deleted',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_raw_products){
        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?raw_stock','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?raw_stock','_self')</script>";
    }
}

if(isset($_GET['purchase_enquiry'])){

    $purchase_enquiry_id = $_GET['purchase_enquiry'];

    $delete_purchase_enquiry = "update purchase_enquires set purchase_enquiry_delivery_status='cancelled' where purchase_enquiry_id='$purchase_enquiry_id'";
    $run_delete_purchase_enquiry = mysqli_query($con,$delete_purchase_enquiry);

    $get_purchase_enquiry = "select * from purchase_enquires where purchase_enquiry_id='$purchase_enquiry_id'";
    $run_purchase_enquiry = mysqli_query($con,$get_purchase_enquiry);
    $row_purchase_enquiry = mysqli_fetch_array($run_purchase_enquiry);

    $email_subject = $row_purchase_enquiry['email_subject'];
    $supplier_email = $row_purchase_enquiry['supplier_email'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    if($run_delete_purchase_enquiry){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Purchase Enquiry Cancelled',
                                                         'Enquiry subject-$email_subject to $supplier_email is cancelled',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_purchase_enquiry){
        echo "<script>alert('Entry Cancelled')</script>";
        echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
    }else{
        echo "<script>alert('Entry Cancelation Failed')</script>";
        echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
    }
}

if(isset($_GET['purchase_inc'])){

    $purchase_inc_entry_id = $_GET['purchase_inc'];

    $delete_purchase_inc_entry = "update purchase_inc_entries set purchase_inc_status='inactive' where purchase_inc_entry_id='$purchase_inc_entry_id'";
    $run_delete_purchase_inc_entry = mysqli_query($con,$delete_purchase_inc_entry);

    if($run_delete_purchase_inc_entry){

        $get_purchase_inc_no = "select * from purchase_inc_entries where purchase_inc_entry_id='$purchase_inc_entry_id'";
        $run_purchase_inc_no = mysqli_query($con,$get_purchase_inc_no);
        $row_purchase_inc_no = mysqli_fetch_array($run_purchase_inc_no);

        $purchase_inc_no = $row_purchase_inc_no['purchase_inc_no'];

        $get_inc_products = "select * from purchase_inc_products where purchase_inc_no='$purchase_inc_no'";
        $run_inc_products = mysqli_query($con,$get_inc_products);
        while($row_inc_products = mysqli_fetch_array($run_inc_products)){
            $raw_product_id = $row_inc_products['raw_product_id'];
            $purchase_inc_product_qty = $row_inc_products['purchase_inc_product_qty'];
            $update_raw_stock = "update raw_products set raw_product_stock=raw_product_stock-'$purchase_inc_product_qty' where raw_product_id='$raw_product_id'";
            $run_update_raw_stock = mysqli_query($con,$update_raw_stock);
        }
    
        if($run_delete_purchase_inc_entry){
            $staff = $_SESSION['user'];
            date_default_timezone_set('Asia/Kolkata');
            $today = date("Y-m-d H:i:s");
            $insert_task = "insert into work_task_entries (user_id,
                                                            work_task_title,
                                                            work_task_content,
                                                            work_task_entry_created_at,
                                                            work_task_entry_updated_at)
                                                            values 
                                                            ('$staff',
                                                             'Purchase invoice deleted',
                                                             'Purchase Invoice with Invoice number $purchase_inc_no is been deleted',
                                                             '$today',
                                                             '$today')";
            $run_insert_task = mysqli_query($con,$insert_task);
        }
        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?purchase_invoice','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?purchase_invoice','_self')</script>";
    }
}

if(isset($_GET['custom_product'])){

    $custom_product_id = $_GET['custom_product'];

    $delete_custom_product = "update custom_products set custom_product_status='inactive' where custom_product_id='$custom_product_id'";
    $run_delete_custom_product = mysqli_query($con,$delete_custom_product);

    $get_custom_title = "select * from custom_products where custom_product_id='$custom_product_id'";
    $run_custom_title = mysqli_query($con,$get_custom_title);
    $row_custom_title = mysqli_fetch_array($run_custom_title);

    $custom_title = $row_custom_title['custom_product_title'];

    if($run_delete_custom_product){
        $staff = $_SESSION['user'];
        date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d H:i:s");
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Custom Product Deleted',
                                                         'Product by name $custom_title has been deleted',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_custom_product){
        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?custom_products','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?custom_products','_self')</script>";
    }
}

if(isset($_GET['ready_stock'])){

    $ready_stock_id = $_GET['ready_stock'];

    $delete_ready_stock = "update ready_stock set ready_stock_status='inactive' where ready_stock_id='$ready_stock_id'";
    $run_delete_ready_stock = mysqli_query($con,$delete_ready_stock);

    if($run_delete_ready_stock){

        $get_custom_product_id = "select * from ready_stock where ready_stock_id='$ready_stock_id'";
        $run_custom_product_id = mysqli_query($con,$get_custom_product_id);
        $row_custom_product_id = mysqli_fetch_array($run_custom_product_id);

        $custom_product_id = $row_custom_product_id['product_id'];
        $product_qty = $row_custom_product_id['product_qty'];

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

            $update_stock = "update raw_products set raw_product_stock=raw_product_stock+'$reduce_stock' where raw_product_id='$raw_product_id'";
            $run_update_stock = mysqli_query($con,$update_stock);

        }
            $staff = $_SESSION['user'];

            date_default_timezone_set('Asia/Kolkata');
            $today = date("Y-m-d H:i:s");
            $insert_task = "insert into work_task_entries (user_id,
                                                            work_task_title,
                                                            work_task_content,
                                                            work_task_entry_created_at,
                                                            work_task_entry_updated_at)
                                                            values 
                                                            ('$staff',
                                                             'Ready Stock Entry Deleted',
                                                             'Ready stock entry for product $custom_product_title is been deleted',
                                                             '$today',
                                                             '$today')";
            $run_insert_task = mysqli_query($con,$insert_task);

        $update_custom_stock = "update custom_products set custom_product_stock=custom_product_stock-'$product_qty' where custom_product_id='$custom_product_id'";
        $run_update_custom_stock = mysqli_query($con,$update_custom_stock);

        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?ready_stock','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?ready_stock','_self')</script>";
    }
}

if(isset($_GET['customer'])){

    $customer_id = $_GET['customer'];

    $delete_customer = "update customers set customer_status='inactive' where customer_id='$customer_id'";
    $run_delete_customer = mysqli_query($con,$delete_customer);

    $get_customer = "select * from customers where customer_id='$customer_id'";
    $run_customer = mysqli_query($con,$get_customer);
    $row_customer = mysqli_fetch_array($run_customer);

    $customer_title = $row_customer['customer_title'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    if($run_delete_customer){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Customer Deleted',
                                                         'Customer by name $customer_title has been deleted',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_customer){
        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?customers','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?customers','_self')</script>";
    }
}

if(isset($_GET['sales_invoice'])){

    $sale_inc_entry_id = $_GET['sales_invoice'];

    $delete_sales_inc_entry = "update sale_inc_entries set sale_inc_status='inactive' where sale_inc_entry_id='$sale_inc_entry_id'";
    $run_delete_sales_inc_entry = mysqli_query($con,$delete_sales_inc_entry);

    if($run_delete_sales_inc_entry){

        $get_sale_inc_no = "select * from sale_inc_entries where sale_inc_entry_id='$sale_inc_entry_id'";
        $run_sale_inc_no = mysqli_query($con,$get_sale_inc_no);
        $row_sale_inc_no = mysqli_fetch_array($run_sale_inc_no);

        $sale_inc_no = $row_sale_inc_no['sale_inc_no'];

        $get_sale_products = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
        $run_sale_products = mysqli_query($con,$get_sale_products);
        while($row_sale_products=mysqli_fetch_array($run_sale_products)){

            $sale_product_type = $row_sale_products['sale_product_type'];
            $sale_product_id = $row_sale_products['sale_product_id'];
            $sale_product_qty = $row_sale_products['sale_product_qty'];

            if($sale_product_type==='raw'){
                $update_raw_stock = "update raw_products set raw_product_stock=raw_product_stock+'$sale_product_qty' where raw_product_id='$sale_product_id'";
                $run_update_raw_stock = mysqli_query($con,$update_raw_stock);
            }elseif($sale_product_type==='custom'){
                $update_custom_stock = "update custom_products set custom_product_stock=custom_product_stock+'$sale_product_qty' where custom_product_id='$sale_product_id'";
                $run_update_custom_stock = mysqli_query($con,$update_custom_stock);
            }

        }
            $staff = $_SESSION['user'];
            date_default_timezone_set('Asia/Kolkata');
            $today = date("Y-m-d H:i:s");
            $insert_task = "insert into work_task_entries (user_id,
                                                            work_task_title,
                                                            work_task_content,
                                                            work_task_entry_created_at,
                                                            work_task_entry_updated_at)
                                                            values 
                                                            ('$staff',
                                                             'Sale invoice deleted',
                                                             'Sale Invoice with Invoice number $sale_inc_no is been deleted',
                                                             '$today',
                                                             '$today')";
            $run_insert_task = mysqli_query($con,$insert_task);

        echo "<script>alert('Entry Deleted')</script>";
        echo "<script>window.open('index.php?sales_invoices','_self')</script>";
    }else{
        echo "<script>alert('Entry Deletion Failed')</script>";
        echo "<script>window.open('index.php?sales_invoices','_self')</script>";
    }
}

?>