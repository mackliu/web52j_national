<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>旅客留言板</title>
    <script src="jquery-3.6.0.min.js"></script>
    <style>
        *{
            margin:0;
            padding:0;
            list-style-type:none;
            box-sizing:border-box;
        }
        body{
            width:1000px;
            margin:auto;
        }
        nav{
            display:flex;
            justify-content: space-around;
        }
        nav div{
            border:1px solid #ccc;
            padding:1.5rem;
        }
    #admin{
        display:none;
    }
    </style>
</head>
<body>
    <div>
        <?php
        if(isset($_SESSION['admin'])){
            echo "管理者模式";
        }
        ?>
    </div>
<nav>
<div>旅客留言</div>
<div>旅遊搭當配對</div>
<div class="admin">網站管理</div>
</nav>

<div id='admin'>
    <form action="login.php" method="post">
        <div>帳號:<input type="text" name="acc"></div>
        <div>密碼:<input type="password" name="pw"></div>
        <div>圖片驗證碼:<input type="text" name="chk"></div>
        <div>
            <div id="vernum"></div>
            <div id="reset">驗證碼重新產生</div>
        </div>
        <div>
            <input type="button" value="送出" onclick="login()">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
<div id="guestbook"></div>
<div id="match"></div>
</body>
</html>
<script>
function login(){
    let acc=$("input[name='acc']").val();
    let pw=$("input[name='pw']").val();
    $.post('login.php',{acc,pw},(res)=>{
        res=JSON.parse(res);
        console.log(res)
        if(res.status=='error'){
            alert("帳號或密碼錯誤");

        }else{
           location.reload();
        }
    })
}

//登入畫面被呼叫時,同時去後端撈驗證碼
$(".admin").on('click',()=>{
    $("#admin").show();
    $.get("vernum.php",(num)=>{
        $("#vernum").text(num)
    })
})


</script>