<?php 

include("../includes/db.php");

//customer insert query
session_start();

if(isset($_POST['customer_insert'])){


    parse_str($_POST['data'], $_POST);
    
    $customer_title = $_POST['customer_title'];
    $customer_email = $_POST['customer_email'];
    $customer_contact = $_POST['customer_contact'];
    $customer_address = $_POST['customer_address'];
    $customer_pincode = $_POST['customer_pincode'];
    $customer_state = $_POST['customer_state'];
    $customer_state_code = $_POST['customer_state_code'];
    $customer_gstn = $_POST['customer_gstn'];
    $customer_pan = $_POST['customer_pan'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $insert_customer = "INSERT into customers (customer_title,
                                                customer_contact,
                                                customer_email,
                                                customer_address,
                                                customer_pincode,
                                                customer_state,
                                                customer_state_code,
                                                customer_gstn,
                                                customer_pan,
                                                customer_status,
                                                customer_created_at,
                                                customer_updated_at)
                                                values
                                                ('$customer_title',
                                                '$customer_contact',
                                                '$customer_email',
                                                '$customer_address',
                                                '$customer_pincode',
                                                '$customer_state',
                                                '$customer_state_code',
                                                '$customer_gstn',
                                                '$customer_pan',
                                                'active',
                                                '$today',
                                                '$today')";
    $run_insert_customer = mysqli_query($con,$insert_customer);

    if($run_insert_customer){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Customer Registration',
                                                         'New customer by name $customer_title is registered',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_insert_customer){
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

if(isset($_POST['customer_title'])){
    $billed_title = $_POST['customer_title'];

    $get_cust = "select * from customers where customer_title like '%$billed_title%'";
    $run_cust = mysqli_query($con,$get_cust);
    $row_cust = mysqli_fetch_array($run_cust);

    $customer_contact = $row_cust['customer_contact'];
    $customer_address = $row_cust['customer_address'];
    $customer_state = $row_cust['customer_state'];
    $customer_state_code = $row_cust['customer_state_code'];
    $customer_gstn = $row_cust['customer_gstn'];

    echo json_encode(array("customer_contact"=>$customer_contact,
                           "customer_address"=>$customer_address,
                           "customer_state"=>$customer_state,
                           "customer_state_code"=>$customer_state_code,
                           "customer_gstn"=>$customer_gstn));
}

?>