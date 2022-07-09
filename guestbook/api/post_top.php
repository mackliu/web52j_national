<?php
include_once "db.php";

//根據送過來的id資料把留言資料取出
$user=$pdo->query("select * from `guestbook` where `id`='{$_POST['id']}'")->fetch();

//判斷使用者的置頂狀態，如果已經置頂則改為不置頂，如果不是置頂，則改為置頂
if($user['top']==1){
    $pdo->exec("update `guestbook` set `top`=0 where `id`='{$_POST['id']}'");
}else{
    $pdo->exec("update `guestbook` set `top`=1 where `id`='{$_POST['id']}'");
}
?>