<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯學生</title>
</head>
<body>
    <h1>編輯學生資料表單</h1>
    <!--form:post>input:text*4-->
    <form action="save.php" method="post">
        <?php
            $dsn="mysql:host=localhost;charset=utf8;dbname=school";
            $pdo=new PDO($dsn,'root','');
            $id=$_GET['id'];
            $sql="SELECT * from students where id='{$id}'";

            $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

        ?>
        <div>姓名:<input type="text" name="name" value="<?=$row['name'];?>"></div>
        <div>生日:<input type="text" name="birthday" value="<?=$row['birthday'];?>"></div>
        <div>班級:<input type="text" name="classroom" value="<?=$row['classroom'];?>"></div>
        <div>成績:<input type="text" name="score" value="<?=$row['score'];?>"></div>
        <input type="hidden" name="id" value="<?=$id;?>">
        <div><input type="submit" value="送出"></div>
</form>
</body>
</html>