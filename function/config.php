<?php
	// define('DB_SERVER', 'phileoproductionstudio.com');
	// define('DB_USER', 'iww4pw6bd59h');
	// define('DB_PASS', '123Nexus#@!');
	// define('DB_NAME', 'i6357113_wp2');
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'portfolio');
	$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	// Check connection
	if (mysqli_connect_errno()) {
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}