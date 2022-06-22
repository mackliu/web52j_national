<?php
include_once "db.php";

//取得要回覆的留言資料id
$id=$_POST['id'];

//建立管理者回覆內容的變數
$reply=$_POST['admin_reply'];

//建立留言更新語法，將管理者回覆的內容帶入語法中
$sql="UPDATE `guestbook` 
      SET `admin_reply`='$reply'
      WHERE `id`='$id'";

$pdo->exec($sql);
?>