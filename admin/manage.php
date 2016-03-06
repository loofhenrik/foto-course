<?php
	require_once("../includes/sessions.php");
	require_once("../includes/db_connect.php");
	require_once("../includes/functions.php");
	include("../includes/header.php");
?>

<?php
	if(!isset($_SESSION['id'])){
		redirect_to("../login.php");
	}
?>
<?php
	$error = $msg = "";

	if(isset($_POST['create_class'])){
		$require_fields = ['class_name'];
		validate_presence($require_fields);
		$msg = "<ul>{$error}</ul>";

		if(empty($error)){
			try{
				$query = "INSERT INTO class (class_name) ";
				$query .= "VALUES (:class_name)";
				$ps = $db->prepare($query);
            $ps->bindValue('class_name', $_POST['class_name']);
            $result = $ps->execute();

            if($result){
                $msg = "<p'>Klass skapad</p>";
                $_POST['class_name'] = "";
            }
            else{
                $msg = "<p>Misslyckades med att skapa sida. Försök igen.</p>";
            }
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
?>

<?php
	try{
     $query = "SELECT * ";
     $query .= "FROM class";
     $ps = $db->prepare($query);
     $ps->execute();
     $classes = $ps->fetchAll(PDO::FETCH_ASSOC);
   }
    catch (Exception $e){
        echo $e->getMessage();
    }

    $query = "SELECT * ";
    $query .= "FROM student_users ";
    $ps = $db->prepare($query);
    $ps->execute();
    $students = $ps->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>";
foreach($classes as $class){
    echo "<li style=\"text-transform: uppercase;\">{$class['class_name']} - {$class['id']} </li>";
    echo "<ul>";
    foreach($students as $student) {
    	if($student['class_id'] == $class['id']){
    		echo "<li>{$student['first_name']} {$student['last_name']}</li>";
    		echo "<li style=\"font-style:italic;\">{$student['email']}</li>";
    	}
    }
    echo "</ul>";
}
echo "</ul>";
?>

<div class="content">
	<h2>Admin</h2>
	<p>Välkommen <?php echo $_SESSION['first_name']; ?> till skyddad sida!</p>
	<p><a href="../logout.php">Logout</a></p>

	<h3>Skapa ny klass</h3>
	<form action="" method="post">
		<?php echo $msg; ?>
		<table>
			<tr>
				<td>Klassnamn:</td>
				<td><input type="text" name="class_name"></td>
				<td><input type="submit" name="create_class" value="Skapa klass"></td>
			</tr>
		</table>
	</form>
</div>
	
<?php
	include("../includes/footer.php");
?>