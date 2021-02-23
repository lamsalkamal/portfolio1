<?php 
	session_start();
	error_reporting(0);
	include './function/config.php';
	
	if(basename($_SERVER['PHP_SELF']) == 'contact.php') { 
		include './includes/header.php';
		include './includes/navbar.php';
	} 

	if(isset($_POST['send-message'])) {
		$name = htmlspecialchars(stripslashes(trim($_POST['name'])));
		$email = htmlspecialchars(stripslashes(trim($_POST['email'])));
		$subject = htmlspecialchars(stripslashes(trim($_POST['subject'])));
    	$message = htmlspecialchars(stripslashes(trim($_POST['message'])));
		
		if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg = 'Please enter a valid email.';
				$msgClass = 'error-msg';
			} else {
				$toEmail = 'aroma.kamal@gmail.com';
				$subject = $subject;
				$body = '<p>'.$message.'</p>';

		        $headers = "From: " .$name. "<".$email.">" ."\r\n";
		        $headers .= "Reply-To: ". $email ."\r\n";
						$headers .= "MIME-Version: 1.0" ."\r\n";
		        $headers .= "Content-Type:text/html;charset=UTF-8" ."\r\n";
		        $headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP/" . phpversion() ."\r\n";

				if(mail($toEmail, $subject, $body, $headers)) {
					$msg = 'Message was sent successfully.';
					$msgClass = 'success-msg';
				} else {
					$msg = 'Message was not sent. Please try here: <a href=\'mailto:aroma.kamal@gmail.com\'>aroma.kamal@gmail.com</a>';
					$msgClass = 'error-msg';
				}
			}
		} else {
			$msg = 'Please fill all the fields.';
			$msgClass = 'error-msg';
		}
	}
?>
<section id="contact" style="background-image: url('assets/images/staticmap.jpg');">
	<div class="contact-section-overlay"></div>
	<div class="contact-wrapper">
		<div class="container contact-content-container">
			<span class="section-title">
				<h3>
					<a href="/contact" title="Contact Me">Contact</a>
				</h3>
				<small>Get in touch with me....</small>
				<hr />
			</span>
			<div class="row contact-container">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-6 contact-form-container">
							<?php if(!empty($msg)) { ?>
								<div class="contactFormCol-12">
									<div class="<?php echo $msgClass; ?>" style="color: #fff; font-weight: normal;">
										<?php echo $msg; ?>
									</div>
								</div>
							<?php } ?>
							<form action="/contact" method="POST">
								<div class="mb-2">
									<label for="name">Name</label>
			  						<input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
		                        </div>
		                        <div class="mb-2">
									<label for="subject">Subject</label>
			  						<input type="text" class="form-control" id="subject" name="subject" value="<?php echo isset($subject) ? $subject : ''; ?>">
		                        </div>
		                        <div class="mb-2">
									<label for="email">Email</label>
			  						<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
		                        </div>
		                        <div class="mb-2">
									<label for="message">Message</label>
			  						<textarea class="form-control" id="message" name="message">
			  							<?php echo isset($message) ? $message : ''; ?>
			  						</textarea>
		                        </div>
		                        <div class="d-flex justify-content-end">
		                        	<button type="submit" class="btn btn-primary px-4 mt-3 float-right" name="send-message">Send</button>
		                        </div>
		                    </form>
						</div>
						<div class="col-md-6">
							<div class="contact-detail-container">
								<?php if(isset($phoneData) || isset($mobileData)) { ?>
									<span>
										<strong>Phone</strong>
										<span><?php echo isset($phoneData) ? $phoneData : $mobileData; ?></span>
									</span>
								<?php } ?>
								<?php if(isset($emailData)) { ?>
									<span>
										<strong>Email</strong>
										<span><?php echo $emailData; ?></span>
									</span>
								<?php } ?>
								<?php if(isset($addressData) && $addressData != '') { ?>
									<span>
										<strong>Address</strong>
										<span><?php echo $addressData; ?></span>
									</span>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
	if(basename($_SERVER['PHP_SELF']) == 'contact.php') { 
		include './includes/footer.php';
	} 
?>