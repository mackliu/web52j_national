<?php include_once "db.php";

//根據傳來的名稱檢查資料表中是否已有該名稱
echo $pdo->query("select count(*) from `guestbook` where `name`='{$_POST['name']}'")->fetchColumn();
?>