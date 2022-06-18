<?php include_once "db.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shanghai Battle !</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./library/fontawesome/fontawesome.css">
    <script src="./library/jquery-3.6.0.min.js"></script>
    <script src="./library/bootstrap.js"></script>
    <style>
    header {
        height: 50vh;
        background:url('./img/main.jpg');
        background-repeat: no-repeat;
        background-size:cover;
        background-position:center;
        color:white;
        text-shadow: 2px 2px 15px #ccc;
        display:flex;
        justify-content: center;
        align-items: center;

    }

    nav a{
        color:white;
    }

    .bg-img{
        background-size:cover;
        background-repeat:no-repeat;
        background-position:center;
        background-color:lightgray;
    }
    </style>
</head>

<body style="padding-top:3.5rem">
    <!--導覽列-->
    <header class="bg-info w-100 ">
        <h1 class="text-center">Weclome to Shanghai Battle!</h1>
    </header>
    <nav class="w-100 position-fixed fixed-top bg-info" style="height:3.5rem">
        <!-- <nav class="w-100 position-sticky sticky-top bg-info"> -->
        <div class=" container d-flex h-100 justify-content-between align-items-center">
            <div class="col-5">
                <div>Shanghai Battle !</div>
            </div>
            <div class="col-5 d-flex justify-content-between text-white">
                <a href="#guestboard">玩家留言</a>
                <a href="#gameboard" onclick="$('.reg-form').removeClass('d-none')">玩家參賽</a>
                <a href="#" onclick="$('#admin').removeClass('d-none');makeNum()">網站管理</a>
            </div>
        </div>
    </nav>
    <!--管理者登入-->
    <div id='admin' class="container my-3 d-none">
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
    </div>

    <!--留言板區塊-->
    <a name="guestboard">
        <!--留言區橫幅-->
        <div class="vh-100 overflow-hidden">

            <!--留言內容區-->
            <div id="guestbook" class="container">
                <h2 class="text-center">遊客留言板</h2>
                <button class="btn btn-primary" id="addNewMsg">新增留言</button>

                <!--新增留言區塊-->
                <div class="msg-form d-none">

                </div>

                <!--留言列表-->
                <div id="msg-list" class="container overflow-auto border rounded-lg bg-light py-5 my-3" style="height:75vh">
                    <?php
                        $sql="SELECT * FROM `guestbook` 
                              Order BY `top` DESC, `created_time` DESC";
                        $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach($rows as $row){
                    ?>
                    <div class="msg position-relative col-10 my-3 mx-auto border rounded bg-white p-3 shadow-sm d-flex" style="min-height:6rem">
                        <!--TOP顯示-->
                        <?php if($row['top']==1){
                        ?>
                            <div class="position-absolute d-flex justify-content-center bg-primary text-white align-items-center" style="width:3rem;height:3rem;z-index:99;top:-0.15rem;left:-0.15rem">TOP</div>
                        <?php
                        }
                        ?>
                         <div class="user-edit position-absolute p-3" style="right:0;background:rgba(100,200,255,0.7);z-index:99;display:none">
                            <input type="number" name="serial" class="edit-num d-block">
                            <button class="btn-edit btn btn-warning" data-name="<?=$row['name']?>" data-id="<?=$row['id'];?>" >編輯</button>
                            <button class="btn-del btn btn-danger"  data-name="<?=$row['name']?>" data-id="<?=$row['id'];?>" >刪除</button>
                         </div>   
                        <!--右側-->
                        <div class="user-info col-2">
                            <!--顯示圖片或替代圖片-->
                            <?php
                            if($row['del']==0){
                            ?>
                                <div class="rounded-circle  border-0 my-1 mx-auto bg-img" 
                                     style="width:6rem;height:6rem;background-image:url('./img/<?=$row['img'];?>');">
                                </div>
                            <?php
                            }
                            ?>
                            <!--顯示玩家名字並置中-->
                            <div class="text-center m-1">
                                <?=$row['name'];?>&nbsp;
                                <?php 
                                if($row['del']==0){
                                ?>
                                <span class="edit-icon">
                                    <i class="fas fa-edit "></i>
                                </span>
                                
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="user-msg col-9 position-relative">

                            <div class="col-12">
                                <!--顯示玩家留言-->
                            <?=($row['del']==0)?$row['msg']:"<span class='text-danger'>**玩家已自行刪除內容**</span>"?>
                            <?php
                                if($row['admin_reply']!=''){
                                    echo "<hr style='width:85%'>";
                                    echo "管理者回覆:";
                                    echo $row['admin_reply'];
                                }
                            ?>  
                            </div>

                            <!--留言區底部資訊區-->
                            <div class="position-absolute col-12" style="bottom:0">
                                <!--顯示玩家聯絡資訊-->
                                <div class="user-containt d-flex justify-content-start px-2">
                                    <?php
                                    if($row['del']==0){
                                        if($row['show_tel']==1){
                                            echo "<div class='mr-4'><i class='fas fa-phone'></i> : {$row['tel']}</div>";
                                        }
                                        if($row['show_email']==1){
                                            echo "<div><i class='fas fa-envelope'></i> : {$row['email']}</div>";
                                        }
                                    }
    
                               ?>
                                </div>
                                <!--顯示留言時間-->
                                <div class="time-info d-flex justify-content-between px-2">
                                    <div>
                                    <?php if($row['del']==1){  ?>
                                     刪除於:<?=$row['updated_time'];?>
                                    <?php
                                    }elseif($row['created_time']!=$row['updated_time']){
                                    ?>
                                     修改於:<?=$row['updated_time'];?>
                                    <?php  } ?>
                                    </div>
                                    <div>發表於:<?=$row['created_time'];?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
            }
            ?>
                </div>

            </div>
        </div>

        <!--最新消息與參賽配對區-->
        <a name="gameboard">
            <div class="vh-100  overflow-hidden">
                <!--報名參賽表單-->
                <div class="reg-form d-none">
                    <form id="regUser" action="reg_user.php" method="post" enctype="multipart/form-data"
                        class="p-5 mx-auto my-2 col-6">
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
                            <input class="btn btn-info" type="button" onclick="$('.reg-form').addClass('d-none')"
                                value="取消">

                        </div>
                    </form>
                </div>
                <!--配對結果-->
                <h2 class="text-center">最新消息與競賽配對公告</h2>
                <div id="match" class="container bg-light h-75 border rounded-lg p-5">
                    ds

                </div>
            </div>

            </div>
</body>

</html>
<script>
$("#addNewMsg").on("click",()=>{
    $.get("msg_form.php",(form)=>{
        $(".msg-form").html(form)
        $(".msg-form").removeClass("d-none")
    })
})

$(".edit-icon").on("click",function(){
    $(this).parents('.user-info').siblings('.user-edit').show();
})

$(".btn-edit").on("click",function(){
    let name=$(this).data('name')
    let id=$(this).data('id')
    let serial=$(this).siblings('.edit-num').val()
    $.post("chk_serial.php",{name,serial},(res)=>{
        console.log(res)
        if(parseInt(res)===1){
           $.get("msg_form.php",{id},(form)=>{
                $(".msg-form").html(form)
                $(".msg-form").removeClass('d-none')
           })
        }else{
            console.log('序號錯誤')
        }
    })
    
})

$(".btn-del").on("click",function(){
    let name=$(this).data('name')
    let id=$(this).data('id')
    let serial=$(this).siblings('.edit-num').val()
    $.post("chk_serial.php",{name,serial},(res)=>{
        console.log(res)
        if(parseInt(res)===1){
            $.post("user_del.php",{id},()=>{ location.reload() })
        }else{
            alert('序號錯誤')
        }
    })
})

function send(type){
    let serial = $("#addMsg input[name='serial']").val();
    let name=$("#addMsg input[name='name']").val();
    if (serial.length != 4) {
        alert("序號只能4位數字");
    }else{
        if(type=='add'){
            $.post('chk_name.php', {
                 name
             }, (res) => {
                 if (parseInt(res)) {
                     alert("姓名重覆");
                 } else {
                     $("#addMsg").submit()
                 }
             }) 
        }else{
            $("#addMsg").submit()
        }
    } 

}

function login() {
    let acc = $("input[name='acc']").val();
    let pw = $("input[name='pw']").val();
    let num = $("input[name='num']").val();
    $.post('chknum.php', {
        num
    }, (res) => {
        if (res) {
            $.post('login.php', {
                acc,
                pw
            }, (res) => {
                res = JSON.parse(res);
                if (res.status == 'error') {
                    alert("帳號或密碼錯誤");
                } else {
                    location.href='admin.php';
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

function makeNum() {
    $.get("vernum.php", (num) => {
        cav(num)
        //$("#vernum").text(num)
    })
}
function cav(str){
let canvas=document.getElementById('numboard');
let ctx=canvas.getContext('2d');
ctx.clearRect(0, 0, canvas.width, canvas.height);
let height=42;
let width=$("#vernum").width();
canvas.height=height;
canvas.width=width;

ctx.font="36px Arial";
ctx.fillStyle="#000000";
ctx.textBaseline="top";
strgap=(width)/4;
let color=['#0000FF','#00FF00','#FF0000','#f9dc0e','#c76104','#b800f4'];
for(let i=0;i<str.length;i++){
    let char=str.substr(i,1);
    let charWidth=ctx.measureText(char)
    let strX=Math.random()*((strgap-charWidth.width)/2)+(strgap*i);
    let strY=Math.random()*10;

    color.sort(() => Math.random() - 0.5);
    ctx.fillStyle=color.pop();
    ctx.fillText(char,strX,strY)
}
color=['#0000FF','#00FF00','#FF0000','#f9dc0e','#c76104','#b800f4']
let lines=Math.floor(Math.random()*3+3)
for(let i=0;i<lines;i++){
    color.sort(() => Math.random() - 0.5);
    ctx.lineWidth=0.5;
    ctx.strokeStyle=color.pop();
    ctx.beginPath()
    let startTop=Math.floor(Math.random()*height);
    let startLeft=Math.floor(Math.random()*50)
    let endTop=Math.floor(Math.random()*height);
    let endRight=Math.floor(Math.random()*50+width-50)
    ctx.moveTo(startLeft,startTop)
    ctx.lineTo(endRight,endTop)
    ctx.closePath()
    ctx.stroke()
}

}
</script>