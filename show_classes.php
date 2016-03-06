<?php
	require_once("includes/sessions.php");
	require_once("includes/db_connect.php");
	require_once("includes/functions.php");
?>

<?php
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
?>

<h2>Anmäl dig till kommande kurser!</h2>
<div class="future_classes_content">
<?php
echo "<table>";
    echo "<tr class=\"table_header_register\">";
    echo "<td>Klass</td>";
    echo "<td>Startdatum</td>";
    echo "<td></td>";
    echo "</tr>";
foreach($future_classes as $class){
    echo "<tr>";
    echo "<td>{$class['class_name']}</td>";
    echo "<td>{$class['start_date']}</td>";
    echo "<td><a class=\"booking_button\" href='?p=register_student&classid={$class['id']}'>ANMÄL</td>";
    //echo "<td><a href='?p=edit_page&edit={$page['id']}'>Edit</a> | <a href='?p=view_pages&delete={$page['id']}'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
</div>