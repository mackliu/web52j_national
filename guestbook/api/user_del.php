<?php
include_once "db.php";

//根據傳來的id資料，將使用者留言的刪除狀態設為1,表示刪除,此刪除為玩家自行刪除,不會真的刪除資料
$pdo->exec("update `guestbook` set `del`=1 where `id`='{$_POST['id']}'");

?>