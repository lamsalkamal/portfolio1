<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['project-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-project'])) {
        $title = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $highlighted = $_POST['highlighted'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = 'projects_'.uniqid().'.'.$ext;
        $path = "../uploads/projects-image/".$unique_image_name;
        move_uploaded_file($tmp_name, $path);
        $project_url = $_POST['project_url'];
   
        $query = "INSERT INTO projects(title,sub_title,image,highlighted,project_url,updationDate) VALUES ('$title','$sub_title','$unique_image_name','$highlighted','$project_url')";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['project-create-msg']="Project Section Added !!";
            $_SESSION['msgclass']="success-msg";
        }else {
            $_SESSION['project-create-msg']="There was an error while adding project section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } 
?>

<?php  
    $pageTitle = 'Add Project Section';
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
                <h5 class="form-head">Add Project</h5>
                <hr />
                <?php if ($_SESSION['project-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['project-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="form-group">
                    <label>Project URL</label>
                    <input type="text" class="form-control" name="project_url">
                </div>

                <div class="form-group">
                    <label>Sub Title</label>
                    <input type="text" class="form-control" name="sub_title">
                </div>

                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control-file border" name="image">
                </div>

                <div class="form-group">
                    <label>Choose if project on front or not</label>
                    <select name="highlighted" class="form-select">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>

                <hr />

                <div class="btns">
                    <button type="submit" name="add-project" class="btn btn-primary">Add Project</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}