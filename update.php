<?php 

include("includes/db.php");
session_start();

if(isset($_GET['purchase_enquiry'])){

    $purchase_enquiry_id = $_GET['purchase_enquiry'];

    $delete_purchase_enquiry = "update purchase_enquires set purchase_enquiry_delivery_status='shipped' where purchase_enquiry_id='$purchase_enquiry_id'";
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
                                                         'Purchase Enquiry Shipped',
                                                         'Enquiry subject-$email_subject to $supplier_email is Shipped',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_delete_purchase_enquiry){
        echo "<script>alert('Entry Updated')</script>";
        echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
    }else{
        echo "<script>alert('Entry Update Failed')</script>";
        echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
    }
}
?>