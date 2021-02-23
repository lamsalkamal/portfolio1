<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['project_images-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-project_images'])) {
        $project_id = $_POST['project_id'];
   
        $query = "UPDATE project_images SET project_id='$project_id' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['project_images-update-msg']="Project Images Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['project_images-update-msg']="There was an error while updating project images section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Edit Project Images Section';
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
                <h5 class="form-head">Edit Project Images Section</h5>
                <hr />
                <?php if ($_SESSION['project_images-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['project_images-update-msg']); ?>
                </span>
                <?php } 
                    $query=mysqli_query($conn, "select * from project_images where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>
                            <div class="form-group">
                                <label>Project ID <small>(belong to project)</small></label>
                                <select name="project_id" class="form-select">
                                    <?php
                                        $projectQuery=mysqli_query($conn, "select id,title from projects order by title asc");
                                        while ($projectRow=mysqli_fetch_array($projectQuery)) {
                                            $projectID=htmlentities($projectRow['id']);
                                    ?>
                                        <option value="<?php echo $projectID; ?>" <?php echo htmlentities($row['project_id']) == $projectID ? 'selected' : ''; ?>>
                                            <?php echo htmlentities($projectRow['title']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                           
                            <div class="form-group">
                                <label for="text">Image</label>
                                <img src="../uploads/project_images-image/<?php echo htmlentities($row['image']); ?>" width="200"
                                    height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=project_images">Change Image</a>
                            </div>
                        <?php
                    }
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-project_images" class="btn btn-primary">Edit Project Images</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}