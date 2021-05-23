<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Raw Product Entry</h3>
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
                        <form class="form" id="new_raw_stock_entry" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Item SKU</label>
                                        <?php
                                        
                                        $get_last_id = "select * from raw_products order by raw_product_id desc limit 1";
                                        $run_last_id = mysqli_query($con,$get_last_id);
                                        $row_last_id = mysqli_fetch_array($run_last_id);

                                        $last_id = $row_last_id['raw_product_id'];

                                        $num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
                                        $item_sku = $num.($last_id+1);
                                        
                                        ?>
                                        <input type="text" id="raw_product_sku" class="form-control" placeholder="SKU"
                                            name="raw_product_sku" value="<?php echo $item_sku; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Name</label>
                                        <input type="text" id="raw_product_title" class="form-control" placeholder="Name"
                                            name="raw_product_title"  required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Description</label>
                                        <input type="text" id="raw_product_desc" class="form-control" placeholder="Description"
                                            name="raw_product_desc">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Unit</label>
                                        <input type="text" id="raw_product_unit" class="form-control" placeholder="Unit"
                                            name="raw_product_unit" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Sub unit</label>
                                        <input type="text" id="raw_product_subunit" class="form-control" placeholder="Sub unit"
                                            name="raw_product_subunit">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">HSN Code</label>
                                        <input type="text" id="raw_product_hsn" class="form-control" placeholder="HSN Code"
                                            name="raw_product_hsn" required>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/supplier.js"></script>