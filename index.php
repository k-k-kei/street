<?php

session_start();
require('function.php');
require('database.php');

//ソート条件の取得
$area = $_POST["area"];
$station = $_POST["station"];
$distance = $_POST["distance"];

//ソート条件の値取得
$sql = "SELECT * FROM court WHERE place LIKE '%".$area."%' AND station LIKE '%".$station."%' AND distance LIKE '%".$distance."%'";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//セレクトボックスの値
$opt_area = array(
    "大阪市",
    "吹田市",
    "八尾市"
);

$opt_station = array(
    "天王寺",
    "下新庄",
    "久宝寺",
    "住之江公園",
    "鶴見緑地",
    "福島"
);

$opt_distance = array(
    "5分以内",
    "10分以内",
    "10分以上",
);


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
                    <div class="signin">
                        <a href="./signin.php">サインイン</a>
                    </div>
                    <div class="login">
                        <a href="./login.php">ログイン</a>
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
                                    <?php foreach ($opt_area as $opt): ?>
                                    <option value="<?= $opt ?>">
                                        <?= $opt ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li class="tab-item">
                                <div class="label">最寄り駅： </div>
                                <select name="station">
                                    <option value="">---</option>
                                    <?php foreach ($opt_station as $st): ?>
                                    <option value="<?= $st ?>">
                                        <?= $st ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li class="tab-item">
                                <div class="label">駅からの距離： </div>
                                <select name="distance">
                                    <option value="">---</option>
                                    <?php foreach ($opt_distance as $dis): ?>
                                    <option value="<?= $dis ?>">
                                        <?= $dis ?>
                                    </option>
                                    <?php endforeach; ?>
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