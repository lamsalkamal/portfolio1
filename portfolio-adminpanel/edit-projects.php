<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['projects-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-projects'])) {
        $title = $_POST['title'];
        $project_url = $_POST['project_url'];
        $sub_title = $_POST['sub_title'];
        $highlighted = $_POST['highlighted'];
   
        $query = "UPDATE projects SET title='$title', project_url='$project_url', sub_title='$sub_title', highlighted='$highlighted' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['projects-update-msg']="Projects Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['projects-update-msg']="There was an error while updating projects section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Edit Projects Section';
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
                <h5 class="form-head">Edit Projects Section</h5>
                <hr />
                <?php if ($_SESSION['projects-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['projects-update-msg']); ?>
                </span>
                <?php } 
                    $query=mysqli_query($conn, "select * from projects where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>

                            <div class="form-group">
                                <label for="text">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="<?php echo htmlentities($row['title']); ?>">
                            </div>

                            <div class="form-group">
                                <label for="comment">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title"
                                    value="<?php echo htmlentities($row['sub_title']); ?>">
                            </div>

                            <div class="form-group">
                                <label for="text">Project URL</label>
                                <input type="text" class="form-control" name="project_url"
                                    value="<?php echo htmlentities($row['project_url']); ?>">
                            </div>
                           
                            <div class="form-group">
                                <label for="text">Image</label>
                                <img src="../uploads/projects-image/<?php echo htmlentities($row['image']); ?>" width="200"
                                    height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=projects">Change Image</a>
                            </div>

                            <div class="form-group">
                                <label>Choose if project on front or not</label>
                                <select name="highlighted" class="form-select">
                                    <option value="0" <?php echo htmlentities($row['highlighted']) == 0 ? 'selected' : ''; ?>>Inactive</option>
                                    <option value="1" <?php echo htmlentities($row['highlighted']) == 1 ? 'selected' : ''; ?>>Active</option>
                                </select>
                            </div>
                        <?php
                    }
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-projects" class="btn btn-primary">Edit Projects</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}