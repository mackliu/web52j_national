<?php
include_once "db.php";
$id=$_POST['id'];
$reply=$_POST['admin_reply'];

$sql="UPDATE `guestbook` 
      SET `admin_reply`='$reply'
      WHERE `id`='$id'";

$pdo->exec($sql);
?>