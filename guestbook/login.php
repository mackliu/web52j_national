<?php
$acc=$_POST['acc'];
$pw=$_POST['pw'];
//$chk=$_POST['chk'];

if($acc=="admin" && $pw=='1234'){
    session_start();
    $_SESSION['admin']=1;
    echo json_encode(['status'=>'success','info'=>'登入成功']);
}else{
    echo json_encode(['status'=>'error','info'=>'帳號密碼錯誤']);
}

?>