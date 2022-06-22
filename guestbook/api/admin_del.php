<?php
include_once "db.php";

//根據傳來的id值進行資料的刪除動作
$pdo->exec("delete from `guestbook` where `id`='{$_POST['id']}'");

?>