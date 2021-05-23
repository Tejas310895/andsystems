<?php 

if(isset($_GET['purchase_enquiry_edit'])){

    $purchase_enquiry_id = $_GET['purchase_enquiry_edit'];

    $get_purchase_enquiry_det = "select * from purchase_enquires where purchase_enquiry_id='$purchase_enquiry_id'";
    $run_purchase_enquiry_det = mysqli_query($con,$get_purchase_enquiry_det);
    $row_purchase_enquiry_det = mysqli_fetch_array($run_purchase_enquiry_det);

}

?>
<div class="row">
    <div class="page-title col-md-10">
        <h3>Modify Purchase Enquiry</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?purchase_enquiry" class="btn btn-primary" style="float:right;">Purchase Enquires</a>
    </div>
</div>
<form id="edit_raw_product" method="post" action="">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label>Supplier Email</label>
                <input type="email" class="form-control" name="supplier_email" id="supplier_email" aria-describedby="" value="<?php echo $row_purchase_enquiry_det['supplier_email']; ?>" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Delivery Schedule</label>
                <input type="date" class="form-control" name="del_date" id="del_date" aria-describedby="" value="<?php echo date('Y-m-d',strtotime($row_purchase_enquiry_det['purchase_enquiry_schedule'])); ?>"required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Email Subject</label>
                <input type="text" class="form-control" name="email_subject" id="email_subject" value="<?php echo $row_purchase_enquiry_det['email_subject']; ?>" aria-describedby="" required>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Email Content</label>
                <textarea class="form-control" id="email_content" name="email_content"
                    rows="3" required><?php echo $row_purchase_enquiry_det['email_content']; ?></textarea>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Email Note</label>
                <textarea class="form-control" id="email_note" name="email_note"
                    rows="3"><?php echo $row_purchase_enquiry_det['email_note']; ?></textarea>
            </div>
        </div>
    </div>
    
    <button type="submit" name="edit_raw_enquiry" id="edit_raw_enquiry"  class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>
    
</form>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/supplier.js"></script>
<?php 

if(isset($_POST['edit_raw_enquiry'])){

    $supplier_email = $_POST['supplier_email'];
    $del_date = $_POST['del_date'];
    $email_subject = $_POST['email_subject'];
    $email_content = $_POST['email_content'];
    $email_note = $_POST['email_note'];

    $update_purchase_enquiry = "update purchase_enquires set email_subject='$email_subject',
                                                            email_content='$email_content',
                                                            email_note='$email_note',
                                                            supplier_email='$supplier_email',
                                                            purchase_enquiry_schedule='$del_date'
                                                             where purchase_enquiry_id='$purchase_enquiry_id'";
    $run_update_purchase_enquiry = mysqli_query($con,$update_purchase_enquiry);

    if($run_update_purchase_enquiry){
        $insert_task = "insert into work_task_entries (user_id,
                                                        work_task_title,
                                                        work_task_content,
                                                        work_task_entry_created_at,
                                                        work_task_entry_updated_at)
                                                        values 
                                                        ('$user_id',
                                                        'Purchase enquiry Edited',
                                                        'Purchase entry details edited for $supplier_email with subject-$email_subject',
                                                        '$today',
                                                        '$today')";
        $run_insert_task = mysqli_query($con,$insert_task);
    }

    if($run_update_purchase_enquiry){
        echo "<script>alert('Updation Done')</script>";
        echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
    }else{
        echo "<script>alert('Failed, Try again')</script>";
    }
}

?>
