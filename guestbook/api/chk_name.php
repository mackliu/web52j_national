<?php include_once "db.php";

$sql="select count(*) from `guestbook` where `name`='{$_POST['name']}'";
echo $pdo->query($sql)->fetchColumn();
?>