<?php 

if(isset($_GET['staff_edit'])){

    $staff_id = $_GET['staff_edit'];

    $get_staff = "select * from users where user_id='$staff_id'";
    $run_staff = mysqli_query($con,$get_staff);
    $row_staff = mysqli_fetch_array($run_staff);

    $user_name = $row_staff['user_name'];
    $user_email = $row_staff['user_email'];
    $user_contact = $row_staff['user_contact'];
    $user_role = $row_staff['user_role'];
    $user_pass = $row_staff['user_pass'];
    $user_status = $row_staff['user_status'];

?>
<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>Staff Modification</h3>
        <p class="text-subtitle text-muted">Please edit new staff with correct details</p>
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
                        <form class="form" id="staff_modification" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                                        <label for="first-name-column">First Name</label>
                                        <input type="text" id="staff_name" class="form-control" placeholder="First Name"
                                            name="staff_name" value="<?php echo $user_name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Email</label>
                                        <input type="email" id="staff_email" class="form-control" name="staff_email"
                                            placeholder="Email" value="<?php echo $user_email; ?>" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Contact</label>
                                        <input type="number" id="staff_contact" class="form-control" placeholder="Contact Number"
                                            name="staff_contact" value="<?php echo $user_contact; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Staff Role</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="staff_role" name="staff_role" required>
                                            <option value="<?php echo $user_role; ?>">
                                            
                                            <?php 
                                            
                                            if($user_role==='admin'){
                                                echo "Admin";
                                            }elseif($user_role==='back_office'){
                                                echo "Back Office";
                                            }elseif($user_role==='production'){
                                                echo "Production";
                                            }elseif($user_role==='sales'){
                                                echo "Sales";
                                            }
                                            
                                            ?>
                                            
                                            </option>
                                            <?php
                                            
                                            if($user_role==='admin'){
                                                echo "
                                                <option value='back_office'>Back Office</option>
                                                <option value='production'>Production</option>
                                                <option value='sales'>Sales</option>    
                                                ";
                                            }elseif($user_role==='back_office'){
                                                echo "
                                                <option value='admin'>Back Office</option>
                                                <option value='production'>Production</option>
                                                <option value='sales'>Sales</option>    
                                                ";
                                            }elseif($user_role==='production'){
                                                echo "
                                                <option value='admin'>Back Office</option>
                                                <option value='back_office'>Production</option>
                                                <option value='sales'>Sales</option>    
                                                ";
                                            }elseif($user_role==='sales'){
                                                echo "
                                                <option value='admin'>Back Office</option>
                                                <option value='back_office'>Production</option>
                                                <option value='production'>Sales</option>    
                                                ";
                                            }
                                            
                                            ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <h6>Staff Status</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="staff_status" name="staff_status" required>
                                            <option value="<?php echo $user_status; ?>">
                                            <?php 
                                            
                                            if($user_status==='active'){
                                                echo "Active";
                                            }elseif($user_status==='inactive'){
                                                echo "InActive";
                                            }
                                            
                                            ?>
                                            </option>
                                            <?php
                                            
                                            if($user_status==='active'){
                                                echo "
                                                <option value='inactive'>InActive</option>    
                                                ";
                                            }elseif($user_status==='inactive'){
                                                echo "
                                                <option value='active'>Active</option>
                                                ";
                                            }
                                            
                                            ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Password</label>
                                        <input type="text" id="staff_pass" class="form-control" placeholder="Password"
                                            name="staff_pass" value="<?php echo $user_pass; ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="staff_edit" class="btn btn-primary me-1 mb-1">Submit</button>
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
<?php } ?>