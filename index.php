<?php

$str="hello world today is a good day ";
$str2="劉勤永";
$str3="小明";
$str4="小王";

echo $str . $str2. "<BR>";
echo $str . $str3. "<BR>";
echo $str . $str4. "<BR>";

$score=50;

if($score >= 60){
    echo "及格";
}else{
    echo "不及格";
}

echo "<hr>";

if($str2 == '劉勤永' ){
    echo "是本人";
}else{
    echo "不是本人";
}


?>
<h1 style='color:blue'><?=$str2 . $score;?></h1>
<h1 style='color:red'><?=$str3;?></h1>
<h1 style='color:green'><?=$str4;?></h1>


<?php

$level="d";

switch($level){
    case "A":
        echo "你好棒棒";
    break;
    case "B";
        echo "還有進步空間";
    break;
    case "C";
        echo "請加油";
    break;
    default:
        echo "輸入的資料不合法";


}

?>

<h1>迴圈</h1>
<?php
//$i++ => $i=$i+1;
for($i=0;$i<10;$i=$i+2){
    echo $i * 3;
}
?>
<style>
table{
    width:80%;
    padding:10px;
    background:#eee;
    font-size:1rem;
    border-collapse:collapse;
}
td{
    border:1px solid #999;
    padding:5px 10px;
}
</style>

<?php
echo "<table>";
for($i=1;$i<=9;$i++){
    echo "<tr>";
    for($j=1;$j<=9;$j++){
        echo "<td>";
        echo $i ." x " . $j . " = ";
        echo $i*$j;
        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
<h1>條件式迴圈 while</h1>
<h3>威力彩號</h3>
<?php

$result=[];
/* for($i=0;$i<6;$i++){
    echo rand(1,38);
    echo ",";
} */
$count=0;
while(count($result)<6){
    $count++;
    $num=rand(1,38);
    if(!in_array($num,$result)){
        $result[]=$num;
    }

}
echo "迴圈跑了".$count."次<br>";
for($i=0;$i<count($result);$i++){
    echo $result[$i]. ",";
}

?>
