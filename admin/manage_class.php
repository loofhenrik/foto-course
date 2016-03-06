<?php
	try{
     $query = "SELECT * ";
     $query .= "FROM assignments";
     $ps = $db->prepare($query);
     $ps->execute();
     $display_assignments = $ps->fetchAll(PDO::FETCH_ASSOC);
   }
    catch (Exception $e){
        echo $e->getMessage();
    }


    /*
    $query = "SELECT * ";
    $query .= "FROM student_users ";
    $ps = $db->prepare($query);
    $ps->execute();
    $students = $ps->fetchAll(PDO::FETCH_ASSOC);
    */

foreach($display_assignments as $assignment){
    echo "<ul class=\"class_page_class_list\">";

    echo "<li>{$assignment['title']}</li>";
    echo "<li>{$assignment['content']}</li>";
    echo "<li><a href=\"?p=edit_assignment&edit={$assignment['id']}\">Ändra</a></li>";
    echo "</ul>";

    }
?>