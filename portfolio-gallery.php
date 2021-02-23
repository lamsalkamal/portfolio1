<?php 
	session_start();
	error_reporting(0);
	include './function/config.php';
	include './includes/header.php';
	include './includes/navbar.php';

	$pid = intval($_GET['portfolio_id']);
	$pname = $_GET['name'];

	if(!isset($pid)) {
		header('location:index.php');
	}
?>
<section id="portfolio-gallery">
	<div class="portfolio-gallery-wrapper container">
		<span class="section-title">
			<h3>
				Gallery <?php echo $pname ? 'for '.htmlentities($pname) : '' ; ?>
			</h3>
			<small>
				<?php
					$prev_pid = $pid <= 1 ? $pid : $pid-1;
				    $query=mysqli_query($conn, "select id,title from projects where id='$prev_pid'");
					while ($row=mysqli_fetch_array($query)) {
				?>
					<a href="portfolio-gallery.php?portfolio_id=<?php echo htmlentities($prev_pid); ?>&name=<?php echo htmlentities($row['title']); ?>" title="Previous Portfolio">
						<i class="fa fa-arrow-left"></i>
					</a>
				<?php } ?>
				&ensp;
				(click on image to view in full-size) 
				&ensp;
				<?php
					$allPortfolios=mysqli_query($conn, "select id,title from projects");
				    $count=mysqli_num_rows($allPortfolios);
				    $next_pid = $pid < $count ? $pid+1 : $pid;
				    $query=mysqli_query($conn, "select id,title from projects where id='$next_pid'");
					while ($row=mysqli_fetch_array($query)) {
				?>
					<a href="portfolio-gallery.php?portfolio_id=<?php echo htmlentities($next_pid); ?>&name=<?php echo htmlentities($row['title']); ?>" title="Next Portfolio">
						<i class="fa fa-arrow-right"></i>
					</a> 
				<?php } ?>
			</small>
			<hr />
		</span>
		<div class="row">
			<?php
			    $query=mysqli_query($conn, "select * from project_images where project_id='$pid'");
			    $count=mysqli_num_rows($query);
			    if($count>0) {
				while ($row=mysqli_fetch_array($query)) {
			?>
				<div class="col-md-6 portfolio-gallery-image" 
					onclick="redirectTo('uploads/project_images-image/<?php echo htmlentities($row['image']); ?>');">
					<img src="uploads/project_images-image/<?php echo htmlentities($row['image']); ?>" 
							alt="project<?php echo htmlentities($id); ?>mage" />
				</div>
			<?php } } else { ?>
				<h1 class="text-center text-danger font-bolder">
					The Gallery is empty for <?php echo $pname ? htmlentities($pname) : 'this'; ?> project.
				</h1>
				<a href="portfolio.php" class="mt-3" title="Portfolio page">Back to main Portfolio page</a>
			<?php } ?>
		</div>
	</div>
</section>
<?php
	include './includes/footer.php';
?>