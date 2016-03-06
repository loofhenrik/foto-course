<?php
	require_once('includes/sessions.php');
	require_once('includes/db_connect.php');
	require_once('includes/functions.php');

	$p = null;

	if(isset($_GET['p'])){
	    $p = $_GET['p'];
	}

	//$path = 'admin/';
	$file = 'show_classes.php';

	if($p == "register_student"){
	    $file = "register_student.php";
	}

	else if($p == "complete_register"){
	    $file = "complete_register.php";
	}
?>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="stylesheets/normalize.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
	<title>Introduktion till Digital Fotografi</title>
</head>
<body>
	<div class="container">
		<ul class="top_nav">
			<?php
				if(isset($_SESSION['id'])){
					echo "<a href=\"logout.php\"><li>Logga ut</li></a>";
				}
				else{
					echo "<a href=\"login.php\"><li>Logga in</li></a>";
				}
			?>
			
			<a href="#register_content"><li>Anmäl</li></a>
		</ul>
		<div class="header">
			<div class="header_filter">
				<div class="header_box">
					<h1>Introduktion till Digital Fotografi</h1>
					<p>En kvällskurs för dig som vill lära dig grunderna i fotografi</p>
				</div>
			</div>
		</div>
		<div class="small_info_content">
			<div class="info_cont">
				<h3>Vad lär du dig?</h3>
				<p>För den här kursen behöver du ingen som helst kunskap tidigare om fotografering. 
					Vi kommer gå igenom slutartid, bländare, exponering. Lorem ipsum och så vidare...</p>
			</div>
			<div class="info_cont">
				<h2>Din lärare!</h2>
				<p>Ansvarig för den här kursen är jag Konrad Augustyniak! 
				Fotografering har alltid legat mig varmt om hjärtat och jag vill gärna dela med mig av det jag lärt mig genom åren. 
				Därför sätter jag upp den här kvällskursen! </p>
			</div>
		</div>
		
		<div id="register_content">	       
		    <?php include(/*$path . */$file);?>
		</div>
	</div>
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>