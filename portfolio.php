<?php 
	session_start();
	error_reporting(0);
	include './function/config.php';
	
	$selectQuery = "select * from projects where highlighted=1 order by creationDate desc limit 3";

	if(basename($_SERVER['PHP_SELF']) == 'portfolio.php') { 
		include './includes/header.php';
		include './includes/navbar.php';

		$selectQuery = "select * from projects order by creationDate desc";
	} 
?>
<section id="portfolio">
	<div class="project-wrapper container">
		<span class="section-title">
			<h3>
				<a href="/portfolio" title="More Portfolio">Portfolio</a>
			</h3>
			<small>Works I have done so far....</small>
			<hr />
		</span>
		<div class="row">
			<?php
			    $query=mysqli_query($conn, $selectQuery);
			    while ($row=mysqli_fetch_array($query)) {
			?>
				<div class="col-lg-4 col-md-4 col-sm-12 project-list-wrapper" 
					onclick="redirectToSelf('portfolio-gallery.php?portfolio_id=<?php echo htmlentities($row['id']); ?>&name=<?php echo htmlentities($row['title']); ?>');">
					<div class="project-list">
						<span class="project-title-wrapper">
							<span class="project-title-sub-wrapper">
								<h5 class="project-title">
									<?php echo htmlentities($row['title']); ?>
								</h5>
								<span class="project-sub-title">
									<?php echo htmlentities($row['sub_title']); ?>
								</span>
							</span>
						</span>
						<div class="project-body">
							<img src="uploads/projects-image/<?php echo htmlentities($row['image']); ?>" 
								alt="<?php echo htmlentities($row['sub_title']); ?>" />
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php
	if(basename($_SERVER['PHP_SELF']) == 'portfolio.php') { 
		include './includes/footer.php';
	}
?>