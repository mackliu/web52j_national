<?php
include_once "db.php";
//取得需要解除配對的玩家id陣列，應該會有兩個id在陣列中
$ids=$_POST['ids'];

//使用迴圈把兩筆要解除配對的玩家資料中的`palyer`及`group_tag`欄位設為0，表示沒有任何配對
foreach($ids as $id){
    $pdo->exec("update `match_player` set `player`=0 ,`group_tag`=0 where `id`='{$id}'");
}
?>