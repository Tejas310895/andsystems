<?php 

include("includes/db.php");


if(isset($_GET['work_order_print'])){

    $work_order_entry_id = $_GET['work_order_print'];

    $get_work_order = "select * from work_order_entry where work_order_entry_id='$work_order_entry_id'";
    $run_work_order = mysqli_query($con,$get_work_order);
    $row_work_order = mysqli_fetch_array($run_work_order);

    $work_order_ref_no = $row_work_order['work_order_ref_no'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Courgette' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<title>Bill</title>
	<style>
		@media print{
			.table,thead{
				border:2px solid #000;
			}
		}
	</style>
	<script>
        window.onload = function () {
            window.print();
        }

        window.onafterprint = function(){
            window.close();
        }
    </script>
</head>
<body>
	<div class="container-fluid px-4">
		<table class="table table-bordered mt-2 head">
		<thead>
        <tr>
            <th class="text-center" style="border:3px solid #000;font-size:2rem;" colspan="4">WORK ORDER PRINT</th>
        </tr>
		<tr>
            <th  style="border:3px solid #000;">Reference No.</th><th style="border:3px solid #000;"><?php echo $row_work_order['work_order_ref_no']; ?></th>
            <th  style="border:3px solid #000;">Date</th><th style="border:3px solid #000;"><?php echo date('d-M-Y',strtotime($row_work_order['work_order_created_at'])); ?></th>
		</tr>
		</thead>
		</table>
		<table class="table table-bordered mt-2">
			<thead class="text-center">
				<th style="width:5%;">Sl.No</th>
				<th style="width:60%;">ITEM</th>
                <th style="width:10%;">UNIT</th>
				<th style="width:5%;">QUANTITY</th>
			</thead>
			<tbody>
                <?php 
                
                $get_work_task = "select * from work_order_task where work_order_ref_no='$work_order_ref_no'";
                $run_work_task = mysqli_query($con,$get_work_task);
                $counter = 0;
                while($row_work_task=mysqli_fetch_array($run_work_task)){
                
                $custom_product_id = $row_work_task['custom_product_id'];
                $custom_product_qty = $row_work_task['custom_product_qty'];
                    
                $get_custom_product = "select * from custom_products where custom_product_id='$custom_product_id'";
                $run_custom_product = mysqli_query($con,$get_custom_product); 
                $row_custom_product = mysqli_fetch_array($run_custom_product);

                $custom_product_title = $row_custom_product['custom_product_title'];
                $custom_product_unit = $row_custom_product['custom_product_unit'];
                $custom_product_subunit = $row_custom_product['custom_product_subunit'];
                ?>
                <tr>
                <td class='text-center'><?php echo ++$counter; ?></td>
                <td><?php echo $custom_product_title; ?></td>
                <td class='text-center'><?php echo $custom_product_unit; ?> <br> <?php echo $custom_product_subunit; ?></td>
                <td class='text-center'><?php echo $custom_product_qty; ?></td>
                </tr>
                <?php } ?>
			</tbody>
            <tfoot>
                <tr>
                    <th colspan="4">
                        NOTE:<br>
                        <?php echo $row_work_order['work_order_note']; ?>
                    </th>
                </tr> 
            </tfoot>
		</table>
	</div>
</body>
</html>
<?php } ?>