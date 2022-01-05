<?php 

if (isset($_GET['raw_stock_edit'])) {

    $raw_product_id = $_GET['raw_stock_edit'];

    $get_raw_data = "select * from raw_products where raw_product_id='$raw_product_id'";
    $run_raw_data = mysqli_query($con,$get_raw_data);
    $row_raw_data = mysqli_fetch_array($run_raw_data);

    $raw_product_sku = $row_raw_data['raw_product_sku'];
    $raw_product_title = $row_raw_data['raw_product_title'];
    $raw_product_desc = $row_raw_data['raw_product_desc'];
    $raw_product_unit = $row_raw_data['raw_product_unit'];
    $raw_product_subunit = $row_raw_data['raw_product_subunit'];
    $raw_product_hsn = $row_raw_data['raw_product_hsn'];
    $raw_product_stock = $row_raw_data['raw_product_stock'];
    $raw_product_status = $row_raw_data['raw_product_status'];

?>

<div class="row">
    <div class="page-title col-md-10">
        <h3>New Raw Stock Modification</h3>
        <p class="text-subtitle text-muted">Please enter correct details</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?raw_stock" class="btn btn-primary" style="float:right;">Raw Stock Details</a>
    </div>
</div>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title">Multiple Column</h4> -->
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Item SKU</label>
                                        <input type="text" id="" class="form-control" placeholder="SKU" value="<?php echo $raw_product_sku; ?>"
                                            name="raw_product_sku" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Name</label>
                                        <input type="text" id="first-name-column" class="form-control" placeholder="Name" value="<?php echo $raw_product_title; ?>"
                                            name="raw_product_title" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Description</label>
                                        <input type="text" id="first-name-column" class="form-control" placeholder="Description" value="<?php echo $raw_product_desc; ?>"
                                            name="raw_product_desc" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Unit</label>
                                        <input type="text" id="first-name-column" class="form-control" placeholder="Unit" value="<?php echo $raw_product_unit; ?>"
                                            name="raw_product_unit" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Sub unit</label>
                                        <input type="text" id="first-name-column" class="form-control" placeholder="Sub unit" value="<?php echo $raw_product_subunit; ?>"
                                            name="raw_product_subunit" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">HSN Code</label>
                                        <input type="text" id="first-name-column" class="form-control" placeholder="HSN Code" value="<?php echo $raw_product_hsn; ?>"
                                            name="raw_product_hsn" required> 
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="raw_edit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <!-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 

if(isset($_POST['raw_edit'])){

$Eraw_product_title = $_POST['raw_product_title'];
$Eraw_product_desc = $_POST['raw_product_desc'];
$Eraw_product_unit = $_POST['raw_product_unit'];
$Eraw_product_subunit = $_POST['raw_product_subunit'];
$Eraw_product_hsn = $_POST['raw_product_hsn'];

$update_raw = "update raw_products set raw_product_title='$Eraw_product_title',
                                       raw_product_desc='$Eraw_product_desc',
                                       raw_product_unit='$Eraw_product_unit',
                                       raw_product_subunit='$Eraw_product_subunit',
                                       raw_product_hsn='$Eraw_product_hsn' 
                                       where raw_product_id='$raw_product_id'";
$run_update_raw = mysqli_query($con,$update_raw);

date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d H:i:s");

if($run_update_raw){
    $staff = $_SESSION['user'];
    $insert_task = "insert into work_task_entries (user_id,
                                                    work_task_title,
                                                    work_task_content,
                                                    work_task_entry_created_at,
                                                    work_task_entry_updated_at)
                                                    values 
                                                    ('$staff',
                                                     'Raw Stock Modification - $Eraw_product_title',
                                                     'Changes Done - Name: $Eraw_product_title/Desc: $Eraw_product_desc/Unit: $Eraw_product_unit/Subunit: $Eraw_product_subunit/HSN: $Eraw_product_hsn',
                                                     '$today',
                                                     '$today')";
    $run_insert_task = mysqli_query($con,$insert_task);
}

if ($run_update_raw) {
    echo "<script>alert('Item Successfully updated')</script>";
    echo "<script>window.open('index.php?raw_stock','_self')</script>";    
}else {
    echo "<script>alert('Error! Try Again')</script>";
}

}

?>

<?php }else {
    echo "<script>alert('Error! Try Again')</script>";
    echo "<script>window.open('index.php?raw_stock','_self')</script>";    
} ?>

<?php ?>