<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['social_media-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-social_media'])) {
        $name = $_POST['name'];
        $url = $_POST['url'];
   
        $query = "UPDATE social_media SET name='$name',url='$url' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['social_media-update-msg']="Social Media Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['social_media-update-msg']="There was an error while updating social media section !!";
            $_SESSION['msgclass']="error-msg"; 
        }
    } 
?>

<?php   
    $pageTitle = 'Edit Social Media Section';
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
                <h5 class="form-head">Edit Social Media Section</h5>
                <hr />
                <?php if ($_SESSION['social_media-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['social_media-update-msg']); ?>
                </span>
                <?php } 
                    $query=mysqli_query($conn, "select * from social_media where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>

                            <div class="form-group">
                                <label for="text">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo htmlentities($row['name']); ?>">
                            </div>

                            <div class="form-group">
                                <label for="text">URL</label>
                                <input type="text" class="form-control" name="url"
                                    value="<?php echo htmlentities($row['url']); ?>">
                            </div>
                           
                            <div class="form-group">
                                <label for="text">Image</label>
                                <img src="../uploads/social_media-image/<?php echo htmlentities($row['image']); ?>" width="200" height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=social_media">Change Image</a>
                            </div>
                        <?php
                    } 
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-social_media" class="btn btn-primary">Edit Social Media</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}