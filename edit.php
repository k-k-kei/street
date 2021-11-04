<?php

require('function.php');
require('database.php');

$area = $_POST["area"];
$station = $_POST["station"];
$distance = $_POST["distance"];

$sql = "SELECT * FROM court WHERE place LIKE '%".$area."%' AND station LIKE '%".$station."%' AND distance LIKE '%".$distance."%'";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

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
        <link rel="stylesheet" href="css/backyard.css">
        <title>Freaks</title>
</head>

<body>

        <div class="content">編集</div>

        <form method="post" action="update.php" enctype="multipart/form-data">
                <div class="form-box">
                        <label>コート名：<input type="text" name="name"
                                        value="<?= h($row['name']) ?>"></label></br>
                        <label>場所：<input type="text" name="place"
                                        value="<?= h($row['place']) ?>"></label></br>
                        <label>最寄り駅：<input type="text" name="station"
                                        value="<?= h($row['station']) ?>"></label></br>
                        <label>駅からの距離：<input type="text" name="distance"
                                        value="<?= h($row['distance']) ?>"></label></br>
                        <label>画像：<input type="file" name="image" class="image-input"></label></br>
                        <label>開店時間：<input type="text" name="starttime"
                                        value="<?= h($row['starttime']) ?>"></label></br>
                        <label>閉店時間：<input type="text" name="endtime"
                                        value="<?= h($row['endtime']) ?>"></label></br>
                        <label>シャワー有無：<input type="text" name="facility"
                                        value="<?= h($row['facility']) ?>"></label></br>
                        <label>料金：<textarea type="text"
                                        name="price"><?= h($row['price']) ?></textarea></label></br>
                        <label>url<input type="text" name="url"
                                        value="<?= h($row['url']) ?>"></label></br>
                        <input type="hidden" name="id"
                                value="<?= h($row['id']) ?>">
                        <input type="submit" value="更新">
                </div>
        </form>

        <a href="index.php">メインへ</a>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/main.js"></script>

</body>

</html>