<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=travel";
$pdo=new PDO($dsn,'root','');
$img='';
if($_FILES['img']['error']==0){
    move_uploaded_file($_FILES['img']['tmp_name'],'./img/'.$_FILES['img']['name']);
    $img=$_FILES['img']['name'];
}
$sql="INSERT into `guestbook` (`name`,`email`,`tel`,`msg`,`serial`,`img`)
                        values('{$_POST['name']}','{$_POST['email']}','{$_POST['tel']}','{$_POST['msg']}','{$_POST['serial']}','$img')";

$pdo->exec($sql);
header("location:index.php");
?>