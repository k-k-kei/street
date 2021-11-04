<?php

// session_start();
require('function.php');
require('database.php');

//アップロードされた画像データを取得
$image = date('YmdHis') .$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], './image/' . $image);

//ファイル名を代入
$img_url = './image/'.$image;

// フォーム入力された値をそれぞれ変数に代入
$id = $_POST["id"];
$name = $_POST["name"];
$place = $_POST["place"];
$station = $_POST["station"];
$distance = $_POST["distance"];
$starttime = $_POST["starttime"];
$endtime = $_POST["endtime"];
$facility = $_POST["facility"];
$price = $_POST["price"];
$url = $_POST["url"];

// データを更新
$sql = "UPDATE court SET name=:name, place=:place, station=:station, distance=:distance, starttime=:starttime, endtime=:endtime, facility=:facility, price=:price, url=:url WHERE id=:id";
$update = $pdo->prepare($sql);
$update->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':place', $place, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':station', $station, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':distance', $distance, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':starttime', $starttime, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':endtime', $endtime, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':facility', $facility, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':price', $price, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$update->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $update->execute();

//画像が添付されなければ既存の画像を保持するように分岐処理
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    $sql = "UPDATE court SET img_url=:img_url WHERE id=:id";
    $img_update = $pdo->prepare($sql);
    $img_update->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
    $img_update->bindValue(':img_url', $img_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $img_status = $img_update->execute();
}

if ($status==false) {
    sql_error($update);
} else {
    redirect("backyard.php");
    exit();
}
