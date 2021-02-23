<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['social_media-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-social_media'])) {
        $name = $_POST['name'];
        $url = $_POST['url'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = 'social_media_'.uniqid().'.'.$ext;
        $path = "../uploads/social_media-image/".$unique_image_name;
        move_uploaded_file($tmp_name, $path);
   
        $query = "INSERT INTO social_media(name,url,image) VALUES ('$name','$url','$unique_image_name')";
        $sql=mysqli_query($conn, $query);

        if($sql) {
            $_SESSION['social_media-create-msg']="Social Media Section Added !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['social_media-create-msg']="There was an error while adding social media section !!";
            $_SESSION['msgclass']="error-msg";
        }
    }
?>

<?php  
    $pageTitle = 'Add Social Media Section';
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
                <h5 class="form-head">Add Social Media</h5>
                <hr />
                <?php if ($_SESSION['social_media-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['social_media-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url">
                </div>

                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control-file border" name="image">
                </div>

                <hr />

                <div class="btns">
                    <button type="submit" name="add-social_media" class="btn btn-primary">Add Social Media Section</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
} ?>