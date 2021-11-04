<?php

session_start();

//セッションハイジャック対策
if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()) {
    echo "Login Error!";
    exit();
} else {
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
}

require('function.php');
require('database.php');

$username = $_SESSION["u_name"];

$area = $_POST["area"];
$station = $_POST["station"];
$distance = $_POST["distance"];

// 検索機能
//コートの場所、駅、距離で絞り込み可能
$sql = "SELECT * FROM court WHERE place LIKE '%".$area."%' AND station LIKE '%".$station."%' AND distance LIKE '%".$distance."%'";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>STREET</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-bar">
                <ul class="nav">
                    <li class="nav-item">STREETとは？</li>
                    <li class="nav-item">サルーー</li>
                    <li class="nav-item">マガジン</li>
                    <li class="nav-item">ストア</li>
                </ul>
                <div class="register">
                    <div>ようこそ</div>
                    <div class="login">
                        <?= $username ?>
                    </div>
                    <div>さん</div>
                    <div class="signin logout">
                        <a href="logout.php">ログアウト</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main">
            <div class="main-text">
                <h1>このへんコートある？</h1>
                <p>フットサルコート探しを簡単に</p>

                <!-- フォーム -->
                <form action="" method="post">
                    <div class="sort">
                        <ul class="tab">
                            <li class="tab-item">
                                <div class="label">地域：</div>
                                <select name="area">
                                    <option value="">---</option>
                                    <option value="大阪市">大阪市</option>
                                    <option value="吹田市">吹田市</option>
                                    <option value="八尾市">八尾市</option>
                                </select>
                            </li>
                            <li class="tab-item">
                                <div class="label">最寄り駅： </div>
                                <select name="station">
                                    <option value="">---</option>
                                    <option value="天王寺">天王寺</option>
                                    <option value="下新庄">下新庄</option>
                                    <option value="久宝寺">久宝寺</option>
                                    <option value="住之江公園">住之江公園</option>
                                    <option value="鶴見緑地">鶴見緑地</option>
                                    <option value="福島">福島</option>
                                </select>
                            </li>
                            <li class="tab-item">
                                <div class="label">駅からの距離： </div>
                                <select name="distance">
                                    <option value="">---</option>
                                    <option value="5分以内">5分以内</option>
                                    <option value="10分以内">10分以内</option>
                                </select>
                            </li>
                        </ul>
                        <div class="inout-box">
                            <input type="submit" value="検索" class="search">
                        </div>
                    </div>
                </form>
                <!-- フォーム終わり -->

            </div>
            <div class="main-img"><img src="./image/player.png" alt="" class="firstview"></div>
        </div>

        <div class="content">
            <h2 class="courtlist">コートリスト</h2>
        </div>

        <div class="post">
            <?php foreach ($stmt as $post): ?>
            <div class="item">
                <div class="item-img">
                    <img src="<?= h($post["img_url"]) ?>"
                        alt="">
                </div>
                <div class="item-title">
                    <?= h($post["name"]) ?>
                </div>
                <div class="item-topic">
                    <div class="topic col1">
                        <?= h($post["place"]) ?>
                    </div>
                    <div class="topic col2">
                        <?= h($post["station"]) ?>
                    </div>
                    <div class="item-distance topic col3">
                        <?= h($post["distance"]) ?>
                    </div>
                </div>
                <div class="detail">
                    <a
                        href="detail.php?id=<?= h($post['id']) ?>">詳細</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <a href="backyard.php">管理画面へ</a>

    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>