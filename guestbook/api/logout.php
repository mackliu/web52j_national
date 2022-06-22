<?php
//啟用session
session_start();

//刪除session中的登入紀錄
unset($_SESSION['admin']);

//將頁面請求導回首頁(如果沒有要求對登入檢查，可以只有這行即可)
header('location:../index.php');
?>