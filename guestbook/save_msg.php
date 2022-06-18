<?php
include_once "db.php";
$id=$_POST['id'];

$source=$pdo->query("select * from `guestbook` where `id`='$id'")->fetch(PDO::FETCH_ASSOC);
$img=$source['img'];
if($_FILES['img']['error']==0){
    move_uploaded_file($_FILES['img']['tmp_name'],'./img/'.$_FILES['img']['name']);
    $img=$_FILES['img']['name'];
}

$sql="UPDATE `guestbook` 
      SET `name`='{$_POST['name']}',
          `email`='{$_POST['email']}',
          `tel`='{$_POST['tel']}',
          `msg`='{$_POST['msg']}',
          `serial`='{$_POST['serial']}',
          `img`='$img'
    WHERE `id`='$id'";

$pdo->exec($sql);
header("location:index.php");
?>