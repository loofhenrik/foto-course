<?php
require_once('../includes/sessions.php');
require_once('../includes/db_connect.php');
require_once('../includes/functions.php');
$pageTitle = "Admin panel";

$p = null;
if(isset($_GET['p'])){
    $p = $_GET['p'];
}

//$path = 'admin/';
$file = 'start.php';

if($p == "class_page"){
    $file = "class_page.php";
}

else if($p == "manage_class"){
    $file = "manage_class.php";
}

else if($p == "assignment_page"){
    $file = "assignment_page.php";
}

else if($p == "edit_assignment"){
    $file = "edit_assignment.php";
}
/*
else if($p == "news_page"){
    $file = "news_page.php";
}
*/
else if($p == "course_description"){
    $file = "course_description.php";
}

if(!isset($_SESSION['id'])){
    redirect_to("../login.php");
  }
?>

<?php include("../includes/header.php"); ?>

<header>  
  <h2>Admin panel</h2>
</header>
<div class="content">
  <aside>
    <nav>
	  <ul>
          <li><h4>Meny</h4></li>
	      <ul>
    			<li><a href="?p=class_page">Klasser</a></li>
          <li><a href="?p=assignment_page">Uppgifter</a></li>
    			<li><a href="?p=news_page">Nyheter</a></li>
    			<li><a href="?p=course_description">Kursplan</a></li>
	      </ul>
	  </ul>
	  <a href="../logout.php">Logga ut</a>
	</nav>
  </aside>
  <article>
    <p><?php include(/*$path . */$file);?></p>
  </article>
</div>
<?php include("../includes/footer.php"); ?>  