<?php
    $error = $msg = "";

    if(isset($_POST['create_class'])){
        $require_fields = ['class_name'];
        validate_presence($require_fields);
        $msg = "<ul>{$error}</ul>";

        if(empty($error)){
            try{
                $query = "INSERT INTO class (class_name, start_date, active) ";
                $query .= "VALUES (:class_name, :start_date, :active)";
                $ps = $db->prepare($query);
            $ps->bindValue('class_name', $_POST['class_name']);
            $ps->bindValue('start_date', $_POST['start_date']);
            $ps->bindValue('active', $_POST['status']);

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
?>

<?php
	try{
        $query = "SELECT * ";
        $query .= "FROM class ";
        $query .= "WHERE active = :active";
        $ps = $db->prepare($query);
        $ps->bindValue('active', 'active');
        $ps->execute();
        $active_classes = $ps->fetchAll(PDO::FETCH_ASSOC);

    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    try{
        $query = "SELECT * ";
        $query .= "FROM class ";
        $query .= "WHERE active = :inactive";
        $ps = $db->prepare($query);
        $ps->bindValue('inactive', 'inactive');
        $ps->execute();
        $inactive_classes = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    try{
        $query = "SELECT * ";
        $query .= "FROM class ";
        $query .= "WHERE active = :future";
        $ps = $db->prepare($query);
        $ps->bindValue('future', 'future');
        $ps->execute();
        $future_classes = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    /*
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

    */
echo "<h3>Aktiva klasser</h3>";
echo "<ul>";
foreach($active_classes as $class){
    echo "<div class=\"class_page_class_list\">";
    echo "<li style=\"text-transform: uppercase;\"><a href=\"?p=manage_class&edit={$class['id']}\">{$class['class_name']} - {$class['id']} </a></li>";
    echo "</div>";
}
echo "</ul>";

echo "<h3>Inaktiva klasser</h3>";
echo "<ul>";
foreach($inactive_classes as $class){
    echo "<div class=\"class_page_class_list\">";
    echo "<li style=\"text-transform: uppercase;\"><a href=\"?p=manage_class&edit={$class['id']}\">{$class['class_name']} - {$class['id']} </a></li>";
    echo "</div>";
}
echo "</ul>";

echo "<h3>Kommande klasser</h3>";
echo "<ul>";
foreach($future_classes as $class){
    echo "<div class=\"class_page_class_list\">";
    echo "<li style=\"text-transform: uppercase;\"><a href=\"?p=manage_class&edit={$class['id']}\">{$class['class_name']} - {$class['id']} </a></li>";
    echo "</div>";
}
echo "</ul>";
?>



<form action="" method="post">
    <?php echo $msg; ?>
    <table>
        <tr>
            <td>Klassnamn</td>
        </tr>
        <tr>
            <td><input type="text" name="class_name"></td>
        </tr> 
         <tr>
            <td>Startdatum</td>
        </tr>
        <tr>
            <td><input type="text" name="start_date"></td>
        </tr>
        <tr>
            <td>
                <select name="status">
                    <option value="active">Aktiv</option>
                    <option value="inactive">Inaktiv</option>
                    <option value="future">Kommande</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="create_class" value="Skapa klass"></td>
        </tr>
    </table>
</form>