<div class="page-title">
    <h3>Dashboard</h3>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#overview"
                        role="tab" aria-controls="home" aria-selected="true">OVERVIEW</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#raw_stock"
                        role="tab" aria-controls="profile" aria-selected="false">RAW STOCK</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#ready_stock"
                        role="tab" aria-controls="contact" aria-selected="false">READY STOCK</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                    aria-labelledby="home-tab">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Recent Purchase Enquiries</h4>
                                    </div>
                                    <div class="card-body px-0 pb-0">
                                        <div class="table-responsive">
                                            <table class='table mb-0'>
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Supplier Mail</th>
                                                        <th>Schedule</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                
                                                    $get_purchase_enquiry = "select * from purchase_enquires order by purchase_enquiry_created_at desc limit 7";
                                                    $run_purchase_enquiry = mysqli_query($con,$get_purchase_enquiry);
                                                    while($row_purchase_enquiry = mysqli_fetch_array($run_purchase_enquiry)){
                                                
                                                ?>
                                                    <tr>
                                                        <td><?php echo date('d-M-Y H:i A',strtotime($row_purchase_enquiry['purchase_enquiry_created_at'])); ?></td>
                                                        <td><?php echo $row_purchase_enquiry['supplier_email']; ?></td>
                                                        <td><?php echo date('d-M-Y',strtotime($row_purchase_enquiry['purchase_enquiry_schedule'])); ?></td>
                                                        <td>
                                                            <?php 
                                                            
                                                            if($row_purchase_enquiry['purchase_enquiry_delivery_status']==='initiated'){
                                                                
                                                                echo "<span class='badge bg-info text-capitalize'>initiated</span>";

                                                            }elseif($row_purchase_enquiry['purchase_enquiry_delivery_status']==='completed'){

                                                                echo "<span class='badge bg-success text-capitalize'>completed</span>";

                                                            }elseif($row_purchase_enquiry['purchase_enquiry_delivery_status']==='cancelled'){

                                                                echo "<span class='badge bg-danger text-capitalize'>cancelled</span>";

                                                            }
                                                            
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Recent Sales</h4>
                                    </div>
                                    <div class="card-body px-0 pb-0">
                                        <div class="table-responsive">
                                            <table class='table mb-0'>
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Invoice No.</th>
                                                        <th>Customer Name</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    
                                                    $get_sales = "select * from sale_inc_entries where sale_inc_status='active' order by sale_inc_created_at desc limit 7";
                                                    $run_sales = mysqli_query($con,$get_sales);
                                                    while($row_sales=mysqli_fetch_array($run_sales)){
                                                        
                                                        $sale_inc_no = $row_sales['sale_inc_no'];

                                                        $get_amount = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                                                        $run_amount = mysqli_query($con,$get_amount);
                                                        $amount = 0;
                                                        while($row_amount = mysqli_fetch_array($run_amount)){
                                                            $sale_product_unit_rate = $row_amount['sale_product_unit_rate'];
                                                            $sale_product_qty = $row_amount['sale_product_qty'];
                                                            $sub_amt = $sale_product_unit_rate*$sale_product_qty;
                                                            $amount += $sub_amt;
                                                        }

                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('d-M-Y H:i A',strtotime($row_sales['sale_inc_created_at'])); ?></td>
                                                        <td><?php echo $row_sales['sale_inc_no']; ?></td>
                                                        <td><?php echo $row_sales['billed_title']; ?></td>
                                                        <td><?php echo $amount; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="tab-pane fade" id="raw_stock" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <div class="row mt-4">
                    <?php 
                    
                    $get_raw_stock = "select * from raw_products where raw_product_status='active' order by raw_product_stock asc";
                    $run_raw_stock = mysqli_query($con,$get_raw_stock);
                    while($row_raw_stock=mysqli_fetch_array($run_raw_stock )){
                    
                    ?>
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="card-text"><?php echo $row_raw_stock['raw_product_title']; ?></h3>
                                            <p class="card-title"><?php echo $row_raw_stock['raw_product_stock']." ".$row_raw_stock['raw_product_unit']; ?> <?php if(!empty($row_raw_stock['raw_product_subunit'])){echo "(".$row_raw_stock['raw_product_subunit'].")";} ?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="btn btn-icon btn-<?php if($row_raw_stock['raw_product_stock']<500){echo"danger blink";}else{echo"success";} ?> float-end" >
                                                <i data-feather="<?php if($row_raw_stock['raw_product_stock']<500){echo"arrow-down";}else{echo"arrow-up";} ?>"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="ready_stock" role="tabpanel"
                    aria-labelledby="contact-tab">
                    <div class="row mt-4">
                    <?php 
                    
                    $get_custom = "select * from custom_products where custom_product_status='active' order by custom_product_stock asc";
                    $run_custom = mysqli_query($con,$get_custom);
                    while($row_custom=mysqli_fetch_array($run_custom)){
                    
                    ?>
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="card-text"><?php echo $row_custom['custom_product_title']; ?></h3>
                                            <p class="card-title"><?php echo $row_custom['custom_product_stock']." ".$row_custom['custom_product_unit']; ?> <?php if(!empty($row_custom['custom_product_subunit'])){echo "(".$row_custom['custom_product_subunit'].")";} ?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="btn btn-icon btn-<?php if($row_custom['custom_product_stock']<500){echo"danger blink";}else{echo"success";} ?> float-end" >
                                                <i data-feather="<?php if($row_custom['custom_product_stock']<500){echo"arrow-down";}else{echo"arrow-up";} ?>"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>