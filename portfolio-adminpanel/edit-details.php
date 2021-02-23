<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['details-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-details'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $designed_by = $_POST['designed_by'];
        $designed_by_url = $_POST['designed_by_url'];
        $developed_by = $_POST['developed_by'];
        $developed_by_url = $_POST['developed_by_url'];
   
        $query = "UPDATE details SET email='$email',address='$address',phone='$phone',mobile='$mobile',designed_by='$designed_by',designed_by_url='$designed_by_url',developed_by='$developed_by',developed_by_url='$developed_by_url',updationDate='$currentTime' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['details-update-msg']="Details Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['details-update-msg']="There was an error while updating details section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Edit Details Section';
    include './includes/header.php';
    include '../includes/navbar.php'; 
?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <form method="post" enctype="multipart/form-data">
                <h5 class="form-head">Edit details Section</h5>
                <hr />
                <?php if ($_SESSION['details-update-msg'] != '') { ?>
                    <span class=<?php echo $_SESSION['msgclass']; ?>>
                        <?php echo htmlentities($_SESSION['details-update-msg']); ?>
                    </span>
                    <?php }

                        $query=mysqli_query($conn, "select * from details where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email"
                                    value="<?php echo htmlentities($row['email']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="<?php echo htmlentities($row['phone']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" name="mobile" 
                                    value="<?php echo htmlentities($row['mobile']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Designed By</label>
                                <input type="text" class="form-control" name="designed_by" 
                                    value="<?php echo htmlentities($row['designed_by']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Designed By URL</label>
                                <input type="text" class="form-control" name="designed_by_url" 
                                    value="<?php echo htmlentities($row['designed_by_url']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Developed By</label>
                                <input type="text" class="form-control" name="developed_by" 
                                    value="<?php echo htmlentities($row['developed_by']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Developed By URL</label>
                                <input type="text" class="form-control" name="developed_by_url" 
                                    value="<?php echo htmlentities($row['developed_by_url']); ?>">
                            </div>

                            <div class="form-group">
                                <label for="comment">Address</label>
                                <textarea class="form-control" rows="5"
                                    name="address"><?php echo htmlentities($row['address']); ?></textarea>
                            </div>
                           
                            <div class="form-group">
                                <label>Image</label>
                                <img src="../uploads/details-image/<?php echo htmlentities($row['image']); ?>" width="200"
                                    height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=details">Change Image</a>
                            </div>
                        <?php
                    } 
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-details" class="btn btn-primary">Edit Details</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}