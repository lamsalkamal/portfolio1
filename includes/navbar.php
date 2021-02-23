<!-- <div class="logo-container">
  Logo
</div> -->
<?php 
  $logoDir = 'uploads';
  if(basename(getcwd()) == 'portfolio-adminpanel') {
    $logoDir = '../uploads';
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="<?php echo $logoDir; ?>/details-image/<?php echo htmlentities($imageData); ?>" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <?php if(!isset($_SESSION['alogin']) || strlen($_SESSION['alogin'])==0 || basename(getcwd()) != 'portfolio-adminpanel') { ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/portfolio">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact">Contact</a>
          </li>
        <?php } else { ?> 
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/">Visit Website</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-universal-access"></i> Admin
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="change-password.php">Change Password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="logout.php">Logout</a>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>