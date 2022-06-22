<?php
include_once "db.php";
$id=$_POST['id'];

$source=$pdo->query("select * from `guestbook` where `id`='$id'")->fetch(PDO::FETCH_ASSOC);
$img=$source['img'];
if($_FILES['img']['error']==0){
    move_uploaded_file($_FILES['img']['tmp_name'],'./img/'.$_FILES['img']['name']);
    $img=$_FILES['img']['name'];
}

$show_email=(isset($_POST['show_email']))?1:0;
$show_tel=(isset($_POST['show_tel']))?1:0;

$sql="UPDATE `guestbook` 
      SET `name`='{$_POST['name']}',
          `email`='{$_POST['email']}',
          `tel`='{$_POST['tel']}',
          `show_email`='$show_email',
          `show_tel`='$show_tel',
          `msg`='{$_POST['msg']}',
          `serial`='{$_POST['serial']}',
          `img`='$img'
    WHERE `id`='$id'";

$pdo->exec($sql);

//header("location:index.php");
//讓頁面導向之前來的地方
//從前台來的請求回到前台,從後台來的請求回到後台
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>