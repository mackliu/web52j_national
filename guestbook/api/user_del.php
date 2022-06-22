<?php
include_once "db.php";
$pdo->exec("update `guestbook` set `del`=1 where `id`='{$_POST['id']}'");
?>