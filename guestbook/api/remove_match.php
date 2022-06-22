<?php
include_once "db.php";
//取得需要解除配對的玩家id陣列
$ids=$_POST['ids'];
foreach($ids as $id){
    $pdo->exec("update `match_player` set `player`=0 ,`group_tag`=0 where `id`='{$id}'");
}
?>