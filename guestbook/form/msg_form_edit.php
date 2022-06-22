<?php
include_once "../api/db.php";
//取得網址傳來的參數留言id
$id=$_GET['id'];

//取得留言資料
$msg=$pdo->query("select * from `guestbook` where `id`='$id'")->fetch(PDO::FETCH_ASSOC);
?>
<form id="editMsg" action="./api/save_msg.php" method="post" enctype="multipart/form-data" class="p-5 mx-auto my-2 col-6">
    <h2 class="text-center">
        編輯留言
        <input class="btn btn-info float-right" type="button" value="回留言列表"
               onclick="$('.msg-form').addClass('d-none')"></h2>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="name">姓名</label>
        <input class="form-control" required type="text" name="name" id="name" value="<?=$msg['name'];?>">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="email">E-mail</label>
        <?php
        if($msg['show_email']==1){
        ?>
            <input class="form-control" required type="text" name="email" id="email" value="<?=$msg['email'];?>"
                   pattern="^\w+@\w+\.\w+(\.\w+)*" 
                   oninput="setCustomValidity(' ')" 
                   onchange="setCustomValidity('')" 
                   oninvalid="setCustomValidity('需包含「@」及至少 1 個「.」')" >
        <?php
        }else{
        ?>
            <input class="form-control" required type="password" name="email" id="email" value="<?=$msg['email'];?>"
                   pattern="^\w+@\w+\.\w+(\.\w+)*"  
                   oninput="setCustomValidity(' ')" 
                   onchange="setCustomValidity('')" 
                   oninvalid="setCustomValidity('需包含「@」及至少 1 個「.」')" >
        <?php
        }
        ?>
            <input type="checkbox" name="show_email" value="1" <?=($msg['show_email']==1)?'checked':'';?>>顯示
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="tel">電話</label>
        <?php
        if($msg['show_email']==1){
        ?>
            <input class="form-control" required type="tel" name="tel" id="tel" value="<?=$msg['tel'];?>"
                   pattern="^\d[\d\-]+" 
                   oninput="setCustomValidity(' ')" 
                   onchange="setCustomValidity('')" 
                   oninvalid="setCustomValidity('連絡電話只能包含數字及「-」')" >
        <?php   
        }else{
        ?>
            <input class="form-control" required type="password" name="tel" id="tel" value="<?=$msg['tel'];?>"
                   pattern="^\d[\d\-]+" 
                   oninput="setCustomValidity(' ')" 
                   onchange="setCustomValidity('')" 
                   oninvalid="setCustomValidity('連絡電話只能包含數字及「-」')" >
        <?php
        }
        ?>
            <input type="checkbox" name="show_tel" value="1" <?=($msg['show_tel']==1)?'checked':'';?>>顯示
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="msg">留言內容</label>
        <input class="form-control" type="text" name="msg" id="msg" id="msg" value="<?=$msg['msg'];?>">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="img">上傳圖片</label>
        <input class="form-control" type="file" name="img" id="img">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="serial">留言序號</label>
        <input class="form-control" required type="text" name="serial" id="serial"  value="<?=$msg['serial'];?>">
    </div>
    <div class="text-center my-2">
        <input type='hidden' name='id' value='<?=$id;?>'>
        <input type='hidden' name='type' value='edit'>
        <input class="btn btn-primary" type="submit" value="送出">
        <input class="btn btn-warning" type="reset" value="重置">
    </div>
</form>