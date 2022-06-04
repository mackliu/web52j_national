<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$sql="SELECT * from students";

$rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

/* echo "<pre>";
print_r($rows);
echo "</pre>";
 */

echo "<table>";

foreach($rows as  $value){
    echo "<tr>";
        echo "<td>".$value['name'] . "</td>";
        echo "<td>".$value['birthday'] . "</td>";
        echo "<td>".$value['classroom'] . "</td>";
        echo "<td>".$value['score'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>