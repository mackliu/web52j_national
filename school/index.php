<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生資料表</title>
</head>
<body>
<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$sql="SELECT * from students";

$rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

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
</body>
</html>