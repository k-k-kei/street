<?php

session_start();
require('function.php');
require('database.php');


$id = $_GET["id"];

$sql = "SELECT * FROM court WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/detail.css">
    <title>Freaks</title>
</head>

<body>
    <div class="header">
        <div class="header-bar">
            <ul class="nav">
                <li class="nav-item">フットサーチとは？</li>
                <li class="nav-item">サルーー</li>
                <li class="nav-item">マガジン</li>
                <li class="nav-item">ストア</li>
            </ul>
            <div class="register">
                <div class="signin">Sign in</div>
                <div class="login">Login</div>
            </div>
        </div>
    </div>

    <div class="main">
        <h1 class="text">詳細</h1>
        <div class="content">
            <div class="image">
                <img src="<?= h($row['img_url']) ?>"
                    alt="">
            </div>
            <div class="info">
                <div class="name">
                    <?= h($row['name']) ?>
                </div>
                <div class="detail-topic">
                    <div class="topic col1">
                        <?= h($row['place']) ?>
                    </div>
                    <div class="topic col2">
                        <?= h($row['station']) ?>
                    </div>
                    <div class="topic col3">
                        <?= h($row['distance']) ?>
                    </div>
                </div>
                <table>
                    <tr>
                        <th>開業時間</th>
                        <td>
                            <?= h($row['starttime']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>終業時間</th>
                        <td>
                            <?= h($row['endtime']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>シャワー</th>
                        <td>
                            <?= h($row['facility']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>料金</th>
                        <td>
                            <?= h($row['price']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>WEBページ</th>
                        <td>
                            <a
                                href="<?= h($row['url']) ?>"><?= h($row['name']) ?>のサイトへ</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="back">
            <a href="index.php">メインへ</a>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>