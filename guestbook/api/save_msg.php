<?php
include_once "db.php";

//取得表單中的id資料
$id=$_POST['id'];

//根據id從資料表中取得原始的留言資料
$source=$pdo->query("select * from `guestbook` where `id`='$id'")->fetch(PDO::FETCH_ASSOC);

//先將原始留言資料中的圖片資料存入變數中
$img=$source['img'];

//判斷是否有上傳圖片
if($_FILES['img']['error']==0){

    //如果有成功上傳資料，則移動圖片到img目錄下，同時更新圖片變數的資料
    move_uploaded_file($_FILES['img']['tmp_name'],'./img/'.$_FILES['img']['name']);
    $img=$_FILES['img']['name'];
}
//根據checkbox有無勾選來決顯示或隱藏電話及email
$show_email=(isset($_POST['show_email']))?1:0;
$show_tel=(isset($_POST['show_tel']))?1:0;

//建立更新留言的SQL語法
$sql="UPDATE `guestbook` 
      SET `name`='{$_POST['name']}',
          `email`='{$_POST['email']}',
          `tel`='{$_POST['tel']}',
          `show_email`='$show_email',
          `show_tel`='$show_tel',
          `msg`='{$_POST['msg']}',
          `serial`='{$_POST['serial']}',
          `img`='$img'
    WHERE `id`='$id'";

//執行更新資料到資料表
$pdo->exec($sql);

//header("location:index.php");
//讓頁面導向之前來的地方
//從前台來的請求回到前台,從後台來的請求回到後台
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>