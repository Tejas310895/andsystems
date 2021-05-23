<?php 

include("../includes/db.php");

//supplier insert query
session_start();

if(isset($_POST['supplier_insert'])){


    parse_str($_POST['data'], $_POST);
    
    $supplier_title = $_POST['supplier_title'];
    $supplier_email = $_POST['supplier_email'];
    $supplier_contact = $_POST['supplier_contact'];
    $supplier_gstn = $_POST['supplier_gstn'];
    $supplier_pan = $_POST['supplier_pan'];
    $supplier_trade_type = $_POST['supplier_trade_type'];
    $supplier_address = $_POST['supplier_address'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $insert_supplier = "INSERT into suppliers (supplier_title,
                                                supplier_email,
                                                supplier_contact,
                                                supplier_address,
                                                supplier_gstn,
                                                supplier_pan,
                                                supplier_trade_type,
                                                supplier_status,
                                                supplier_created_at,
                                                supplier_updated_at)
                                                values
                                                ('$supplier_title',
                                                '$supplier_email',
                                                '$supplier_contact',
                                                '$supplier_address',
                                                '$supplier_gstn',
                                                '$supplier_pan',
                                                '$supplier_trade_type',
                                                'active',
                                                '$today',
                                                '$today')";
    $run_insert_supplier = mysqli_query($con,$insert_supplier);

    if($run_insert_supplier){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Supplier Registration',
                                                         'New supplier by the name $supplier_title has been registered',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_insert_supplier){
        echo "
            <div class='alert alert-primary myAlert-top' role='alert'>
                Registration Successful !
            </div>
        ";
    }else {
        echo "
        <div class='alert alert-danger myAlert-top' role='alert'>
            Registration Failed ! Try Again.
        </div>
    ";
    }

}

//raw product insert query

if(isset($_POST['raw_product_insert'])){


    parse_str($_POST['data'], $_POST);
    
    $raw_product_sku = $_POST['raw_product_sku'];
    $raw_product_title = $_POST['raw_product_title'];
    $raw_product_desc = $_POST['raw_product_desc'];
    $raw_product_unit = $_POST['raw_product_unit'];
    $raw_product_subunit = $_POST['raw_product_subunit'];
    $raw_product_hsn = $_POST['raw_product_hsn'];


    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_check_raw = "select * from raw_products where raw_product_sku='$raw_product_sku'";
    $run_check_raw = mysqli_query($con,$get_check_raw);
    $check_raw = mysqli_num_rows($run_check_raw);

    if($check_raw>=1){
        echo "
        <div class='alert alert-danger myAlert-top' role='alert'>
            Dublicate SKU Entry Failed ! Try Again.
        </div>
    ";

    }else {
        $insert_raw_stock = "INSERT into raw_products (raw_product_sku,
                                                        raw_product_title,
                                                        raw_product_desc,
                                                        raw_product_unit,
                                                        raw_product_subunit,
                                                        raw_product_hsn,
                                                        raw_product_status,
                                                        raw_product_created_at,
                                                        raw_product_updated_at)
                                                        values
                                                        ('$raw_product_sku',
                                                        '$raw_product_title',
                                                        '$raw_product_desc',
                                                        '$raw_product_unit',
                                                        '$raw_product_subunit',
                                                        '$raw_product_hsn',
                                                        'active',
                                                        '$today',
                                                        '$today')";
        $run_insert_raw_stock = mysqli_query($con,$insert_raw_stock);

        if($run_insert_raw_stock){
            $staff = $_SESSION['user'];
            $insert_task = "insert into work_task_entries (user_id,
                                                            work_task_title,
                                                            work_task_content,
                                                            work_task_entry_created_at,
                                                            work_task_entry_updated_at)
                                                            values 
                                                            ('$staff',
                                                             'Raw Product Addition',
                                                             'New Raw product by the name $raw_product_title is added to the catlog',
                                                             '$today',
                                                             '$today')";
            $run_insert_task = mysqli_query($con,$insert_task);
        }

        if($run_insert_raw_stock){
            echo "
                <div class='alert alert-primary myAlert-top' role='alert'>
                    Entry Successful !
                </div>
            ";
        }else {
            echo "
            <div class='alert alert-danger myAlert-top' role='alert'>
                Entry Failed ! Try Again.
            </div>
        ";
        }

    }

}

//get supplier mail when supplier selected in purchase enquiry query

if(isset($_POST['enquiry_supplier_id'])){

    $enquiry_supplier_id = $_POST['enquiry_supplier_id'];

    $get_supplier_email = "select * from suppliers where supplier_id='$enquiry_supplier_id'";
    $run_supplier_email = mysqli_query($con,$get_supplier_email);
    $row_supplier_email = mysqli_fetch_array($run_supplier_email);

        echo $row_supplier_email['supplier_email'];
}

//check the dublicate purchase invoice number

if(isset($_POST['purchase_inc_no'])){

    $purchase_inc_no = $_POST['purchase_inc_no'];

    $get_purchase_inc_dubli = "select * from purchase_inc_entries where purchase_inc_no='$purchase_inc_no'";
    $run_purchase_inc_dubli = mysqli_query($con,$get_purchase_inc_dubli);
    $purchase_inc_dubli = mysqli_num_rows($run_purchase_inc_dubli);

        if($purchase_inc_dubli<1){
            echo 1;
        }else {
            echo 2;
        }
}

?>