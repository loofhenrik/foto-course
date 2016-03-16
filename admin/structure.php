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

else if($p == "student_list_page"){
    $file = "student_list_page.php";
}

else if($p == "assignment_page"){
    $file = "assignment_page.php";
}

else if($p == "edit_assignment"){
    $file = "edit_assignment.php";
}

else if($p == "course_description"){
    $file = "course_description.php";
}

else if($p == "student_page"){
    $file = "student_page.php";
}

if(!isset($_SESSION['id'])){
    redirect_to("../login.php");
  }
?>

<?php include("../includes/header.php"); ?>
<div class="main_content">
  <div class="header_admin">
    <div class="header_filter">
      <h2 class="header_box">Admin panel</h2>
    </div>
  </div>
  <div class="wrapper_admin">
    <aside>
  	  <ul>
        <a href="?p=student_page"><li>Student</li></a>
  			<a href="?p=class_page"><li>Klasser</li></a>
        <a href="?p=assignment_page"><li>Uppgifter</li></a>
  			<a href="?p=news_page"><li>Nyheter</li></a>
  			<a href="?p=course_description"><li>Kursplan</li></a>
  	  </ul>
    </aside>
    <div class="content_admin">
      <p><?php include(/*$path . */$file);?></p>
    </article>
  </div>
</div>
<?php include("../includes/footer.php"); ?>  