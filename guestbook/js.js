/** 首頁玩家功能js */
//新增留言按鈕
$("#addNewMsg").on("click", () => {
    $.get("msg_form_add.php", (form) => {
        $(".msg-form").html(form)
        $(".msg-form").removeClass("d-none")
    })
})

//玩家參賽報名按鈕
$(".btn-reg").on("click", function () {
    $.get("reg_form.php", (form) => {
        $('.reg-form').html(form)
        $(".reg-form").removeClass('d-none');
    })
})

//玩家編輯留言時彈出序號確認對話框
$(".edit-icon").on("click", function () {
    $(this).parents('.user-info').siblings('.user-edit').show();
})

//玩家編輯留言表單出現或提示資料錯誤
$(".btn-edit").on("click", function () {
    let name = $(this).data('name')
    let id = $(this).data('id')
    let serial = $(this).siblings('.edit-num').val()
    $.post("chk_serial.php", { name, serial }, (res) => {
        if (parseInt(res) === 1) {
            $.get("msg_form_edit.php", { id }, (form) => {
                $(".msg-form").html(form)
                $(".msg-form").removeClass('d-none')
            })
        } else {
            alert('序號錯誤')
        }
    })

})

//玩家刪除自己的留言
$(".btn-del").on("click", function () {
    let name = $(this).data('name')
    let id = $(this).data('id')
    let serial = $(this).siblings('.edit-num').val()
    $.post("chk_serial.php", {
        name,
        serial
    }, (res) => {
        console.log(res)
        if (parseInt(res) === 1) {
            $.post("user_del.php", { id }, () => {
                location.reload()
            })
        } else {
            alert('序號錯誤')
        }
    })
})

//送出留言表單
$("#addMsg").on('submit', (e) => {
    let serial = $("#addMsg input[name='serial']").val();
    let name = $("#addMsg input[name='name']").val();
    let type = $("input[name='type']").val();
    if (serial.length != 4) {
        alert("序號只能4位數字");
    } else {
        if (type == 'add') {
            $.post('chk_name.php', { name }, (res) => {
                if (parseInt(res)) {
                    alert("姓名重覆");
                } else {
                    //使用unbind先解除事件再送出
                    $("#addMsg").unbind('submit')
                    $("#addMsg").submit()
                }
            })
        } else {
            //使用unbind先解除事件再送出
            $("#addMsg").unbind('submit')
            $("#addMsg").submit()
        }
    }
})

//管理者登入表單
function login() {
    let acc = $("input[name='acc']").val();
    let pw = $("input[name='pw']").val();
    let num = $("input[name='num']").val();
    $.post('chknum.php', {
        num
    }, (res) => {
        if (res) {
            $.post('login.php', { acc, pw }, (res) => {
                res = JSON.parse(res);
                if (res.status == 'error') {
                    alert("帳號或密碼錯誤");
                } else {
                    location.href = 'admin.php';
                }
            })
        } else {
            alert("驗證碼錯誤請重新輸入")
            makeNum()
        }
    })
}

//登入畫面被呼叫時,同時去後端撈驗證碼
$(".admin").on('click', () => {
    $("#admin").show();
    makeNum();
})

//向後台請求產生驗證碼
function makeNum() {
    $.get("vernum.php", (num) => {
        cav(num)
        //$("#vernum").text(num)
    })
}

//將後台傳來的驗證碼數字轉為圖形
function cav(str) {
    let canvas = document.getElementById('numboard');
    let ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    let height = 42;
    let width = $("#vernum").width();
    canvas.height = height;
    canvas.width = width;

    ctx.font = "36px Arial";
    ctx.fillStyle = "#000000";
    ctx.textBaseline = "top";
    strgap = (width) / 4;
    let color = ['#0000FF', '#00FF00', '#FF0000', '#f9dc0e', '#c76104', '#b800f4'];

    //使用迴圈將驗證碼拆成單一字元，各別處理位置和顏色
    for (let i = 0; i < str.length; i++) {
        let char = str.substr(i, 1);
        let charWidth = ctx.measureText(char)       //計算每個字元的寬度
        //使用亂數產生每個字元的x,y坐標
        let strX = Math.random() * ((strgap - charWidth.width) / 2) + (strgap * i);
        let strY = Math.random() * 10;

        color.sort(() => Math.random() - 0.5);      //將陣列亂序
        ctx.fillStyle = color.pop();                //從亂序後的陣列取得一個顏色指定給畫布 
        ctx.fillText(char, strX, strY)              //在畫布中指定位置畫上文字
    }

    //重建顏色陣列
    color = ['#0000FF', '#00FF00', '#FF0000', '#f9dc0e', '#c76104', '#b800f4']

    //亂數決定要產生的干擾線數量(3~5條)
    let lines = Math.floor(Math.random() * 3 + 3)
    for (let i = 0; i < lines; i++) {
        color.sort(() => Math.random() - 0.5);                  //亂序顏色陣列
        ctx.lineWidth = 0.5;                                    //設定線條寬度
        ctx.strokeStyle = color.pop();                          //取得得一個亂序後的隨機顏色
        ctx.beginPath()                                         //開始設定畫線路徑
        let startTop = Math.floor(Math.random() * height);      //設定畫線的起點x,y坐標
        let startLeft = Math.floor(Math.random() * 50)
        let endTop = Math.floor(Math.random() * height);        //設定畫線的終點x,y坐標
        let endRight = Math.floor(Math.random() * 50 + width - 50)
        ctx.moveTo(startLeft, startTop)                         //移動畫筆到起點
        ctx.lineTo(endRight, endTop)                            //設定直線到終點的路徑
        ctx.closePath()                                         //結束路徑設定
        ctx.stroke()                                            //根據路徑真正開始畫線
    }
}

/** 後台管理功能js */

//玩家留言置頂功能
$(".post-top").on("click", function() {
    let id = $(this).data('id');
    $.post('post_top.php', { id }, () => {
        location.reload();
    })
})

//解除配對
$(".btn-remove").on('click', function() {
    //把解除配對按鈕中的data-ids值以'-'來分割，會得到一個含有要解除配對的兩位玩家的id陣列
    let ids = $(this).data('ids').split('-');
    $.post("remove_match.php", {
        ids
    }, (res) => {
        location.reload();
    })
})

//亂數配對
$(".btn-random").on('click', function() {
    $.post("random_match.php", (res) => {
        location.reload();
    })
})

//管理者回覆留言時彈出回覆留言表單
$(".admin-reply").on("click", function() {
    $(this).parents('.admin-btns').siblings('.user-edit').show();
})

//刪除玩家留言
function delMsg(id) {
    $.post('admin_del.php', { id }, () => {
        location.reload();
    })
}

//取消回覆玩家留言
$(".btn-cancel").on("click", function() {
    $(this).parents('.user-edit').hide()
})

//管理者編輯玩家留言時直接秀出玩家留言表單
$(".admin-edit-icon").on("click", function() {
    let id = $(this).data('id')
    $.get("msg_form_edit.php", { id }, (form) => {
        $(".msg-form").html(form)
        $(".msg-form").removeClass('d-none')
    })
})

//管理者回覆留言表單送出
$(".btn-reply").on("click", function() {
    let id = $(this).data('id')
    let admin_reply = $(this).siblings('.edit-reply').val()
    $.post("admin_reply.php", { id, admin_reply}, (res) => {
        location.reload();
    })
})
