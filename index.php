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
			<img class="logo_nav" src="images/photologo.png">
			<?php
				if(isset($_SESSION['id'])){
					echo "<a href=\"admin/logout.php\"><li>Logga ut</li></a>";
					echo "<a href=\"admin/structure.php\"><li>Portalen</li></a>";
				}
				else{
					echo "<a href=\"admin/login.php\"><li>Logga in</li></a>";
					echo "<a href=\"#register_content\" class=\"button_highlight\"><li>Anmäl</li></a>";
				}
			?>
			
		</ul>
		<div class="header_jumbotron">
			<div class="header_filter">
				<div class="header_box">
					<h1>Introduktion till Digital Fotografi</h1>
					<p>En kvällskurs för dig som vill lära dig grunderna i digital fotografi</p>
				</div>
			</div>
		</div>
		<div class="info_container">
			<div class="small_info_content" id="cont_margin_1">
				<div class="info_cont" class="cont_pad">
					<h3>EN KVÄLL, EN UPPGIFT!</h3>
					<p>Kursen kommer utspela sig en kväll i veckan 
						och varje vecka får du en uppgift där du ska ta 
						en bild som presenteras för läraren.</p>
				</div>
				<img class="img_cont" id="img_id_1" src="images/jamtland_2.jpg">
			</div>
			<div class="small_info_content" id="cont_margin_2">
				<img class="img_cont" id="img_id_2" src="images/grasklippare.jpg">
				<div class="info_cont" class="cont_pad">
					<h3>VAD LÄR DU DIG?</h3>
					<p>Du behöver ingen som helst tidigare kunskap om fotografering. 
						Kursen är mycket grundläggande och kommer ta upp begrepp som 
						slutartid, bländare, exponering. </p>
				</div>
			</div>
			<div class="small_info_content" id="cont_margin_3">
				<div class="info_cont">
					<h3>JAG ÄR KONRAD!</h3>
					<p>Det är jag Konrad Augustyniak som ansvarar för den här kursen.
					Fotografering har alltid legat mig varmt om hjärtat och 
					jag vill gärna dela med mig av det jag lärt mig genom åren. 
					Därför sätter jag upp den här kvällskursen! </p>
					<p>Jag har själv studerat fotografi på Berghs School of Communication och 
						studerar nu till fritidspedagog på Södertörns Högskola. 
						<p id="show_cv"><a href="#">Visa CV</a></p>
				</div>
				<img class="img_cont" id="img_id_3" src="images/jamtland.jpg">
			</div>
		</div>
		
		<div id="register_content">	       
		    <?php include(/*$path . */$file);?>
		</div>
	</div>
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>