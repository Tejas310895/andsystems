<div class="row">
    <div class="page-title col-md-10">
        <h3>Supplier Details</h3>
        <p class="text-subtitle text-muted">Below are the details of Supplier</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?supplier_registration" class="btn btn-primary" style="float:right;">New Supplier Registration</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>GSTN</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $get_supplier = "select * from suppliers where supplier_status='active'";
                $run_suppliers = mysqli_query($con,$get_supplier);
                while($row_suppliers=mysqli_fetch_array($run_suppliers)){  
                ?>
                    <tr>
                        <td><?php echo $row_suppliers['supplier_title']; ?></td>
                        <td><?php echo $row_suppliers['supplier_email']; ?></td>
                        <td>+91 <?php echo $row_suppliers['supplier_contact']; ?></td>
                        <td><?php echo $row_suppliers['supplier_trade_type']; ?></td>
                        <td><?php echo $row_suppliers['supplier_gstn']; ?></td>
                        <td>
                        <a href="delete.php?supplier=<?php echo $row_suppliers['supplier_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>