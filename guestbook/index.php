<?php include_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>旅客留言板</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <script src="./library/jquery-3.6.0.min.js"></script>
    <script src="./library/bootstrap.js"></script>
</head>
<body>
    <div>
        <?php
        if(isset($_SESSION['admin'])){
            echo "管理者模式";
        }
        ?>
    </div>
<!--導覽列-->    
<nav class="w-100 bg-info">
<div class=" container d-flex justify-content-between py-3 ">
    <div>
        <div class="col-5">logo</div>
    </div>
    <div class="col-5 d-flex justify-content-between">
        <a>旅客留言</a>
        <a>旅遊搭當配對</a>
        <a>網站管理</a>
    </div>
</div>
</nav>

<!--管理者登入-->
<div id='admin'>
    <form action="login.php" method="post">
        <div>帳號:<input type="text" name="acc"></div>
        <div>密碼:<input type="password" name="pw"></div>
        <div>圖片驗證碼:<input type="text" name="num"></div>
        <div>
            <div id="vernum"></div>
            <div id="reset" onclick="makeNum()">驗證碼重新產生</div>
        </div>
        <div>
            <input type="button" value="送出" onclick="login()">
            <input type="reset" value="重置">
        </div>
    </form>
</div>

<!--留言板區塊-->
<div id="guestbook">
    <div class="">遊客留言板區塊</div>
    <button onclick="$('.msg-form').show()">新增留言</button>

    <!--新增留言區塊-->
    <div>
    <form id="addMsg" action="add_msg.php" method="post" enctype="multipart/form-data">
        <input type="button" value="回留言列表" onclick="$('.msg-form').hide()">
        <div>姓名:<input required type="text" name="name"></div>
        <div>E-mail:<input required type="text" name="email"></div>
        <div>電話:<input required type="tel" name="tel"></div>
        <div>留言內容:
            <textarea required name="msg" cols="30" rows="5"></textarea>
            <input type="file" name="img"> 
        </div>
        <div>留言序號: <input required type="text" name="serial"></div>
        <div>
            <input type="submit" value="送出">
            <input type="reset" value="重置">
        </div>
    </form>
    </div>

    <!--留言列表-->
    <div id="msg-list">
        <?php
        
        $sql="SELECT * FROM `guestbook` 
              Order BY `top` DESC, `created_time` DESC";
        $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){

                ?>
                <div class="msg">
                    <div class="name"><?=$row['name'];?></div>
                    <?php
                    if($row['del']==0){
                        echo "<div class='content'>{$row['msg']}</div>";

                        if($row['show_tel']==1){
                            echo "<div class='tel'>{$row['tel']}</div>";
                        }
                        if($row['show_email']==1){
                            echo "<div class='email'>{$row['email']}</div>";
                        }
                    }

                    ?>
                    <div class="created"><?=$row['created_time'];?></div>
                    <div>
                        <?php
                            if($row['del']==1){
                                echo "已刪除";
                            }
                        ?>
                    </div>
                </div>
        
                <?php

            }
            ?>
    </div>

</div>

<!--最新消息與競賽配對區-->
<div id="match">
<div class="">最新消息與競賽配對公告區塊</div>
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