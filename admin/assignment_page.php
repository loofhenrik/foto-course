<?php
    $error = $msg = "";

    if(isset($_POST['create_assignment'])){
        $require_fields = ['assignment_title', 'assignment_content'];
        validate_presence($require_fields);
        $msg = "<ul>{$error}</ul>";

        if(empty($error)){
            try{
                $query = "INSERT INTO assignments (title, content) ";
                $query .= "VALUES (:assignment_title, :assignment_content)";
                $ps = $db->prepare($query);
            $ps->bindValue('assignment_title', $_POST['assignment_title']);
            $ps->bindValue('assignment_content', $_POST['assignment_content']);
            $result = $ps->execute();

            if($result){
                $msg = "<p'>Uppgift skapad</p>";
                $_POST['class_name'] = "";
            }
            else{
                $msg = "<p>Misslyckades med att skapa uppgift. Försök igen.</p>";
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



<form action="" method="post">
    <?php echo $msg; ?>
    <table>
        <tr>
            <td>Skapa uppgift:</td>
        </tr>
        <tr>
            <td>Titel</td>
            <td><input type="text" name="assignment_title"></td>
        </tr>
        <tr>
            <td>Text</td>
            <td><input type="text" name="assignment_content"></td>
        </tr>
            

            <td><input type="submit" name="create_assignment" value="Skapa uppgift"></td>
        </tr>
    </table>
</form>