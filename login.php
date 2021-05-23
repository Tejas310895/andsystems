
<?php 

session_start();
include("includes/db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - AND SYSTEMS</title>
    <link rel="stylesheet" href="voler/dist/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="voler/dist/assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="voler/dist/assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="voler/dist/assets/images/brandlogo.png" height="150" class='mb-0'>
                            </div>
                            <form action="" method="post">
                                <div class="form-group position-relative has-icon-left text-center">
                                    <label for="username" class="mb-3"><h5>Username</h5></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control mb-4" id="username" name="username">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left text-center">
                                    <div class="clearfix">
                                        <label for="password" class="mb-3"><h5>Password</h5></label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control mb-4" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-primary btn-lg btn-block mt-3" name="user_login">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="voler/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="voler/dist/assets/js/app.js"></script>
    <script src="voler/dist/assets/js/main.js"></script>
</body>
</html>
<?php 

    if(isset($_POST['user_login'])){

        $admin_user = mysqli_real_escape_string($con,$_POST['username']);

        $admin_pass = mysqli_real_escape_string($con,$_POST['password']);

        $get_admin = "select * from users where user_email='$admin_user' AND user_pass='$admin_pass'";

        $run_admin = mysqli_query($con,$get_admin);

        $row_admin = mysqli_fetch_array($run_admin);

        $user_id = $row_admin['user_id'];

        $user_status = $row_admin['user_status'];

        $count = mysqli_num_rows($run_admin);

            if($count==1){

                if($user_status==='active'){

                $_SESSION['user']=$user_id;

                date_default_timezone_set('Asia/Kolkata');
                $today = date("Y-m-d H:i:s");

                $insert_task = "insert into work_task_entries (user_id,
                                                                work_task_title,
                                                                work_task_content,
                                                                work_task_entry_created_at,
                                                                work_task_entry_updated_at)
                                                                values 
                                                                ('$user_id',
                                                                 'Staff Logged In',
                                                                 'Staff logged in to the system',
                                                                 '$today',
                                                                 '$today')";
                $run_insert_task = mysqli_query($con,$insert_task);              

                echo "<script>alert('Logged in. Welcome to AND SYSTEMS')</script>";

                echo "<script>window.open('index.php?dashboard','_self')</script>";

                }else{

                    echo "<script>alert('Your Access is denied, Please contact admin')</script>"; 
        
                }

            }else{

                echo "<script>alert('Username or Password is Worng')</script>"; 

            }

    }

?>