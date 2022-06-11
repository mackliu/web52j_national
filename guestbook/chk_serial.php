<?php include_once "db.php";

$sql="select count(*) from `guestbook` where `serial`='{$_POST['serial']}'";
echo $pdo->query($sql)->fetchColumn();
?>