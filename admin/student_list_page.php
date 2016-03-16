<?php
    $error = $msg = "";
    /*
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

    try{
        $query = "SELECT * ";
        $query .= "FROM relations ";
        $ps = $db->prepare($query);

        $ps->execute();
        $class_relations = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
*/

    try{
        $query = "SELECT * ";
        $query .= "FROM student_users ";
        $query .= "WHERE class_id=:class_id";
        $ps = $db->prepare($query);
        $ps->bindValue('class_id', $_GET['cl_id']);

        $ps->execute();
        $students_in_class = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    
    
    
?>

<h2>Klass <?php echo $_GET['cl_id']; ?></h2>

<?php

foreach($students_in_class as $stud){
    $full_name = $stud['first_name'];
    $full_name .= " " . $stud['last_name'];
    echo "<ul class=\"class_page_class_list\">";
    echo "<li class=\"\">$full_name</li>";
    echo "</ul>";
}
?>

<?php
