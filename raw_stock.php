<div class="row">
    <div class="page-title col-md-10">
        <h3>Raw Stock Details</h3>
        <p class="text-subtitle text-muted">Below are the details of raw stock</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_raw_stock" class="btn btn-primary" style="float:right;">New Raw Stock Entry</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>HSN CODE</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $get_raw_stock = "select * from raw_products where raw_product_status='active'";
                $run_raw_stock = mysqli_query($con,$get_raw_stock);
                while($row_raw_stock=mysqli_fetch_array($run_raw_stock)){
                ?>
                    <tr>
                        <td><?php echo $row_raw_stock['raw_product_sku']; ?></td>
                        <td><?php echo $row_raw_stock['raw_product_title']; ?></td>
                        <td><?php echo $row_raw_stock['raw_product_unit']; ?><br><small class="<?php if(empty($row_raw_stock['raw_product_subunit'])){echo "d-none";} ?>">(<?php echo $row_raw_stock['raw_product_subunit']; ?>)</small></td>
                        <td><?php echo $row_raw_stock['raw_product_hsn']; ?></td>
                        <td><?php echo $row_raw_stock['raw_product_stock']; ?></td>
                        <td>
                        <a href="index.php?raw_stock_edit=<?php echo $row_raw_stock['raw_product_id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?raw_product=<?php echo $row_raw_stock['raw_product_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>