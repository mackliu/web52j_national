<?php
include_once "db.php";

$img='';
if(!empty($_FILES['img']['tmp_name'])){
    $img=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],'./img/'.$img);
}

//尋找資料表中有沒有尚未配對的玩家
//只要select `id`這個欄位就好..並且只取得第一筆找到的資料可以..因此使用fetchColumn()
$wait_player=$pdo->query("select `id` from `match_player` where `player`=0")->fetchColumn();

//判斷$wait_player有沒有從資料表中撈到資料,區分有沒未配對的玩家
if(!empty($wait_player)){
    //使用md5產生一組以id為基礎的配對序號,方便之後查詢同組的人員
    $group_tag=md5($wait_player);
    //有玩家尚未配對,則設為新增玩家的配對對像
    $pdo->exec("insert into `match_player` (`name`,`email`,`tel`,`img`,`player`,`group_tag`) 
                values('{$_POST['name']}','{$_POST['email']}','{$_POST['tel']}','{$img}','{$wait_player}','{$group_tag}')");
    //根據配對序號，找到剛新增的玩家id                
    $new_player=$pdo->query("select `id` from `match_player` where `group_tag`='$group_tag'")->fetchColumn();

    //設定被配對對像的對手為新增玩家的id
    $pdo->exec("update `match_player` set `player`='{$new_player}',`group_tag`='{$group_tag}' where `id`='$wait_player'");
}else{
    //如果資料表中的玩家都已經配對了，則先新增資料即可
    $pdo->exec("insert into `match_player` (`name`,`email`,`tel`,`img`) 
                values('{$_POST['name']}','{$_POST['email']}','{$_POST['tel']}','{$img}')");
}

header('location:index.php');
?>