<?php/*
	require_once("includes/sessions.php");
	require_once("includes/db_connect.php");
	require_once("includes/functions.php");
	include("includes/header.php");
?>

<?php
	if(!isset($_SESSION['id'])){
		redirect_to("login.php");
	}
?>

		<div class="content">
			<p>Välkommen <?php echo $_SESSION['first_name']; ?> till skyddad sida!</p>
			<p><a href="admin/manage.php">Admin manage</a></p
			<p><a href="logout.php">Logout</a></p>

		</div>
	
<?php
	include("includes/footer.php");*/
?>