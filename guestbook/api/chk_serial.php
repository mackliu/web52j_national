<?php include_once "db.php";

//檢查傳過來的姓名及序號是否在資料表中已存在
echo $pdo->query("select count(*) from `guestbook` where `name`='{$_POST['name']}' && `serial`='{$_POST['serial']}'")->fetchColumn();
?>