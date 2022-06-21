<form action="login.php" method="post" class="p-5 mx-auto my-2 col-6">
    <h2 class="text-center">管理者登入</h2>
    <div class="form-group">
        <label class="d-block" for="acc">帳號</label>
        <input class="w-100 form-control" type="text" name="acc" id="acc">
    </div>
    <div class="form-group">
        <label class="d-block" for="pw">密碼</label>
        <input class="w-100 form-control" type="password" name="pw" id="pw">
    </div>
    <div class="form-group">
        <label class="d-block" for="num">圖片驗證碼</label>
        <input class="w-100 form-control" type="text" name="num" id="num">
    </div>
    <div class="d-flex">
        <div id="vernum" class="bg-light col-8">
            <canvas id="numboard"></canvas>
        </div>
        <div id="reset" class="btn btn-info col-4" onclick="makeNum()">驗證碼重新產生</div>
    </div>
    <div class="text-center my-2">
        <input class="btn btn-primary" type="button" value="送出" onclick="login()">
        <input class="btn btn-warning" type="reset" value="重置">
    </div>
</form>