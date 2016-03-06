<?php

$msg = $error = "";

if(isset($_GET['edit']) && is_numeric($_GET['edit'])){
	if(isset($_POST['updateAssignment'])){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);

		if(empty($title)){
			$error .= "<li>Ange titel!</li>";
		}

		if(empty($content)){
			$error .= "<li>Ange innehåll!</li>";
		}

		if(empty($error)){
			try{
				$query = "UPDATE assignments ";
				$query .= "SET title = :title, content = :content ";
				$query .= "WHERE id = :id";
				$ps = $db->prepare($query);
			    $ps->bindValue('title',$title);
			    $ps->bindValue('content',$content);
			    $ps->bindValue('id',$_GET['edit']);
			    $result = $ps->execute();

			    if($result){
	                $msg = "<p class='success'>Uppgiften har uppdaterats!</p>";
	            }
	            else{
	                $msg = "<p class='error'>Uppgiften kunde inte uppdateras. Försök igen!</p>";
	            }
			}
			catch (Exception $e){
                echo $e->getMessage();
            }
			
		}
	}

	try{
	    $query = "SELECT * ";
	    $query .= "FROM assignments ";
	    $query .= "WHERE id = :id";
	    $ps = $db->prepare($query);
	    $ps->bindValue('id', $_GET['edit']);
	    $ps->execute();
	}
	catch (Exception $e){
	    echo $e->getMessage();
	}
	$input_content = $ps->fetch(PDO::FETCH_ASSOC);
}

?>

<h2>Uppdatera uppgift</h2>
<form action="" method="post">
    <fieldset>
    <?php echo $msg;
        ?>
        <table>
            <tr>
                <td>Titel: </td>
                <td><input type="text" name="title" value="<?php echo @htmlentities($input_content['title']);?>"></td>
            </tr>
           
            <tr>
                <td>Innehåll: </td>
                <td><textarea name="content"><?php echo @htmlentities($input_content['content']); ?></textarea></td>
            </tr>
            
            <tr>
                <td><input type="submit" name="updateAssignment" value="Uppdatera"></td>
            </tr>
        </table>
    </fieldset>
</form>