<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>Staff Registrations</h3>
        <p class="text-subtitle text-muted">Please register new staff with correct details</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?staff" class="btn btn-primary" style="float:right;">Staff Details</a>
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
                        <form class="form" id="staff_registration" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">First Name</label>
                                        <input type="text" id="staff_name" class="form-control" placeholder="First Name"
                                            name="staff_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Email</label>
                                        <input type="email" id="staff_email" class="form-control" name="staff_email"
                                            placeholder="Email" required>
                                        <small id="emailHelp" class="form-text text-danger d-none">Email Already Exist, Try another.</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Contact</label>
                                        <input type="number" id="staff_contact" class="form-control" placeholder="Contact Number"
                                            name="staff_contact" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Staff Role</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="staff_role" name="staff_role" required>
                                            <option disabled selected>Choose the role</option>
                                            <option value="admin">Admin</option>
                                            <option value="back_office">Back Office</option>
                                            <option value="production">Production</option>
                                            <option value="sales">Sales</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <h6>Staff Status</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="staff_status" name="staff_status" required>
                                            <option disabled selected>Choose the status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">InActive</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Password</label>
                                        <input type="text" id="staff_pass" class="form-control" placeholder="Password"
                                            name="staff_pass" required>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="staff_insert" class="btn btn-primary me-1 mb-1">Submit</button>
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
<script src="js/staff.js"></script>
