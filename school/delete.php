<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$sql="delete from students where id='{$_GET['id']}'";

$rows=$pdo->exec($sql);

header("location:index.php");
?>