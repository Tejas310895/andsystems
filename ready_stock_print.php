<?php 

include("includes/db.php");

?>
<?php 

if(isset($_GET['ready_stock_print'])){

  $print_id = $_GET['ready_stock_print'];

  $get_ready_stock = "select * from ready_stock where print_id='$print_id'";
  $run_ready_stock = mysqli_query($con,$get_ready_stock);
  $row_ready_stock = mysqli_fetch_array($run_ready_stock);

  $product_id = $row_ready_stock['product_id'];
  $product_qty = $row_ready_stock['product_qty'];
  $ready_stock_created_at = $row_ready_stock['ready_stock_created_at'];

  $get_products = "select * from custom_products where custom_product_id='$product_id'";
  $run_products = mysqli_query($con,$get_products);
  $row_products = mysqli_fetch_array($run_products);

  $custom_product_title = $row_products['custom_product_title'];
  $custom_product_sku = $row_products['custom_product_sku'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="voler/dist/assets/images/brandlogo.png" type="image/x-icon">
    <title>ANDSYSTEMS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39 Extended Text' rel='stylesheet'>
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="voler/dist/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="barcode/js/JsBarcode.all.min.js"></script>
    <style>
        .table-bordered>:not(caption)>*>* {
                border-width:1 1px !important;
            }
        h1,h2,h3,h4,h5,h6{
            color:#000 !important;
        }
        table,th,td{
            border:1px solid #000;
        }
      #date{
        height:100px;
        width:230px;
      }
      
      #pro{
        height:100px;
        width:180px;
      }
   @media print 
            {
            @page
            {
                size: 100mm 100mm;
                /* size: portrait; */
                margin: 2mm 2mm 2mm 2mm;
            }
            .pagebreak { page-break-before: always; }
            }
    </style>
	<script>
        window.onload = function () {
            window.print();
        }

        window.onafterprint = function(){
            window.location = 'index.php?ready_stock';
        }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) { 
      JsBarcode(".barcode").init();
      });
    </script>
  </head>
  <body>
  <?php 
    for ($x = 0; $x <=($product_qty-1); $x++) {
    ?>
    <div class="pagebreak mt-1">
    <table class="text-dark table-bordered">
          <thead>
          <tr>
            <th colspan="3">
              <h4 class="text-center text-dark pt-1 mb-1">
                PRODUCT : <?php echo $custom_product_title; ?>
              </h4>
            </th>
          </tr>
          <tr>
              <th>
              <h4 class="text-center mb-0">Product Code</h4>
                  <svg class="barcode"
                      id="pro"
                      jsbarcode-format="code128"
                      jsbarcode-value="<?php echo $custom_product_sku; ?>"
                      jsbarcode-textmargin="0"
                      jsbarcode-fontoptions="bold">
                  </svg>
              </th>
              <th>
              <h4 class="text-center mb-2">Manufacuring Date</h4>
                <svg class="barcode"
                      id="date"
                      jsbarcode-format="code128"
                      jsbarcode-value="<?php echo date('d/M/Y',strtotime($ready_stock_created_at)); ?>"
                      jsbarcode-textmargin="0"
                      jsbarcode-fontoptions="bold">
                  </svg>
              </th>
          </tr>
          </thead>
          <tbody>
              <tr class="rotate">
                  <th colspan="3">
                  <!-- <h3 class="text-center carton_name" style="font-size:1.2rem;font-weight:bold;">25 Pcs Box</h3> -->
                  <h4 class="text-center pt-1 mb-0">MADE IN INDIA</h4>
                  </th>
              </tr>
          </tbody>
      </table>
    </div>
    <?php } ?>
    <?php } ?>