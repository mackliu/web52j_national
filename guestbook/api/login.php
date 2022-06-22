<?php
//比對登入表單傳過來的帳號及密碼資料是否符合
if($_POST['acc']=="admin" && $_POST['pw']=='1234'){
    //啟用session 如果題目沒要求可以不用session
    session_start();
    $_SESSION['admin']=1;

    //將資料包裝成json的格式回傳到前端
    echo json_encode(['status'=>'success','info'=>'登入成功']);
    
}else{

    //將資料包裝成json的格式回傳到前端
    echo json_encode(['status'=>'error','info'=>'帳號密碼錯誤']);
}

?>