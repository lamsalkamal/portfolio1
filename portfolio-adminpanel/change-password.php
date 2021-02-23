<?php
session_start();
include '../function/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['msgclass'] = "";
    $_SESSION['password-change-msg']="";

    if (isset($_POST['change-password'])) {
        $sql=mysqli_query($conn, "SELECT password FROM  admin where password='".md5($_POST['password'])."' && username='".$_SESSION['alogin']."'");
        $num=mysqli_fetch_array($sql);
        if ($num>0) {
            $conn=mysqli_query($conn, "update admin set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where username='".$_SESSION['alogin']."'");
            $_SESSION['msgclass'] = "success-msg";
            $_SESSION['password-change-msg']="Password Changed Successfully !!";
        } else {
            $_SESSION['msgclass'] = "error-msg";
            $_SESSION['password-change-msg']="Old Password not match !!";
        }
    } ?>
<?php 
    $pageTitle = 'Change Password';
    include './includes/header.php';  
    include '../includes/navbar.php'; 
?>

<div class="container body-section">
    <div class="admin-panel admin-login">
        <div class="row">
            <div class="sidebar-col col-md-3">
                <?php include 'sidebar.php'; ?>
            </div>
            <div class="next-col col-md-9">
                <form name="chngpwd" method="post" onSubmit="return valid();" class="change-password-form">
                    <h5 class="form-head">Admin Password Change</h5>
                    <hr />
                    <?php if ($_SESSION['password-change-msg'] != '') { ?>
                    <span class=<?php echo $_SESSION['msgclass']; ?>>
                        <?php echo htmlentities($_SESSION['password-change-msg']); ?>
                    </span>
                    <?php } ?>
                    <div class="form-group">
                        <label for="current-pwd">Current Password</label>
                        <input type="password" class="form-control" id="current-pwd" name="password">
                    </div>
                    <div class="form-group">
                        <label for="new-pwd">New Password</label>
                        <input type="password" class="form-control" id="new-pwd" name="newpassword">
                    </div>
                    <div class="form-group">
                        <label for="confirm-pwd">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm-pwd" name="confirmpassword">
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-primary" name="change-password">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.php';
}