<?php

session_start();

require('function.php');
require('database.php');

$image = date('YmdHis') .$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], './image/' . $image);

$name = $_POST["name"];
$place = $_POST["place"];
$station = $_POST["station"];
$distance = $_POST["distance"];
$img_url = './image/'.$image;
$starttime = $_POST["starttime"];
$endtime = $_POST["endtime"];
$facility = $_POST["facility"];
$price = $_POST["price"];
$url = $_POST["url"];

if ($_POST['csrfToken'] === $_SESSION['csrfToken']) {
    $sql = "INSERT INTO court(name, place, station, distance, img_url, starttime, endtime, facility, price, url, created_date)VALUES(:name, :place, :station, :distance, :img_url, :starttime, :endtime, :facility, :price, :url, sysdate())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':place', $place, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':station', $station, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':distance', $distance, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':img_url', $img_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':starttime', $starttime, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':endtime', $endtime, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':facility', $facility, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute();
} else {
    redirect("index.php");
}

if ($status==false) {
    sql_error($stmt);
} else {
    redirect("index.php");
    exit();
}
