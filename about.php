<?php 
	session_start();
	error_reporting(0);
	include './function/config.php';
	
	if(basename($_SERVER['PHP_SELF']) == 'about.php') { 
		include './includes/header.php';
		include './includes/navbar.php';
	} 
?>
<section id="about">
	<?php
	    $query=mysqli_query($conn, "select * from about order by creationDate desc limit 1");
	    while ($row=mysqli_fetch_array($query)) {
	?>
		<div class="about-wrapper" style="background-image: url('uploads/about-image/<?php echo htmlentities($row['image']); ?>');">
			<div class="about-overlay"></div>
			<div class="container about-content-container">
				<span class="section-title">
					<h3>
						<a href="/about" title="More About Me">About</a>
					</h3>
					<small>Few things about me....</small>
					<hr />
				</span>
				<div class="row about-container">
					<div class="col-md-4 about-image-container">
						<img src="uploads/about-image/<?php echo htmlentities($row['image']); ?>" alt="about-image" />
					</div>
					<div class="col-md-8">
						<div class="about-detail-container">
							<p class="about-detail-content">
								<?php echo $row['description']; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</section>

<?php 
	if(basename($_SERVER['PHP_SELF']) == 'about.php') { 
		include './includes/footer.php';
	} 
?>