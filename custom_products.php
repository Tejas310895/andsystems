<div class="row">
    <div class="page-title col-md-10">
        <h3>Custom Products</h3>
        <p class="text-subtitle text-muted">Below are the details of custom products</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_custom_product" class="btn btn-primary" style="float:right;">New Custom Product</a>
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
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $get_custom_products = "select * from custom_products where custom_product_status='active'";
                $run_custom_products = mysqli_query($con,$get_custom_products);
                while($row_custom_products = mysqli_fetch_array($run_custom_products)){
                    $custom_product_sku = $row_custom_products['custom_product_sku'];
                ?>
                    <tr>
                        <td><?php echo $custom_product_sku; ?></td>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-link bg-transparent border-0 text-dark" data-bs-toggle="modal"
                                data-bs-target="#exampleModalScrollable">
                                    <?php echo $row_custom_products['custom_product_title']; ?>
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                <?php echo $row_custom_products['custom_product_title']; ?> Requirements</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        
                                                        $get_required_for_product = "select * from custom_product_requirements where custom_product_sku='$custom_product_sku'";
                                                        $run_required_for_product = mysqli_query($con,$get_required_for_product);
                                                        while($row_required_for_product = mysqli_fetch_array($run_required_for_product)){
                                                                $raw_product_id = $row_required_for_product['raw_product_id'];

                                                                $get_raw_product = "select * from raw_products where raw_product_id='$raw_product_id'";
                                                                $run_raw_product = mysqli_query($con,$get_raw_product);
                                                                $row_raw_product=mysqli_fetch_array($run_raw_product);
                                                        ?>
                                                            <tr>
                                                            <td class="text-bold-500"><?php echo $row_raw_product['raw_product_title']; ?></td>
                                                            <td><?php echo $row_required_for_product['raw_product_required_qty']; ?> <?php echo $row_raw_product['raw_product_unit']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $row_custom_products['custom_product_unit']; ?><br><small class="<?php if((strlen($row_custom_products['custom_product_subunit']))<0){echo"d-none";} ?>">(<?php echo $row_custom_products['custom_product_subunit']; ?>)</small></td>
                        <td><?php echo $row_custom_products['custom_product_stock']; ?></td>
                        <td><?php echo $row_custom_products['custom_product_status']; ?></td>
                        <td>
                        <a href="delete.php?custom_product=<?php echo $row_custom_products['custom_product_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>