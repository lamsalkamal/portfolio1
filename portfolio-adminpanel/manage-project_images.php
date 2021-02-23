<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['delmsg']="";
    $_SESSION['msgclass']="";
    if (isset($_GET['del'])) {
        $delQuery = mysqli_query($conn, "delete from project_images where id = '".$_GET['id']."'");
        if ($delQuery) {
            echo "<script>document.location = 'manage-project_images.php';</script>";
            $_SESSION['delmsg']="Project Images deleted !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Manage Project Images Section';
    include './includes/header.php';
    include '../includes/navbar.php'; 
?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <h5 class="form-head">Manage Project Images</h5>
            <hr />
            <div class="manage-job">
                <?php if ($_SESSION['delmsg']) { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                </span>
                <?php } ?>

                <table cellpadding="0" cellspacing="0" border="0"
                    class="datatable-1 table table-bordered table-striped table-responsive-md display" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $query=mysqli_query($conn, "select * from project_images order by project_id asc");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo htmlentities($cnt); ?>
                                </td>
                                <?php 
                                    $projectQuery=mysqli_query($conn, "select title from projects where id=".$row['project_id']."");
                                    while ($projectRow=mysqli_fetch_array($projectQuery)) {
                                ?>
                                    <td><?php echo htmlentities($projectRow['title']); ?>
                                    </td>
                                <?php } ?>
                                <td><img src="../uploads/project_images-image/<?php echo htmlentities($row['image']); ?>"
                                        class="file-logo" alt="<?php echo htmlentities($row['image']); ?>" />
                                </td>
                                <td>
                                    <a href="edit-project_images.php?id=<?php echo $row['id']?>&location=project_images"><i class="fa fa-edit"></i></a>
                                    <a href="manage-project_images.php?id=<?php echo $row['id']?>&del=delete"
                                        onClick="return confirm('Are you sure you want to delete?')"><i
                                            class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                        <?php $cnt=$cnt+1; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}