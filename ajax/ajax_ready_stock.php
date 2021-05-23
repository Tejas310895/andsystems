<?php 

include("../includes/db.php");

if(isset($_POST['product_id'])){

    $product_id = $_POST['product_id'];
    $product_qty = $_POST['product_qty'];

    $get_product_sku = "select * from custom_products where custom_product_id='$product_id'";
    $run_product_sku = mysqli_query($con,$get_product_sku);
    $row_product_sku = mysqli_fetch_array($run_product_sku);

    $custom_product_sku = $row_product_sku['custom_product_sku'];
    $stock_available = 0;
    $get_raw_required = "select * from custom_product_requirements where custom_product_sku='$custom_product_sku'";
    $run_raw_required = mysqli_query($con,$get_raw_required);
    while($row_raw_required=mysqli_fetch_array($run_raw_required)){

        $raw_product_id = $row_raw_required['raw_product_id'];
        $raw_product_required_qty = $row_raw_required['raw_product_required_qty'];

        $required_qty = $product_qty*$raw_product_required_qty;

        $get_raw_stock = "select * from raw_products where raw_product_id='$raw_product_id'";
        $run_raw_stock = mysqli_query($con,$get_raw_stock);
        $row_raw_stock = mysqli_fetch_array($run_raw_stock);

        $raw_product_stock = $row_raw_stock['raw_product_stock'];

        if($required_qty<=$raw_product_stock){
            $check_stock = 0;
        }else {
            $check_stock = 1;
        }

        $stock_available += $check_stock;
    }

    if($stock_available<=0){
        echo 1;
    }else {
        echo 2;
    }
}

?>