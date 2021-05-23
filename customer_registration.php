<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>Customer Registrations</h3>
        <p class="text-subtitle text-muted">Please register new customer with correct details</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?customers" class="btn btn-primary" style="float:right;">Customer Details</a>
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
                        <form class="form" id="customer_registration" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Name</label>
                                        <input type="text" id="customer_title" class="form-control" placeholder="Name"
                                            name="customer_title" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Email</label>
                                        <input type="email" id="customer_email" class="form-control" name="customer_email"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Contact</label>
                                        <input type="number" id="customer_contact" class="form-control" placeholder="Contact Number"
                                            name="customer_contact" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                        <textarea class="form-control" id="customer_address" name="customer_address"
                                            rows="1" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Pincode</label>
                                        <input type="number" id="customer_pincode" class="form-control" placeholder="Pincode"
                                            name="customer_pincode" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">State</label>
                                        <input type="text" id="customer_state" class="form-control" placeholder="State"
                                            name="customer_state" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">State Code</label>
                                        <input type="number" id="customer_state_code" class="form-control" placeholder="State Code"
                                            name="customer_state_code" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">GSTN</label>
                                        <input type="text" id="customer_gstn" class="form-control" placeholder="GSTN"
                                            name="customer_gstn" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">PAN Number</label>
                                        <input type="text" id="customer_pan" class="form-control" placeholder="PAN Number"
                                            name="customer_pan">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="insert_customer" class="btn btn-primary me-1 mb-1">Submit</button>
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
<script src="js/sales.js"></script>