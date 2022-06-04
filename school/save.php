<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$sql="update `students` set name='{$_POST['name']}',
                            birthday='{$_POST['birthday']}',
                            classroom='{$_POST['classroom']}',
                            score='{$_POST['score']}' 
                        where id='{$_POST['id']}'";

$rows=$pdo->exec($sql);

header("location:index.php");
?>