<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['project-image-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-project-image'])) {
        $project_id = $_POST['project_id'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = 'project_images'.$_POST['project_id'].'_'.uniqid().'.'.$ext;
        $path = "../uploads/project_images-image/".$unique_image_name;
        move_uploaded_file($tmp_name, $path);
   
        $query = "INSERT INTO project_images(project_id,image) VALUES ('$project_id','$unique_image_name')";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['project-image-create-msg']="Project Image Section Added !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['project-image-create-msg']="There was an error while adding Project Image section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } 
?>

<?php  
    $pageTitle = 'Add Project Image Section';
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
                <h5 class="form-head">Add project-image</h5>
                <hr />
                <?php if ($_SESSION['project-image-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['project-image-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Project ID <small>(belong to project)</small></label>
                    <select name="project_id" class="form-select">
                        <?php
                            $query=mysqli_query($conn, "select id,title from projects order by title asc");
                            while ($row=mysqli_fetch_array($query)) {
                        ?>
                            <option value="<?php echo htmlentities($row['id']); ?>">
                                <?php echo htmlentities($row['title']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control-file border" name="image">
                </div>

                <hr />
                
                <div class="btns">
                    <button type="submit" name="add-project-image" class="btn btn-primary">Add Project Image Section</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}