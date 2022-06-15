<?php include_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shanghai Battle !</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <script src="./library/jquery-3.6.0.min.js"></script>
    <script src="./library/bootstrap.js"></script>
    <style>
        header{
            height:10rem;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_SESSION['admin'])){
        echo "<div>";
        echo "管理者模式";
        echo "</div>";
    }
    ?>

<!--導覽列-->    
<header class="bg-info w-100">
    <h1 class="text-center">Weclome to Shanghai Battle!</h1>
</header>
<nav class="w-100 position-sticky sticky-top bg-info">
    <div class=" container d-flex justify-content-between py-3">
        <div class="col-5">
            <div>Shanghai Battle !</div>
        </div>
        <div class="col-5 d-flex justify-content-between">
            <a>玩家留言</a>
            <a>玩家參賽</a>
            <a>網站管理</a>
        </div>
    </div>
</nav>
<!--管理者登入-->
<div id='admin' class="container my-3">
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
            <div id="vernum" class="bg-dark col-8"></div>
            <div id="reset" class="btn btn-info col-4" onclick="makeNum()">驗證碼重新產生</div>
        </div>
        <div class="text-center my-2">
            <input class="btn btn-primary" type="button" value="送出" onclick="login()">
            <input class="btn btn-warning" type="reset" value="重置">
        </div>
    </form>
</div>

<!--留言板區塊-->
<div id="guestbook" class="container">
    <h1 class="text-center">遊客留言板區塊</h1>
    <button class="btn btn-primary" onclick="$('.msg-form').show()">新增留言</button>

    <!--新增留言區塊-->
    <div class="msg-form d-none">
    <form id="addMsg" action="add_msg.php" method="post" enctype="multipart/form-data"  class="p-5 mx-auto my-2 col-6">
        <h2 class="text-center">新增留言<input class="btn btn-info float-right" type="button" value="回留言列表" onclick="$('.msg-form').hide()"></h2>
        <div class="input-group my-2">
            <label class="justify-content-center col-3 input-group-text" for="name">姓名</label>
            <input class="form-control" required type="text" name="name" id="name"></div>
        <div class="input-group my-2">
            <label class="justify-content-center col-3 input-group-text" for="email">E-mail</label>
            <input class="form-control" required type="text" name="email" id="email"></div>
        <div class="input-group my-2">
            <label class="justify-content-center col-3 input-group-text" for="tel">電話</label>
            <input class="form-control" required type="tel" name="tel" id="tel"></div>
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
            <input class="btn btn-primary" type="submit" value="送出">
            <input class="btn btn-warning" type="reset" value="重置">
            
        </div>
    </form>
    </div>

    <!--留言列表-->
    <div id="msg-list" class="container">
        <?php
        
        $sql="SELECT * FROM `guestbook` 
              Order BY `top` DESC, `created_time` DESC";
        $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){

                ?>
                <div class="msg col-10 my-3 mx-auto border rounded bg-white p-3 shadow-sm d-flex">
                    <div class="user-info col-3">
                        <div src="" alt="" class="rounded-circle bg-light border-0" style="width:8rem;height:8rem"></div>
                        <?=$row['name'];?>
                    </div>
                    <div class="user-msg col-9">
                        <div class="time-info d-flex justify-content-between">
                            <div>修改於:<?=$row['updated_time'];?></div>
                            <div>發表於:<?=$row['created_time'];?></div>
                        </div>
                        <?php
                        if($row['del']==0){
                            echo "<div class='content'>{$row['msg']}</div>";
    
                        }
    
                        ?>
                        <div class="user-containt d-flex justify-content-end">
                           <?php
                                if($row['del']==0){
                                    if($row['show_tel']==1){
                                        echo "<div class='mr-4'>tel:{$row['tel']}</div>";
                                    }
                                    if($row['show_email']==1){
                                        echo "<div>email:{$row['email']}</div>";
                                    }
                                }

                           ?> 
                        
                        </div>
                        <div>
                            <?php
                                if($row['del']==1){
                                    echo "已刪除";
                                }
                            ?>
                        </div>
                    </div>
                </div>
        
                <?php

            }
            ?>
    </div>

</div>

<!--最新消息與參賽配對區-->
<div id="match" class="container">
<h2 class="text-center">最新消息與競賽配對公告區塊</div>

</div>
</body>
</html>
<script>
$("#addMsg").on("submit",function(event){
    event.preventDefault();
    let serial=$("input[name='serial']").val();
    if(serial.length<4){
        alert("序號需要4位數字");
    }else{
        $.post('chk_serial.php',{serial},(res)=>{
            if(parseInt(res)){
                alert("序號重覆,請填寫其他序號");
            }else{
                event.target.submit()
            }
        })
    }
    
})
function login(){
    let acc=$("input[name='acc']").val();
    let pw=$("input[name='pw']").val();
    let num=$("input[name='num']").val();
    $.post('chknum.php',{num},(res)=>{
        if(res){
            $.post('login.php',{acc,pw},(res)=>{
            res=JSON.parse(res);
            if(res.status=='error'){
                alert("帳號或密碼錯誤");
            }else{
               location.reload();
            }
            })
        }else{
            alert("驗證碼錯誤請重新輸入")
            makeNum()
        }

    })

}

//登入畫面被呼叫時,同時去後端撈驗證碼
$(".admin").on('click',()=>{
    $("#admin").show();
    makeNum();
})

function makeNum(){
    $.get("vernum.php",(num)=>{
        $("#vernum").text(num)
    })
}

</script>