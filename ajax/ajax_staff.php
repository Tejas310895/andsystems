<?php 

include("../includes/db.php");

//staff insert query
session_start();

if(isset($_POST['staff_insert'])){


    parse_str($_POST['data'], $_POST);
    
    $user_name = $_POST['staff_name'];
    $user_email = $_POST['staff_email'];
    $user_contact = $_POST['staff_contact'];
    $user_role = $_POST['staff_role'];
    $user_pass = $_POST['staff_pass'];
    $user_status = $_POST['staff_status'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $insert_staff = "INSERT into users (user_name,
                                        user_email,
                                        user_contact,
                                        user_role,
                                        user_pass,
                                        user_status,
                                        user_created_at,
                                        user_updated_at)
                                        values
                                        ('$user_name',
                                        '$user_email',
                                        '$user_contact',
                                        '$user_role',
                                        '$user_pass',
                                        '$user_status',
                                        '$today',
                                        '$today')";
    $run_insert_staff = mysqli_query($con,$insert_staff);

    if($run_insert_staff){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Staff Registration',
                                                         'New Staff by name $user_name is registered',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_insert_staff){
        echo "
            <div class='alert alert-primary myAlert-top' role='alert'>
                Registration Successful !
            </div>
        ";
    }else {
        echo "
        <div class='alert alert-primary myAlert-top' role='alert'>
            Registration Failed ! Try Again.
        </div>
    ";
    }

}

//staff email check query

if(isset($_POST['staff_email'])){
    $user_email = $_POST['staff_email'];

    $check_staff = "select * from users where user_email='$user_email'";
    $run_check_staff = mysqli_query($con,$check_staff);
    $count_staff = mysqli_num_rows($run_check_staff);

    if($count_staff==0){
        echo 1;
    }else {
        echo 2;
    }
}

//staff edit query

if(isset($_POST['staff_edit'])){


    parse_str($_POST['data'], $_POST);
    
    $user_id = $_POST['staff_id'];
    $user_name = $_POST['staff_name'];
    $user_email = $_POST['staff_email'];
    $user_contact = $_POST['staff_contact'];
    $user_role = $_POST['staff_role'];
    $user_pass = $_POST['staff_pass'];
    $user_status = $_POST['staff_status'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $update_staff = "UPDATE users set user_name='$user_name',
                                      user_email='$user_email',
                                      user_contact='$user_contact',
                                      user_role='$user_role',
                                      user_pass='$user_pass',
                                      user_status='$user_status',
                                      user_updated_at='$today'
                                      where user_id='$user_id'";
    $run_update_staff = mysqli_query($con,$update_staff);

    if($run_update_staff){
        $staff = $_SESSION['user'];
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$staff',
                                                         'Staff Updation',
                                                         '$user_name details are been updated',
                                                         '$today',
                                                         '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_update_staff){
        echo "
            <div class='alert alert-primary myAlert-top' role='alert'>
                Updated Successful !
            </div>
        ";
    }else {
        echo "
            <div class='alert alert-primary myAlert-top' role='alert'>
                Updation Failed ! Try Again.
            </div>
        ";
    }

}

?>