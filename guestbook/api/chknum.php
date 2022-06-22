<?php
$num=$_POST['num'];
session_start();
//檢查session暫存的驗證碼和傳過來的驗證碼是否一致
if($num==$_SESSION['num']){
    echo true;
}else{
    echo false;
}
