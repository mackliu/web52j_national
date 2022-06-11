<?php
$acc=$_POST['acc'];
$pw=$_POST['pw'];
$chk=$_POST['chk'];

if($acc=="admin" && $pw=='1234'){
    session_start();
    $_SESSION['admin']=1;
    header("location:index.php");
}else{
    header("location:index.php?error=login");
}

?>