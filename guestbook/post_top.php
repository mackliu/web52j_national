<?php
include_once "db.php";
$pdo->exec("update `guestbook` set `top`=1 where `id`='{$_POST['id']}'");


?>