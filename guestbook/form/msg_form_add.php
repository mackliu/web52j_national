<form id="addMsg" action="./api/add_msg.php" method="post" enctype="multipart/form-data" class="p-5 mx-auto my-2 col-6">
    <h2 class="text-center">
        新增留言
        <input class="btn btn-info float-right" type="button" value="回留言列表" onclick="$('.msg-form').addClass('d-none')">
    </h2>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="name">姓名</label>
        <input class="form-control" required type="text" name="name" id="name">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="email">E-mail</label>
        <input class="form-control" required type="email"  name="email" id="email"
               pattern="^\w+@\w+\.\w+(\.\w+)*" 
               oninput="setCustomValidity(' ')" 
               onchange="setCustomValidity('')" 
               oninvalid="setCustomValidity('需包含「@」及至少 1 個「.」')">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="tel">電話</label>
        <input class="form-control" required type="tel" name="tel" id="tel" 
               pattern="^\d[\d\-]+"
               oninput="setCustomValidity(' ')" 
               onchange="setCustomValidity('')" 
               oninvalid="setCustomValidity('連絡電話只能包含數字及「-」')" >
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="msg">留言內容</label>
        <input class="form-control" type="text" name="msg" id="msg" id="msg">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="img">上傳圖片</label>
        <input class="form-control" type="file" name="img" id="img">
    </div>
    <div class="input-group my-2">
        <label class="justify-content-center col-3 input-group-text" for="serial">留言序號</label>
        <input class="form-control" required type="text" name="serial" id="serial">
    </div>
    <div class="text-center my-2">
        <input type='hidden' name='type' value='add'>
        <input class="btn btn-primary" type="submit" value="送出">
        <input class="btn btn-warning" type="reset" value="重置">
    </div>
</form>