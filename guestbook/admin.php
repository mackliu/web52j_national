<?php include_once "./api/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shanghai Battle ! - ADMIN</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./library/fontawesome/fontawesome.css">
    <script src="./library/jquery-3.6.0.min.js"></script>
    <script src="./library/bootstrap.js"></script>
    <link rel="stylesheet" href="style.css">
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
                <a href="#guestboard">留言管理</a>
                <a href="#gameboard">賽制管理</a>
                <a href="#" onclick="location.href='./api/logout.php'">登出</a>
            </div>
        </div>
    </nav>

    <!--留言板區塊-->
    <a name="guestboard">
        <!--留言區橫幅-->
        <div class="row-height overflow-hidden">

            <!--留言內容區-->
            <div id="guestbook" class="container">
                <h2 class="text-center">遊客留言管理</h2>
                <!--管理者編輯留言區塊-->
                <div class="msg-form d-none">
                    <!--編輯留言表單以ajax的方式來載入-->
                </div>
                <!--留言列表-->
                <div id="msg-list" class="container border rounded-lg bg-light py-5 my-3">
                <?php
                    $sql = "SELECT * FROM `guestbook` 
                              Order BY `top` DESC, `created_time` DESC";
                    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rows as $row) {
                ?>
                    <div class="msg position-relative col-10 my-3 mx-auto border rounded bg-white p-3 shadow-sm d-flex"
                        style="min-height:10rem">
                        <!--TOP顯示-->
                    <?php if ($row['top'] == 1) { ?>
                        <div class="position-absolute d-flex justify-content-center bg-primary text-white align-items-center"
                            style="width:3rem;height:3rem;z-index:99;top:-0.15rem;left:-0.15rem">TOP</div>

                    <?php } ?>
                        <!--管理者功能區-->
                        <div class="admin-btns text-right position-absolute" style="z-index:10;right:5px">
                            <span class="mx-2 post-top" data-id="<?= $row['id']; ?>"><i
                                    class="fas fa-sort-amount-up"></i></span>
                            <span class="mx-2 admin-reply"><i class="fas fa-reply"></i></span>
                            <span class="mx-2 " onclick="delMsg(<?= $row['id']; ?>)"><i class="fas fa-trash"></i></span>
                        </div>
                        <!--回覆留言表單-->
                        <div class="user-edit position-absolute p-3"
                            style="right:0;background:rgba(100,200,255,0.7);z-index:99;display:none">
                            <input type="text" name="admin_reply" class="edit-reply d-block" style="width:20rem">
                            <button class="btn-reply btn btn-warning" data-id="<?= $row['id']; ?>">回覆</button>
                            <button class="btn-cancel btn btn-danger" data-id="<?= $row['id']; ?>">取消</button>
                        </div>
                        <!--右側-->
                        <div class="user-info col-2">
                            <!--顯示圖片或替代圖片-->
                        <?php if ($row['del'] == 0) { ?>
                            <div class="rounded-circle  border-0 my-1 mx-auto bg-img"
                                style="width:6rem;height:6rem;background-image:url('./img/<?= $row['img']; ?>');">
                            </div>
                        <?php } ?>
                            <!--顯示玩家名字並置中-->
                            <div class="text-center m-1">
                                <?= $row['name']; ?>&nbsp;
                            <?php if ($row['del'] == 0) { ?>
                                <span class="admin-edit-icon" data-id="<?= $row['id']; ?>">
                                    <i class="fas fa-edit "></i>
                                </span>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="user-msg col-10 position-relative">
                            <div class="col-12">
                            <!--顯示玩家留言-->
                            <?= ($row['del'] == 0) ? $row['msg'] : "<span class='text-danger'>**玩家已自行刪除內容**</span>" ?>
                            <?php
                                if ($row['admin_reply'] != '') {
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
                                    if ($row['del'] == 0) {
                                        if ($row['show_tel'] == 1) {
                                            echo "<div class='mr-4'><i class='fas fa-phone'></i> : {$row['tel']}</div>";
                                        }
                                        if ($row['show_email'] == 1) {
                                            echo "<div><i class='fas fa-envelope'></i> : {$row['email']}</div>";
                                        }
                                    }
                                ?>
                                </div>
                                <!--顯示留言時間-->
                                <div class="time-info d-flex justify-content-between px-2">
                                    <div>
                                    <?php if ($row['del'] == 1) {  ?>
                                        刪除於:<?= $row['updated_time']; ?>
                                    <?php } elseif ($row['created_time'] != $row['updated_time']) { ?>
                                        修改於:<?= $row['updated_time']; ?>
                                     <?php  } ?>
                                    </div>
                                    <div>發表於:<?= $row['created_time']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!--最新消息與參賽配對區-->
        <a name="gameboard">
        <div class="row-height  overflow-hidden">
            <!--配對結果-->
            <h2 class="text-center">賽制管理</h2>
            <div id="match" class="container bg-light h-75 border rounded-lg p-5">
                <!--已配對玩家區-->
                <h3 class='text-center'>已配對玩家</h3>
                <div class="d-flex flex-wrap w-100">
                <?php
                    //先撈出所有已配對的玩家
                    $matchs = $pdo->query("select * from `match_player` where `group_tag`!='0'")->fetchAll();
                    //宣告一個空陣列來存放各組玩家
                    $groups = [];
                    foreach ($matchs as $player) {
                        //使用group_tag欄位把同組的玩家放在同一個陣列中
                        $groups[$player['group_tag']][] = $player;
                    }
                
                    //使用迴圈讀出每一組配對資料
                    foreach ($groups as $group) {
                ?>
                    <!--建立一個1/3寬度的空間來放置已配對資料-->
                    <div class="my-4 px-3 col-4">
                        <!--建立一個白底圓邊帶陰影的區塊，增加一點底部padding來放置解除配對按鈕-->
                        <div class="w-100 position-relative bg-white shadow rounded d-flex justify-content-around pb-4">
                            <div class="w-100 position-absolute text-center" style="bottom:1rem">
                                <!--在按鈕中紀錄要解除的玩家id-->
                                <button class="btn btn-danger btn-remove" data-ids="<?= $group[0]['id'] . '-' . $group[1]['id']; ?>">解除配對</button>
                            </div>
                            <!--使用迴圈讀出每一組的玩家-->
                            <?php foreach ($group as $player) { ?>
                            <div class="p-4 text-center">
                                <div class="rounded-circle bg-img"
                                    style="background-image:url('./img/<?= $player['img']; ?>');width:6rem;height:6rem;">
                                </div>
                                <div><?= $player['name']; ?></div>
                            </div>
                            <?php }  ?>
                        </div>
                    </div>
                    <?php }  ?>
                </div>
                <!--尚未配對玩家區-->
                <?php
                //先取得尚未配對的玩家資料
                $noMatchs = $pdo->query("select * from `match_player` where `player`='0'")->fetchAll();

                 //如果有玩家尚未配對，則顯示等待配對的玩家
                 if(count($noMatchs)>0){
                ?>
                <h3 class='text-center'>等待配對玩家</h3>
                <!--增加底部padding空間來放置亂數配對按鈕-->
                <div class="col-12 px-3">
                    <div class="d-flex flex-wrap bg-white shadow my-4 pb-4 position-relative">
                        <div class="w-100 position-absolute text-center" style="bottom:1rem">
                            <button class="btn btn-success btn-random">亂數配對</button>
                        </div>
                    <?php
                        //撈出所有尚未配對的玩家
                        
                        foreach ($noMatchs as $player) {
                    ?>
                        <div class="p-4 text-center rounded">
                            <div class="rounded-circle bg-img"
                                style="background-image:url('./img/<?= $player['img']; ?>');width:6rem;height:6rem;">
                            </div>
                            <div><?= $player['name']; ?></div>
                        </div>
                <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<script src="js.js"></script>