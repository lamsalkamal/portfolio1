<section id="hobby">
	<div class="hobby-wrapper container">
		<span class="section-title">
			<h3>
				Hobby & Interests
			</h3>
			<small>Things I am interested in.....</small>
			<hr />
		</span>
		<div class="row hobby-container">
			<?php
			    $query=mysqli_query($conn, "select image from hobbies order by creationDate desc limit 4");
			    while ($row=mysqli_fetch_array($query)) {
			?>
				<div class="col-md-3 col-6 hobby-content">
					<span class="hobby-image-wrapper">
						<span class="hobby-image-container">
							<img src="uploads/hobbies-image/<?php echo htmlentities($row['image']); ?>" />
						</span>
					</span>
				</div>
			    <?php }
			?>
		</div>
	</div>
</section>