<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['about-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-about'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
   
        $query = "UPDATE about SET title='$title',description='$description',updationDate='$currentTime' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['about-update-msg']="About Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['about-update-msg']="There was an error while updating about section !!";
            $_SESSION['msgclass']="error-msg"; 
        }
    } ?>

<?php   
    $pageTitle = 'Edit About Section';
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
                <h5 class="form-head">Edit About Section</h5>
                <hr />
                <?php if ($_SESSION['about-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['about-update-msg']); ?>
                </span>
                <?php } 
                    $query=mysqli_query($conn, "select * from about where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="<?php echo htmlentities($row['title']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5"
                                    name="description"><?php echo htmlentities($row['description']); ?></textarea>
                            </div>
                           
                            <div class="form-group">
                                <label>Image</label>
                                <img src="../uploads/about-image/<?php echo htmlentities($row['image']); ?>" width="200"
                                    height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=about">Change Image</a>
                            </div>
                        <?php 
                    } 
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-about" class="btn btn-primary">Edit About</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}