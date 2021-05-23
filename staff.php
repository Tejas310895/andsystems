<div class="row">
    <div class="page-title col-md-10">
        <h3>Staff Details</h3>
        <p class="text-subtitle text-muted">Below are the details of staff and their management</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?staff_registration" class="btn btn-primary" style="float:right;">New Staff Registration</a>
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
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $get_user = "select * from users";
                    $run_user = mysqli_query($con,$get_user);
                    while($row_user = mysqli_fetch_array($run_user)){

                    $user_id = $row_user['user_id'];
                    $user_name = $row_user['user_name'];
                    $user_email = $row_user['user_email'];
                    $user_contact = $row_user['user_contact'];
                    $user_role = $row_user['user_role'];
                    $user_status = $row_user['user_status'];
                    
                    ?>
                    <tr>
                        <td class="uppercase"><?php echo $user_name; ?></td>
                        <td><?php echo $user_email; ?></td>
                        <td>+91 <?php echo $user_contact; ?></td>
                        <td class="text-capitalize"><?php echo $user_role; ?></td>
                        <td class="text-center">
                            <a href="index.php?staff_edit=<?php echo $user_id; ?>" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>