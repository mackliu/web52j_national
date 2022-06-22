<?php
include_once "db.php";
//取得所有player欄位為0的未配對玩家id資料

$players=$pdo->query("select `id` from `match_player` where `player`='0'")->fetchAll();
//使用shuffle函式讓玩家的資料亂數排序
shuffle($players);

//使用2的餘數來判斷未配對玩家數為奇數或偶數，如果是奇數，則pop出最後一位做為未配對玩家
if(count($players)%2==1){
    array_pop($players);
}

//宣告一個陣列來儲存配對的玩家
$groups=[];

foreach($players as $key => $player){
    //從0開始..使用餘數為0的玩家id值做一個md5值來儲存配對的玩家id
    if($key%2==0){
        $tag=md5($player['id']);
        $groups[$tag][]=$player['id'];
    }else{
        $groups[$tag][]=$player['id'];
    }
}

//使用迴圈來更新每組配對玩家的資料表內容
foreach($groups as $key => $group){
    /**
     * 因為每個$group中都會有兩個id，互為配對關係比如
     * $group=[1,2] 則id 1 的配對玩家2;
     *                id 2 的配對玩為1;
     * 而$key則為上一個foreach回圈中產生的md5碼    
     * */
    $pdo->exec("update `match_player` set `player`='{$group[0]}',`group_tag`='{$key}' where `id`='{$group[1]}'");
    $pdo->exec("update `match_player` set `player`='{$group[1]}',`group_tag`='{$key}' where `id`='{$group[0]}'");
}

?>