<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>Supplier Registrations</h3>
        <p class="text-subtitle text-muted">Please register new Supplier with correct details</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?suppliers" class="btn btn-primary" style="float:right;">Supplier Details</a>
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
                        <form class="form" id="supplier_registration" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Name</label>
                                        <input type="text" id="supplier_title" class="form-control" placeholder="Name"
                                            name="supplier_title" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Email</label>
                                        <input type="email" id="supplier_email" class="form-control" name="supplier_email"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Contact</label>
                                        <input type="number" id="supplier_contact" class="form-control" placeholder="Contact Number"
                                            name="supplier_contact" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">GSTN</label>
                                        <input type="text" id="supplier_gstn" class="form-control" placeholder="GSTN"
                                            name="supplier_gstn" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">PAN Number</label>
                                        <input type="text" id="supplier_pan" class="form-control" placeholder="PAN Number"
                                            name="supplier_pan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Trade Type</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="supplier_trade_type" name="supplier_trade_type" required>
                                            <option disabled selected value="">Choose the Trade</option>
                                            <option value="import">Import</option>
                                            <option value="local">Local</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                        <textarea class="form-control" id="supplier_address" name="supplier_address"
                                            rows="3" required></textarea>
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