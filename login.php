<?php
	require_once("includes/sessions.php");
	require_once("includes/db_connect.php");
	require_once("includes/functions.php");
?>

<?php
	if(isset($_SESSION['id'])){
			redirect_to("admin/structure.php");
	}
?>

<?php

	//Start Form Processing

	$msg = "";

	if (isset($_POST['submit'])) {
		//form has been submitted
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		//check db to see if username / password exist
		try{
			$query = "SELECT * ";
			$query .= "FROM student_users ";
			$query .= "WHERE email = :email ";
			
			$ps = $db->prepare($query);
			$ps->bindvalue('email', $email);
			$ps->execute();

			$checkUser = $ps->fetch(PDO::FETCH_ASSOC);

			var_dump($checkUser);
			var_dump($password);

			if($checkUser){
				if($password == $checkUser['hashed_password']){
					$_SESSION['first_name'] = $checkUser['first_name'];
					$_SESSION['id'] = $checkUser['id'];

					redirect_to("admin/structure.php");
				}
				else{
					$msg = "Fel inloggningsuppgifter. Gör om, gör rätt!";
				}
			}
			else{
				$msg = "Användarnamn eller Lösenord är felaktigt!";
			}
		}
		catch(Exception $e){
			echo "Oj, fel!";
		}
	}
	

	else{
		//firm has not been submitted
		if(isset($_GET['logout']) && $_GET['logout'] == 1){
			$msg = "Du är utloggad!";
		}
		$email = "";
		$password = "";
	}
?>

<?php
	include("includes/header.php");
?>

		<div class="content">
			<a href="index.php">Startsida</a>
			<table>
				<tr>
					<td class="main">
						<h2>Logga in</h2>

						<?php 
							if(!empty($message)){
								echo "<p class=\"message\">" . $message . "</p>";
							} 
						?>
						<?php 
							if(!empty($errors)){ 
								display_errors($errors);
							} 
						?>

						<form action="login.php" method="post">
							<table>
								<tr>
									<td>E-mail</td>
									<td><input type="text" name="email" maxlength="30"></td>
								</tr>
								<tr>
									<td>Lösenord</td>
									<td><input type="text" name="password" maxlength="30"></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Logga in"></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</div>
		
<?php
	include("includes/footer.php");
?>