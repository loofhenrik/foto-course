<?php
    $error = $msg = "";

    $session_id = $_SESSION['id'];

	try{
        $query = "SELECT class_id ";
        $query .= "FROM student_users ";
        $query .= "WHERE id=:id";
        $ps = $db->prepare($query);
        $ps->bindValue('id', $session_id);
        $ps->execute();
        $student_class = $ps->fetchAll(PDO::FETCH_ASSOC);
        var_dump($student_class[0]['class_id']);
   }
    catch (Exception $e){
        echo $e->getMessage();
    }


    try{
        $query = "SELECT * ";
        $query .= "FROM relations ";
        $query .= "WHERE class_rel=:rel";
        $ps = $db->prepare($query);
        $ps->bindValue('rel', $student_class[0]['class_id']);
        $ps->execute();
        $class_relations = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    try{
        $query = "SELECT * ";
        $query .= "FROM assignments";
        $ps = $db->prepare($query);
        $ps->execute();
        $select_assignments = $ps->fetchAll(PDO::FETCH_ASSOC);
   }
    catch (Exception $e){
        echo $e->getMessage();
    }
?>

<h2>Uppgifter</h2>

<?php

foreach($class_relations as $cl_rel){
    if($cl_rel['class_rel'] == $student_class[0]['class_id']){
    foreach ($select_assignments as $sel_ass) {
            if($sel_ass['id'] == $cl_rel['assignment_rel']){
                echo "<a href=\"?p=student_list_page&cl_id={$cl_rel['class_rel']}\"><ul class=\"\">";
                echo "<li>{$sel_ass['title']}</li>";
                echo "<li>{$sel_ass['content']}</li>";
                //echo "<li><a href=\"?p=edit_assignment&edit={$assignment['id']}\">Visa</a></li>";
                echo "</ul></a>";
            }  
        }
    }  
}
?>

<?php
/*
foreach($select_assignments as $assignment){
    echo "<ul class=\"\">";

    echo "<li>{$assignment['title']}</li>";
    echo "<li>{$assignment['content']}</li>";
    echo "<li><a href=\"?p=edit_assignment&edit={$assignment['id']}\">Visa</a></li>";

    echo "</ul>";
}
*/
?>
