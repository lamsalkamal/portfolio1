<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['delmsg']="";
    $_SESSION['msgclass']="";
    if (isset($_GET['del'])) {
        $delQuery = mysqli_query($conn, "delete from hobbies where id = '".$_GET['id']."'");
        if ($delQuery) {
            echo "<script>document.location = 'manage-hobbies.php';</script>";
            $_SESSION['delmsg']="Hobbies deleted !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Manage Hobbies Section';
    include './includes/header.php';
    include '../includes/navbar.php'; 
?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <h5 class="form-head">Manage Hobbies</h5>
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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Hobby Creation Date</th>
                            <th>Last Updated Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $query=mysqli_query($conn, "select * from hobbies");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo htmlentities($cnt); ?>
                                </td>
                                <td><?php echo htmlentities($row['title']); ?>
                                </td>
                                <td><img src="../uploads/hobbies-image/<?php echo htmlentities($row['image']); ?>"
                                        class="file-logo" alt="<?php echo htmlentities($row['image']); ?>" />
                                </td>
                                <td> <?php echo htmlentities($row['creationDate']); ?>
                                </td>
                                <td><?php echo htmlentities($row['updationDate']); ?>
                                </td>
                                <td>
                                    <a href="edit-hobbies.php?id=<?php echo $row['id']?>&location=hobbies"><i class="fa fa-edit"></i></a>
                                    <a href="manage-hobbies.php?id=<?php echo $row['id']?>&del=delete"
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