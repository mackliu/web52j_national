<?php
include_once "db.php";

//先建立一個空的圖片變數，如果沒有上傳檔案，則寫入空的資料
$img='';

//判斷是否有上傳檔案成功
if($_FILES['img']['error']==0){

    //檔案上傳成功的話把檔案搬到img目錄下，並將檔名改為和原本上傳一樣的
    move_uploaded_file($_FILES['img']['tmp_name'],'./img/'.$_FILES['img']['name']);

    //將圖片變數改為上傳檔案的檔名
    $img=$_FILES['img']['name'];
}

//建立新增的SQL語法
$sql="INSERT into `guestbook` (`name`,`email`,`tel`,`msg`,`serial`,`img`)
            values('{$_POST['name']}','{$_POST['email']}','{$_POST['tel']}','{$_POST['msg']}','{$_POST['serial']}','$img')";

//執行新增寫入資料表
$pdo->exec($sql);

//將頁面請求導回首頁
header("location:../index.php");
?>