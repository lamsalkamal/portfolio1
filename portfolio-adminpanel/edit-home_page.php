<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['home_page-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-home_page'])) {
        $name = $_POST['name'];
        $short_skill = $_POST['short_skill'];
   
        $query = "UPDATE home_page SET name='$name',short_skill='$short_skill' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        if($sql) {
            $_SESSION['home_page-update-msg']="home_page Section Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } else {
            $_SESSION['home_page-update-msg']="There was an error while updating Home Page section !!";
            $_SESSION['msgclass']="error-msg"; 
        }
    } ?>

<?php   
    $pageTitle = 'Edit Home Page Section';
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
                <h5 class="form-head">Edit Home Page Section</h5>
                <hr />
                <?php if ($_SESSION['home_page-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['home_page-update-msg']); ?>
                </span>
                <?php } 
                    $query=mysqli_query($conn, "select * from home_page where id='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($query)) { ?>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo htmlentities($row['name']); ?>">
                            </div>

                            <div class="form-group">
                                <label>Short Skill</label>
                                <input class="form-control" name="short_skill" 
                                    value="<?php echo htmlentities($row['short_skill']); ?>">
                            </div>
                           
                            <div class="form-group">
                                <label>Image</label>
                                <img src="../uploads/home_page-image/<?php echo htmlentities($row['image']); ?>" width="200"
                                    height="100" alt="<?php echo htmlentities($row['image']); ?>"> 
                                <a href="change-image.php?id=<?php echo $row['id']; ?>&location=home_page">Change Image</a>
                            </div>
                        <?php 
                    } 
                ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-home_page" class="btn btn-primary">Edit Home Page</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}