<?php
//啟用session功能
session_start();

//使用亂數功能產生隨機4位數字
$_SESSION['num']=rand(1000,9999);

//使用echo指令回傳驗證碼數字給前端
echo $_SESSION['num'];
?>