<?php 

session_start();

if(!isset($_SESSION['user'])){

    echo "<script>window.open('login','_self')</script>";

}else{
    include("includes/db.php");

    $user_id = $_SESSION['user'];
    $get_staff = "select * from users where user_id='$user_id'";
    $run_staff = mysqli_query($con,$get_staff);
    $row_staff = mysqli_fetch_array($run_staff);

    $user_name = $row_staff['user_name'];
    $user_role = $row_staff['user_role'];
    $user_status = $row_staff['user_status'];
    $user_role = $row_staff['user_role'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AND SYSTEMS INDUSTRY MANAGEMENT SOFTWARE</title>

    <link rel="stylesheet" href="voler/dist/assets/css/bootstrap.css?version=1">

    <link rel="stylesheet" href="voler/dist/assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="voler/dist/assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="voler/dist/assets/vendors/quill/quill.snow.css">

    <link rel="stylesheet" href="voler/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="voler/dist/assets/css/app.css">
    <link rel="shortcut icon" href="voler/dist/assets/images/brandlogo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
    <?php include("includes/sidebar.php"); ?>
        <div id="main">
        <?php include("includes/horizontalbar.php"); ?>
            <div class="main-content container-fluid">
                <?php 

                // if(empty($_GET[''])){
                                    
                //     include("dashboard.php");
                    
                // }
                
                if(isset($_GET['dashboard'])){
                    
                    include("dashboard.php");
                    
                }

                if(isset($_GET['staff'])){
                    
                    include("staff.php");
                    
                }

                if(isset($_GET['staff_registration'])){
                    
                    include("staff_registration.php");
                    
                }

                if(isset($_GET['staff_edit'])){
                    
                    include("staff_edit.php");
                    
                }

                if(isset($_GET['staff_performance'])){
                    
                    include("staff_performance.php");
                    
                }

                if(isset($_GET['work_orders'])){
                    
                    include("work_orders.php");
                    
                }

                if(isset($_GET['new_work_order'])){
                    
                    include("new_work_order.php");
                    
                }

                if(isset($_GET['work_order_edit'])){
                    
                    include("work_order_edit.php");
                    
                }

                if(isset($_GET['suppliers'])){
                    
                    include("suppliers.php");
                    
                }

                if(isset($_GET['supplier_registration'])){
                    
                    include("supplier_registration.php");
                    
                }

                if(isset($_GET['supplier_edit'])){
                    
                    include("supplier_edit.php");
                    
                }

                if(isset($_GET['raw_stock'])){
                    
                    include("raw_stock.php");
                    
                }

                if(isset($_GET['new_raw_stock'])){
                    
                    include("new_raw_stock.php");
                    
                }

                if(isset($_GET['raw_stock_edit'])){
                    
                    include("raw_stock_edit.php");
                    
                }

                if(isset($_GET['purchase_enquiry'])){
                    
                    include("purchase_enquiry.php");
                    
                }

                if(isset($_GET['new_purchase_enquiry'])){
                    
                    include("new_purchase_enquiry.php");
                    
                }

                if(isset($_GET['purchase_enquiry_edit'])){
                    
                    include("purchase_enquiry_edit.php");
                    
                }

                if(isset($_GET['purchase_invoice'])){
                    
                    include("purchase_invoice.php");
                    
                }

                if(isset($_GET['new_purchase_invoice'])){
                    
                    include("new_purchase_invoice.php");
                    
                }

                if(isset($_GET['custom_products'])){
                    
                    include("custom_products.php");
                    
                }

                if(isset($_GET['new_custom_product'])){
                    
                    include("new_custom_product.php");
                    
                }

                if(isset($_GET['ready_stock'])){
                    
                    include("ready_stock.php");
                    
                }

                if(isset($_GET['new_ready_stock'])){
                    
                    include("new_ready_stock.php");
                    
                }

                if(isset($_GET['customers'])){
                    
                    include("customers.php");
                    
                }

                if(isset($_GET['customer_registration'])){
                    
                    include("customer_registration.php");
                    
                }

                if(isset($_GET['sales_invoices'])){
                    
                    include("sales_invoices.php");
                    
                }

                if(isset($_GET['new_sale_invoice'])){
                    
                    include("new_sale_invoice.php");
                    
                }

                if(isset($_GET['bulk_purchase_invoice'])){
                    
                    include("bulk_purchase_invoice.php");
                    
                }

                if(isset($_GET['bulk_sale_invoice'])){
                    
                    include("bulk_sale_invoice.php");
                    
                }

                
                ?>

            </div>
            <!-- <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2020 &copy; Voler</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                                href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>
    <script src="voler/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="voler/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="voler/dist/assets/js/app.js"></script>
    <script src="voler/dist/assets/vendors/quill/quill.min.js"></script>
    <script src="voler/dist/assets/js/pages/form-editor.js"></script>

    <script src="voler/dist/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="voler/dist/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="voler/dist/assets/js/pages/dashboard.js"></script>
    <script src="voler/dist/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="voler/dist/assets/js/vendors.js"></script>

    <script src="voler/dist/assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php } ?>