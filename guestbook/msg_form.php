<?php
include_once "db.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $msg=$pdo->query("select * from `guestbook` where `id`='$id'")->fetch(PDO::FETCH_ASSOC);
}
?>
<?php
if(isset($id)){
?>
    <form id="addMsg" action="save_msg.php" method="post" enctype="multipart/form-data" class="p-5 mx-auto my-2 col-6">
<?php
}else{
?>
    <form id="addMsg" action="add_msg.php" method="post" enctype="multipart/form-data" class="p-5 mx-auto my-2 col-6">
<?php
}
?>
    <h2 class="text-center">
        <?=isset($id)?"編輯留言":"新增留言";?>
        
        <input class="btn btn-info float-right" type="button" value="回留言列表"
            onclick="$('.msg-form').addClass('d-none')"></h2>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="name">姓名</label>
        <input class="form-control" required type="text" name="name" id="name" value="<?=isset($id)?$msg['name']:'';?>">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="email">E-mail</label>
        <?php
        if(isset($id) && $msg['show_email']==1){
            ?>
            <input class="form-control" required type="text" name="email" id="email" value="<?=isset($id)?$msg['email']:'';?>">
        <?php
        }else if(isset($id) && $msg['show_email']==0){
        ?>
        <input class="form-control" required type="password" name="email" id="email" value="<?=isset($id)?$msg['email']:'';?>">
        <?php
        }else{        
        ?>
        <input class="form-control" required type="text" name="email" id="email" value="">
        <?php
        }
        ?>
        <?php 
        if(isset($id)){
        ?>
            <input type="checkbox" name="show_email" value="1" <?=($msg['show_email']==1)?'checked':'';?>>
            顯示
        <?php
        }
        ?>
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="tel">電話</label>
        <?php
        if(isset($id) && $msg['show_email']==1){
        ?>
            <input class="form-control" required type="tel" name="tel" id="tel" value="<?=isset($id)?$msg['tel']:'';?>">
        <?php   
        }else if(isset($id) && $msg['show_email']==0){
        ?>
            <input class="form-control" required type="password" name="tel" id="tel" value="<?=isset($id)?$msg['tel']:'';?>">
        <?php
        }else{
        ?>
            <input class="form-control" required type="tel" name="tel" id="tel" value="">
        <?php
        }
        ?>

        <?php 
        if(isset($id)){
        ?>
            <input type="checkbox" name="show_tel" value="1" <?=($msg['show_tel']==1)?'checked':'';?>>
            顯示
        <?php
        }
        ?>
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="msg">留言內容</label>
        <input class="form-control" type="text" name="msg" id="msg" id="msg" value="<?=isset($id)?$msg['msg']:'';?>">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="img">上傳圖片</label>
        <input class="form-control" type="file" name="img" id="img">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="serial">留言序號</label>
        <input class="form-control" required type="text" name="serial" id="serial"  value="<?=isset($id)?$msg['serial']:'';?>">
    </div>
    <div class="text-center my-2">
        <?php
        if(isset($id)){
            echo "<input type='hidden' name='id' value='$id'>";
        }
        ?>
        <input class="btn btn-primary" type="button" value="送出" onclick="send('<?=isset($id)?'edit':'add';?>')">
        <input class="btn btn-warning" type="reset" value="重置">

    </div>
</form>