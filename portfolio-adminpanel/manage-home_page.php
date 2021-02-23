<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['delmsg']="";
    $_SESSION['msgclass']="";
    if (isset($_GET['del'])) {
        $delQuery = mysqli_query($conn, "delete from home_page where id = '".$_GET['id']."'");
        if ($delQuery) {
            echo "<script>document.location = 'manage-home_page.php';</script>";
            $_SESSION['delmsg']="Home Page deleted !!";
            $_SESSION['msgclass']="error-msg";
        }
    } ?>

<?php   
    $pageTitle = 'Manage Home Page Section';
    include './includes/header.php';
    include '../includes/navbar.php'; 
?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <h5 class="form-head">Manage Home Page</h5>
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
                            <th>Name</th>
                            <th>Short Skill</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $query=mysqli_query($conn, "select * from home_page");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo htmlentities($cnt); ?>
                                </td>
                                <td><?php echo htmlentities($row['name']); ?>
                                </td>
                                <td><?php echo htmlentities($row['short_skill']); ?>
                                </td>
                                <td><img src="../uploads/home_page-image/<?php echo htmlentities($row['image']); ?>"
                                        class="file-logo" alt="<?php echo htmlentities($row['image']); ?>" />
                                </td>
                                <td>
                                    <a href="edit-home_page.php?id=<?php echo $row['id']?>&location=home_page"><i class="fa fa-edit"></i></a>
                                    <a href="manage-home_page.php?id=<?php echo $row['id']?>&del=delete"
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