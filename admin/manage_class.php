<?php
    $error = $msg = "";

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
        $query .= "WHERE class_rel=:rel";
        $ps = $db->prepare($query);
        $ps->bindValue('rel', $_GET['edit']);

        $ps->execute();
        $class_relations = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    if(isset($_POST['addAssignment'])){
            
        $msg = "<ul>{$error}</ul>";

        if(empty($error)){
            try{
                $query = "INSERT INTO relations (assignment_rel, class_rel) ";
                $query .= "VALUES (:ass_rel, :class_rel)";
                $ps = $db->prepare($query);
                $ps->bindValue('ass_rel', $_POST['ass_id']);
                $ps->bindValue('class_rel', $_GET['edit']);

                $created_classes = $ps->execute();

                if($created_classes){
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



    /*
    $query = "SELECT * ";
    $query .= "FROM student_users ";
    $ps = $db->prepare($query);
    $ps->execute();
    $students = $ps->fetchAll(PDO::FETCH_ASSOC);
    */
?>

<h2>Klass <?php echo $_GET['edit']; ?></h2>

<?php

foreach($class_relations as $cl_rel){
    if($cl_rel['class_rel'] == $_GET['edit']){
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


<h2>Lägg till uppgift</h2>
<form action="" method="post">
    <?php echo $msg; ?>
    <table>
        <tr>
            <td>
                <select name="ass_id">
                    <?php 
                        foreach ($select_assignments as $option_assignments) {
                            var_dump($option_assignments['id']);
                            echo "<option value=\"{$option_assignments['id']}\">{$option_assignments['title']}</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="addAssignment" value="Lägg till uppgift"></td>
        </tr>
    </table>
</form>