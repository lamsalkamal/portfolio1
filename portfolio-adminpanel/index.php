<?php
session_start();
error_reporting(0);
include '../function/config.php';

$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    
if (strlen($_SESSION['alogin'])!=0) {
    header("location:http://$host$uri/change-password.php");
}
if (isset($_POST['login'])) {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $ret=mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' and password='$password'");
    $num=mysqli_fetch_array($ret);
    $_SESSION['errmsg']="";
    if ($num>0) {
        $extra="change-password.php";//
        $_SESSION['alogin']=$_POST['username'];
        $_SESSION['id']=$num['id'];
        header("location:http://$host$uri/$extra");
        exit();
    } else {
        $_SESSION['errmsg']="Invalid username or password";
        $extra="index.php";
        header("location:http://$host$uri/$extra");
        exit();
    }
}
?>

<?php 
    $pageTitle = 'Portfolio Admin Panel';
    include './includes/header.php'; 
    include '../includes/navbar.php';
?>

<div class="container body-section">
    <?php include 'login.php'; ?>
</div>

<?php include '../includes/footer.php';