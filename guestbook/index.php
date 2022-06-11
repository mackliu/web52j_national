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
<nav>
<div>旅客留言</div>
<div>旅遊搭當配對</div>
<div class="admin">網站管理</div>
</nav>
<?php
if(isset($_GET['error']) && $_GET['error']=='login'){
    echo "<div id='admin' style='display:block'>";
    echo "<div style='color:red;text-align:center'>";
    echo "帳號或密碼錯誤，請重新登入";
    echo "</div>";
}else{
    echo "<div id='admin'>";
}
?>

    <form action="login.php" method="post">
        <div>帳號:<input type="text" name="acc"></div>
        <div>密碼:<input type="password" name="pw"></div>
        <div>圖片驗證碼:<input type="text" name="chk"></div>
        <div>
            送出:<input type="submit">
            重設:<input type="reset">
        </div>
    </form>
</div>
<div id="guestbook"></div>
<div id="match"></div>
</body>
</html>
<script>

$(".admin").on('click',()=>{
    $("#admin").show();
})


</script>