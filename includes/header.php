<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="stylesheets/normalize.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
	<title>Introduktion till digital fotografi</title>
</head>
<body>
	<div class="container">
		<ul class="top_nav">
			<?php
				if(isset($_SESSION['id'])){
					echo "<a href=\"logout.php\"><li>Logga ut</li></a>";
					echo "<a href=\"../index.php\"><li>Startsida</li></a>";
				}
				else{
					echo "<a href=\"login.php\"><li>Logga in</li></a>";
				}
			?>
			
		</ul>
		<div class="main_content">