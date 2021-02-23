<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['about-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-about'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = 'about_'.uniqid().'.'.$ext;
        $path = "../uploads/about-image/".$unique_image_name;
        move_uploaded_file($tmp_name, $path);
   
        $query = "INSERT INTO about(title,description,image,updationDate) VALUES ('$title','$description','$unique_image_name','$currentTime')";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['about-create-msg']="About Section Added !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['about-create-msg']="There was an error while adding about section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } 
?>

<?php  
    $pageTitle = 'Add About Section';
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
                <h5 class="form-head">Add About</h5>
                <hr />
                <?php if ($_SESSION['about-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['about-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="5" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control-file border" name="image">
                </div>

                <hr />

                <div class="btns">
                    <button type="submit" name="add-about" class="btn btn-primary">Add About Section</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}