<?php
	//require_once("includes/sessions.php");
	//require_once("includes/db_connect.php");
	require_once("includes/functions.php");

	ini_set('mysql.connection_timeout', 300);
	ini_set('default_socket_timeout', 300);
?>

<html>
<head>
	<title>File upload to database</title>
</head>
<body>
<form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
<input type="file" name="userfile"/>
<input type="submit" value="Ladda upp"/>
</form>

<?php

if(!isset($_FILES['userfile'])){
	echo "Välj en fil";
}
else{
	try{
		upload();
		echo "Tack för uppladdning!";
	}
	catch(Exception $e){
		echo "<h4>". $e->getMessage() ."</h4>";
	}
}

function upload(){
	//kolla om fil laddades upp
	if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
	{
		//bild info
		$size = getimagesize($_FILES['userfile']['tmp_name']);
		//deklarera vars
		$type = $size['mime'];
		$imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
  	$size = $size[3];
  	$name = $_FILES['userfile']['name'];
  	//vad ska jag göra med maxsize?
  	$maxsize = 99999999;

  	//kolla om filen är mindre än maxstorlek
  	if($_FILES['userfile']['size'] < $maxsize)
  	{
  		define("DSN", "mysql:host=localhost;dbname=ex_foto;");
			define("USER", "root");
			define("PASS", "");
			$opt = array(
	    // any occurring errors will be thrown as PDOException
	    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	    // an SQL command to execute when connecting
	    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
	  );

			$db = new PDO(DSN, USER, PASS, $opt);

  		$query = "INSERT INTO images (image_type, image, image_size, image_name, student_id) ";
  		$query .= "VALUES (? ,?, ?, ?)";
  		$ps = $db->prepare($query);
  		$ps->bindParam(1, $type);
  		$ps->bindParam(2, $imgfp, PDO::PARAM_LOB);
  		$ps->bindParam(3, $size);
  		$ps->bindParam(4, $name);
      $ps->bindParam(5, $stud_id);

  		//utför query
      $ps->execute();
  	}
  	else
  	{
  		throw new Exception("Fel filstorlek.");
  	}
	}
	else
	{
		throw new Exception("Filformatet stöds inte.");
	}
}

/*if(filter_has_var(INPUT_GET, "image_id") !== false && filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT) !== false){
	$image_id = filter_input(INPUT_GET, "image_id", FILTER_SANITIZE_NUMBER_INT);

	try{
        $db = new PDO("mysql:host=localhost;dbname=ex_foto", 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //fråga efter bilder md bild-id
        $query = "SELECT image, image_type ";
        $query .= "FROM images ";
        $query .= "WHERE image_id=$image_id";
        $ps = $db->prepare($query);
        $ps->execute();
        $ps->setFetchMode(PDO::FETCH_ASSOC);
        $result = $ps->fetch();
        if(sizeof($result) == 2)
        {
        	header("Content-type: " . $result['image_type']);
        	echo $result['image'];
        }
        else{
        	throw new Exception("Out of bounds error");
        }
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}
else
{
	echo "Please use real id number";
}*/
?>

<?php 
	
/*** Check the $_GET variable ***/
if(filter_has_var(INPUT_GET, "image_id") !== false && filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT) !== false)
    {
    /*** set the image_id variable ***/
    $image_id = filter_input(INPUT_GET, "image_id", FILTER_SANITIZE_NUMBER_INT);
   try    {
          /*** connect to the database ***/
          $dbh = new PDO("mysql:host=localhost;dbname=ex_foto", 'root', '');

          /*** set the PDO error mode to exception ***/
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          /*** The sql statement ***/
          $sql = "SELECT image_type, image_size, image_name FROM images WHERE image_id=".$image_id;

          /*** prepare the sql ***/
          $stmt = $dbh->prepare($sql);

          /*** exceute the query ***/
          $stmt->execute(); 

          /*** set the fetch mode to associative array ***/
          $stmt->setFetchMode(PDO::FETCH_ASSOC);

          /*** set the header for the image ***/
          $array = $stmt->fetch();

          /*** the size of the array should be 3 (1 for each field) ***/
          if(sizeof($array) === 3)
              {
              echo '<p>This is '.$array['image_name'].' from the database</p>';
              echo '<img '.$array['image_size'].' src="showfile.php?image_id='.$image_id.'">';
              }
          else
              {
              throw new Exception("Out of bounds error");
              }
          }
       catch(PDOException $e)
          {
          echo $e->getMessage();
          }
       catch(Exception $e)
          {
          echo $e->getMessage();
          }
      }
 /*else
      {
      echo 'Please use a valid image id number';
      }*/
?>

</body>
</html>