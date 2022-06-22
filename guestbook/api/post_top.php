<?php
include_once "db.php";

//根據送過來的id資料把該id的留言資料中的`top`欄位設為1，表示置頂
$pdo->exec("update `guestbook` set `top`=1 where `id`='{$_POST['id']}'");
?>　