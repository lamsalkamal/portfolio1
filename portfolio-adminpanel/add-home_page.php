<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['home_page-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-home_page'])) {
        $name = $_POST['name'];
        $short_skill = $_POST['short_skill'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = 'home_page_'.uniqid().'.'.$ext;
        $path = "../uploads/home_page-image/".$unique_image_name;
        move_uploaded_file($tmp_name, $path);
   
        $query = "INSERT INTO home_page(name,short_skill,image) VALUES ('$name','$short_skill','$unique_image_name')";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['home_page-create-msg']="Home Page Section Added !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['home_page-create-msg']="There was an error while adding Home Page section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } 
?>

<?php  
    $pageTitle = 'Add Home Page Section';
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
                <h5 class="form-head">Add Home Page</h5>
                <hr />
                <?php if ($_SESSION['home_page-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['home_page-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Short Skill <small>e.g. animator</small></label>
                    <input type="text" class="form-control" name="short_skill">
                </div>

                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control-file border" name="image">
                </div>

                <hr />

                <div class="btns">
                    <button type="submit" name="add-home_page" class="btn btn-primary">Add Home Page Section</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}