<?php
/* 
$name=$_POST['name'];
$birthday=$_POST['birthday'];
$classroom=$_POST['classroom'];
$score=$_POST['score']; */
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

/* echo $_POST['name']."<br>";
echo $_POST['birthday']."<br>";
echo $_POST['classroom']."<br>";
echo $_POST['score']."<br>"; */

$sql="insert into `students` (`name`,`birthday`,`classroom`,`score`) values('{$_POST['name']}','{$_POST['birthday']}','{$_POST['classroom']}','{$_POST['score']}')";

$rows=$pdo->exec($sql);

header("location:index.php");
?>