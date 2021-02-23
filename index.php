<?php 
	session_start();
	error_reporting(0);
	include './function/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<section id="home">
	<div class="image-container" style="background-image: url('uploads/home_page-image/<?php echo htmlentities($homeImage); ?>');">
		<div class="image-overlay"></div>
		<div class="image-content-container">
			<img src="uploads/home_page-image/<?php echo htmlentities($homeImage); ?>" class="image-small" alt="home-image-small" />
			<div class="image-content">
				<h1 class="text-uppercase font-weight-bold text-light"><?php echo htmlentities($homeName); ?></h1>
				<h3 class="text-light text-capitalize"><?php echo htmlentities($homeSkill); ?></h3>
				<span class="d-inline-block mt-3">
					<a class="btn button btn-cv" href="assets/cv/Kamal_lamsal_resume.pdf" download="Kamal_lamsal_resume">Download CV</a>
					<button class="btn button btn-hireme" onclick="redirectToSelf('/contact')">Hire Me</button>
				</span>
			</div>
		</div>
	</div>
</section>

<?php 
	include 'portfolio.php';
	include 'skill.php';
	include 'about.php';
	include 'hobby.php'; 
	include 'contact.php';
?>
<?php
	include '/includes/footer.php';
?>