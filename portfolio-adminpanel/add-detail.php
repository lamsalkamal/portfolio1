<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-m-d h:i:s', time());
    $_SESSION['detail-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-detail'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $designed_by = $_POST['designed_by'];
        $designed_by_url = $_POST['designed_by_url'];
        $developed_by = $_POST['developed_by'];
        $developed_by_url = $_POST['developed_by_url'];

        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = 'details_'.uniqid().'.'.$ext;
        $path = "../uploads/details-image/".$unique_image_name;
        move_uploaded_file($tmp_name, $path);

        $query = "INSERT INTO details(email,phone,mobile,address,designed_by,designed_by_url,developed_by,developed_by_url,image,updationDate) VALUES ('$email','$phone','$mobile','$address','$designed_by','$designed_by_url','$developed_by','$developed_by_url','$unique_image_name','$currentTime')";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['detail-create-msg']="Detail Section Added !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['detail-create-msg']="There was an error while adding detail section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } 
?>

<?php  
    $pageTitle = 'Add Detail Section';
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
                <h5 class="form-head">Add Details</h5>
                <hr />
                <?php if ($_SESSION['detail-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['detail-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>

                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" name="mobile">
                </div>

                <div class="form-group">
                    <label>Designed By</label>
                    <input type="text" class="form-control" name="designed_by">
                </div>

                <div class="form-group">
                    <label>Designed By URL</label>
                    <input type="text" class="form-control" name="designed_by_url">
                </div>

                <div class="form-group">
                    <label>Developed By</label>
                    <input type="text" class="form-control" name="developed_by">
                </div>

                <div class="form-group">
                    <label>Developed By URL</label>
                    <input type="text" class="form-control" name="developed_by_url">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" rows="5" name="address"></textarea>
                </div>

                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control-file border" name="image">
                </div>

                <hr />
                
                <div class="btns">
                    <button type="submit" name="add-detail" class="btn btn-primary">Add Detail</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}