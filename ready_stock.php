<div class="row">
    <div class="page-title col-md-10">
        <h3>Ready Stock Details</h3>
        <p class="text-subtitle text-muted">Below are the details of Ready Stock</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_ready_stock" class="btn btn-primary" style="float:right;">New Ready Stock</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $get_ready_stock = "select * from ready_stock where ready_stock_status='active'";
                $run_ready_stock = mysqli_query($con,$get_ready_stock);
                while($row_ready_stock=mysqli_fetch_array($run_ready_stock)){
                    $custom_product_id = $row_ready_stock['product_id'];

                    $get_custom_products = "select * from custom_products where custom_product_id='$custom_product_id'";
                    $run_custom_products = mysqli_query($con,$get_custom_products);
                    $row_custom_products = mysqli_fetch_array($run_custom_products);
                ?>
                    <tr>
                        <td><?php echo date('d-M-Y H:i A',strtotime($row_ready_stock['ready_stock_created_at'])); ?></td>
                        <td><?php echo $row_custom_products['custom_product_title']; ?></td>
                        <td>1 <?php echo $row_custom_products['custom_product_unit']; ?>(<?php echo $row_custom_products['custom_product_subunit']; ?>)</td>
                        <td><?php echo $row_ready_stock['product_qty']; ?></td>
                        <td>
                            <a href="ready_stock_print.php?ready_stock_print=<?php echo $row_ready_stock['print_id']; ?>" class="btn btn-danger">Print</a>
                            <a href="delete.php?ready_stock=<?php echo $row_ready_stock['ready_stock_id']; ?>" target="_blank" class="btn btn-danger" onclick="return confirm('Are you sure you?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
