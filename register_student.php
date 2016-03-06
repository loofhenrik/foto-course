<?php
	require_once("includes/sessions.php");
	require_once("includes/db_connect.php");
	require_once("includes/functions.php");
?>


<?php
	if(isset($_GET['classid']) && is_numeric($_GET['classid'])){
		$firstname = $lastname = $email = $password = $confirm_password = "";
		$error = $msg = "";

		if(isset($_POST['submit'])){

			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			$confirm_password = trim($_POST['confirm_password']);

			if(!preg_match("/^[A-Za-z]*$/", $firstname))	{
			  $error .= "<li>Förnamnet får endast innehålla bokstäver</li>";
		  }
		  if(!preg_match("/^[A-Za-z]*$/", $lastname))	{
			  $error .= "<li>Efternamnet får endast innehålla bokstäver</li>";
		  }
		  if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $error .= "<li>Ogiltig e-post adress</li>";
		  }
		  if(empty($firstname)){
			  $error .= "<li>Förnamn är obligatoriskt</li>";
		  }
		  if(empty($lastname)){
			  $error .= "<li>Efternamn är obligatoriskt</li>";
		  }
		  if(empty($email)){
			  $error .= "<li>E-post adress är obligatoriskt</li>";
		  }
		  if(empty($password)){
			  $error .= "<li>Lösenord är obligatoriskt</li>";
		  }
		  if(!empty($password) && strlen($password) < 6) {
			  $error .= "<li>Lösenordet får inte vara mindre än sex tecken lång</li>";
		  }
		  if($confirm_password != $password) {
			  $error .= "<li>Det upprepade lösenordet matchar inte</li>"; 
		  }

		  try{
		    $query  = "SELECT * ";
				$query .= "FROM student_users ";
				$query .= "WHERE email = :email";
				  
				$ps = $db->prepare($query);
				$ps->bindValue('email', $email);
				$ps->execute();
				$checkUser = $ps->fetch(PDO::FETCH_ASSOC);
			} 
		  catch (Exception $e) {
	      //Error meddelande
	      echo "Oj då. Ett fel har inträffat som vi måste hantera. Tack för ditt tålamod!<br>";
	      //echo $e->getMessage(). "<br><br>";
		  }

		  if($checkUser){
		  	$error .= "<li>Emailadressen är redan tagen. Var snäll och välj en ny</li>"; 
		  }

		  $msg = "<ul style='padding-left: 15px; '>" . $error . "</ul>";

		  //----------------

			if(empty($error)){
				try{
					$query = "INSERT INTO student_users (first_name, last_name, email, hashed_password, class_id) ";
					$query .= "VALUES (:firstname, :lastname, :email, :password, :class_id)";

					$ps = $db->prepare($query); //Prepared statement
		     	$ps->bindValue('firstname', $firstname); //Binds the value to placeholder
			    $ps->bindValue('lastname', $lastname);
			    //Binds the value to placeholder
			    $ps->bindValue('email', $email);
			     //Binds the value to placeholder
			    $ps->bindValue('password', $password);  //Binds the value to placeholder
			    $ps->bindValue('class_id', $_GET['classid']);
			     //Binds the value to placeholder
			    $result = $ps->execute();	//Executes the query. Returns true or false.

					if($result){
						$msg = "Användare skapad!";
						$firstname = "";
						$lastname = "";
						$email = "";
						$password = "";
						$confirm_password = "";
					}
					else{
						$msg = "Fel vid registrering";
					}
				}
				catch(Exception $e){
					echo "Oj då. Ett fel har inträffat som vi måste hantera. Tack för ditt tålamod!<br>";
	        //echo $e->getMessage(). "<br><br>";
				}
			}
		}
	}
	else{
		redirect_to("show_classes.php");
	}
?>

		<!-- Register form -->
<h2>Registrera för klass</h2>
<div class="register_form_content">
<?php echo "<p>" . $msg . "</p>"; ?>
<form action="" method="post">
	<table>
		<tr>
			<td>Förnamn</td>
		</tr>
		<tr>
			<td><input type="text" name="firstname" maxlength="30"  value="<?php echo  $firstname; ?>"></td>
		</tr>
		<tr>
			<td>Efternamn</td>
		</tr>
		<tr>
			<td><input type="text" name="lastname" maxlength="30"  value="<?php echo  $lastname; ?>"></td>
		</tr>
		<tr>
			<td>Email</td>
		</tr>
		<tr>
			<td><input type="text" name="email" maxlength="50" value="<?php echo  $email; ?>"</td>
		</tr>
		<tr>
			<td>Lösenord</td>
		</tr>
		<tr>
			<td><input type="text" name="password" maxlength="30" </td>
		</tr>
		<tr>
			<td>Bekräfta lösenord</td>
		</tr>
		<tr>
			<td><input type="text" name="confirm_password" maxlength="30" </td></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Registrera"></td>
		</tr>

		<!-- Lägga till bekräfta lösenord !!! -->
	</table>
</form>
<a href="?p=show_classes">Tillbaka till klasser</a>
</div>




