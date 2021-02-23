<?php 
	session_start();
	error_reporting(0);
	include './function/config.php';
?>
<section id="skill">
	<div class="skill-wrapper container">
		<span class="section-title">
			<h3>
				Professional Skills
			</h3>
			<small>Skills I have.....</small>
			<hr />
		</span>
		<div class="row skill-container">
			<?php
			    $query=mysqli_query($conn, "select title,image from skills order by creationDate desc limit 4");
			    while ($row=mysqli_fetch_array($query)) {
			?>
				<div class="col-md-3 col-6">
					<div class="skill-content">
						<span class="skill-image-wrapper">
							<span class="skill-image-container">
								<img src="uploads/skills-image/<?php echo htmlentities($row['image']); ?>" />
							</span>
						</span>
					</div>
					<p>
						<?php echo htmlentities($row['title']); ?>
					</p>
				</div>
			    <?php }
			?>
		</div>
	</div>
</section>