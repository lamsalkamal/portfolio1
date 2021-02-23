<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $pid=intval($_GET['id']);
    $_SESSION['image-msg']="";
    $_SESSION['msgclass']="";
    $query=mysqli_query($conn, "select image from ".$_GET['location']." where id='$pid'");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        $imageName = htmlentities($row['image']);
        if (isset($_POST['change-image'])) {
            $image=$_FILES["image"]["name"];
            $dir="../uploads/".$_GET['location']."-image/";
            unlink($dir.$row["image"]);

            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $unique_image_name = $_GET['location'].'_'.uniqid().'.'.$ext;

            move_uploaded_file($_FILES["image"]["tmp_name"], $dir.$unique_image_name);
            $sql=mysqli_query($conn, "update ".$_GET['location']." set image='$unique_image_name' where id='$pid' ");
            $_SESSION['image-msg']="Image Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } 
    ?>

<?php 
    $pageTitle = 'Change Image of'.$_GET['location'].' Section';
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
                <h5 class="form-head">Update Image of <?php echo $_GET['location']; ?> section</h5>
                <hr />
                <?php if ($_SESSION['image-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['image-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Image</label>
                    <div>
                        <img src="../uploads/<?php echo htmlentities($_GET['location']); ?>-image/<?php echo $imageName; ?>" width="200"
                            height="100">
                    </div>
                </div>
                <div class="form-group">
                    <label>Choose New Logo</label>
                    <input type="file" class="form-control-file border" name="image" required>
                </div>
                <?php
    } ?>
                <div class="modal-footer">
                    <button type="submit" name="change-image" class="btn btn-primary">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}