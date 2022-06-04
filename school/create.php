<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生</title>
</head>
<body>
    <h1>新增學生資料表單</h1>
    <!--form:post>input:text*4-->
    <form action="add.php" method="post">
        <div>姓名:<input type="text" name="name" id=""></div>
        <div>生日:<input type="text" name="birthday" id=""></div>
        <div>班級:<input type="text" name="classroom" id=""></div>
        <div>成績:<input type="text" name="score" id=""></div>
        <div><input type="submit" value="送出"></div>
</form>
</body>
</html>