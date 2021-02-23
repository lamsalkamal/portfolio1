<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['skills-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-skills'])) {
        $title = $_POST['title'];
   
        $query = "UPDATE skills SET title='$title' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['skills-update-msg']="Skills Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['skills-update-msg']="There was an error while updating skills section !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Edit Skills Section';
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
                <h5 class="form-head">Edit Skills Section</h5>
                <hr />
                <?php if ($_SESSION['skills-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['skills-update-msg']); ?>
                </span>
                <?php } 
                    $query=mysqli_query($conn, "select * from skills where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>

                            <div class="form-group">
                                <label for="text">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="<?php echo htmlentities($row['title']); ?>">
                            </div>

                            <div class="form-group">
                                <label for="text">Image</label>
                                <img src="../uploads/skills-image/<?php echo htmlentities($row['image']); ?>" width="200"
                                    height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=skills">Change Image</a>
                            </div>
                        <?php
                    } 
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-skills" class="btn btn-primary">Edit Skill</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}