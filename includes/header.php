<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($pageTitle) ? 'Kamal Lamsal - '.$pageTitle : 'Kamal Lamsal'); ?></title>
	<meta charset="utf-8" />
    <link rel="icon" href="../assets/images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Krub&display=swap" rel="stylesheet" />
    <!-- icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css<?php filemtime('css/main.css'); ?>">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'details-fetch.php'; ?>