<?php

session_start();

require('function.php');
require('database.php');

$area = $_POST["area"];
$station = $_POST["station"];
$distance = $_POST["distance"];

$sql = "SELECT * FROM court WHERE place LIKE '%".$area."%' AND station LIKE '%".$station."%' AND distance LIKE '%".$distance."%'";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//CSRF対策
$csrfToken = csrf();
$_SESSION['csrfToken'] = $csrfToken;


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/backyard.css">
    <title>Freaks</title>
</head>

<body>

    <div class="content">コート登録</div>
    <a href="index.php" class="back">メインへ戻る</a>

    <form method="post" action="insert.php" enctype="multipart/form-data">
        <div class="form-box">
            <div>コート名：<input type="text" name="name"></div></br>
            <div>場所：<input type="text" name="place"></div></br>
            <div>最寄り駅：<input type="text" name="station"></div></br>
            <div>駅からの距離：<input type="text" name="distance"></div></br>
            <div>画像：<input type="file" name="image" class="image-input"></div></br>
            <div>開店時間：<input type="text" name="starttime"></div></br>
            <div>閉店時間：<input type="text" name="endtime"></div></br>
            <div>シャワー有無：<input type="text" name="facility"></div></br>
            <div>料金：<textarea type="text" name="price"></textarea></div></br>
            <div>url：<input type="text" name="url"></div></br>
            <input type='hidden' name='csrfToken'
                value='<?= $csrfToken ?>'>
            <input type="submit" value="送信">
        </div>
    </form>

    <form action="" method="post">
        <div class="sort">
            <ul class="tab">
                <li class="tab-item">
                    <label>地域：
                        <select name="area">
                            <option value="">---</option>
                            <option value="世田谷区">世田谷区</option>
                            <option value="渋谷区">渋谷区</option>
                        </select>
                    </label>
                </li>
                <li class="tab-item">
                    <label>最寄り駅：
                        <select name="station">
                            <option value="">---</option>
                            <option value="高円寺">高円寺</option>
                            <option value="渋谷">渋谷</option>
                        </select>
                    </label>
                </li>
                <li class="tab-item">
                    <label>駅からの距離：
                        <select name="distance">
                            <option value="">---</option>
                            <option value="5分以内">5分以内</option>
                            <option value="10分以内">10分以内</option>
                        </select>
                    </label>
                </li>
                <input type="submit" value="検索" class="tab-item">
            </ul>
        </div>
    </form>

    <div class="content">
        <h2>コートリスト</h2>
    </div>

    <div class="post-back">
        <?php foreach ($stmt as $post): ?>
        <div class="items-back">
            <table class="item-table">
                <tr>
                    <td>
                        <?= h($post["name"]) ?>
                    </td>
                    <td>
                        <?= h($post["place"]) ?>
                    </td>
                    <td>
                        <?= h($post["station"]) ?>
                    </td>
                    <td>
                        <?= h($post["distance"]) ?>
                    </td>
                    <td class="update-back">
                        <a
                            href="edit.php?id=<?= h($post['id']) ?>">編集</a>
                    </td>
                </tr>
            </table>
            <form action="delete.php" method="post">
                <div class="delete-back">削除</div>
                <input type="hidden" name="id"
                    value="<?= h($post['id']) ?>">
            </form>
        </div>

        <?php endforeach; ?>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>