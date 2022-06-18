<form id="regUser" action="reg_player.php" method="post" enctype="multipart/form-data" class="p-5 mx-auto my-2 col-6">
    <h2 class="text-center">玩家參賽</h2>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="name">姓名</label>
        <input class="form-control" required type="text" name="name" id="reg_name">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="email">E-mail</label>
        <input class="form-control" required type="text" name="email" id="reg_email">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="tel">電話</label>
        <input class="form-control" required type="tel" name="tel" id="reg_tel">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="img">上傳頭像</label>
        <input class="form-control" type="file" name="img" id="reg_img">
    </div>
    <div class="text-center my-2">
        <input class="btn btn-primary" type="submit" value="參賽">
        <input class="btn btn-warning" type="reset" value="重設">
        <input class="btn btn-info" type="button" onclick="$('.reg-form').addClass('d-none')" value="取消">

    </div>
</form>