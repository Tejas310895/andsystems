<div class="row">
    <div class="page-title col-md-10">
        <h3>Staff Performance</h3>
        <p class="text-subtitle text-muted">Below is the staff performance details</p>
    </div>
    <!-- <div class="col-md-2">
        <a href="index.php?staff_registration" class="btn btn-primary" style="float:right;">New Staff Registration</a>
    </div> -->
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr class="text-center">
                        <th>Staff Name</th>
                        <th>Today's Task</th>
                        <th>Total Task</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $user_name; ?></td>
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#today_task">
                                Today Completed Task <span class="badge bg-white text-dark">
                                
                                <?php 
                                

                                date_default_timezone_set('Asia/Kolkata');
                                $today = date("Y-m-d");

                                $get_today_task_count = "select * from work_task_entries where CAST(work_task_entry_created_at as DATE)='$today' and user_id='$user_id'";
                                $run_today_task_count = mysqli_query($con,$get_today_task_count);
                                $today_task_count = mysqli_num_rows($run_today_task_count);

                                echo $today_task_count;
                                ?>
                                
                                </span>
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="today_task" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                Today's Task of Tejas Shirsat</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <?php 
                                        
                                        $get_today_task = "select * from work_task_entries where CAST(work_task_entry_created_at as DATE)='$today' and user_id='$user_id' order by work_task_entry_created_at desc";
                                        $run_today_task = mysqli_query($con,$get_today_task);
                                        while($row_today_task=mysqli_fetch_array($run_today_task)){

                                        ?>
                                            <p class="mb-1 mt-2">
                                            <span class="badge bg-primary text-capitalize mb-1">Task - <?php echo $row_today_task['work_task_title']; ?></span>
                                            <span class="badge bg-primary mb-2">Done at - <?php echo date('d-M-Y H:i A',strtotime($row_today_task['work_task_entry_created_at'])); ?></span><br>
                                                <?php echo $row_today_task['work_task_content']; ?>
                                            </p>
                                            <hr class="my-1">
                                            <?php } ?>
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
                        <td>
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#total_task">
                                Total Completed Task <span class="badge bg-white text-dark">
                                
                                <?php 
                                
                                $get_total_task_count = "select * from work_task_entries where user_id='$user_id'";
                                $run_total_task_count = mysqli_query($con,$get_total_task_count);
                                $total_task_count = mysqli_num_rows($run_total_task_count);

                                echo $total_task_count;
                                ?>

                                </span>
                            </button>

                            <!--scrolling content Modal -->
                            <div class="modal fade" id="total_task" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                Scrolling long Content</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <?php 
                                        
                                        $get_total_task = "select * from work_task_entries where user_id='$user_id' order by work_task_entry_created_at desc";
                                        $run_total_task = mysqli_query($con,$get_total_task);
                                        while($row_total_task=mysqli_fetch_array($run_total_task)){

                                        ?>
                                            <p class="mb-1 mt-2">
                                            <span class="badge bg-primary text-capitalize mb-1">Task - <?php echo $row_total_task['work_task_title']; ?></span>
                                            <span class="badge bg-primary mb-2">Done at - <?php echo date('d-M-Y H:i A',strtotime($row_total_task['work_task_entry_created_at'])); ?></span><br>
                                                <?php echo $row_total_task['work_task_content']; ?>
                                            </p>
                                            <hr class="my-1">
                                            <?php } ?>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>