<?php
include_once "db.php";
$pdo->exec("delete from `guestbook` where `id`='{$_POST['id']}'");
?>