<?php

// session_start();
require('function.php');
require('database.php');

$id = $_POST["id"];

$sql = "SELECT * FROM court WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$res = $stmt->execute();

$val = $stmt->fetch();
$img = $val["img_url"];

unlink($img);

$sql = "DELETE FROM court WHERE id=:id";
$delete = $pdo->prepare($sql);
$delete->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $delete->execute();

if ($status==false) {
    sql_error($delete);
} else {
    redirect("backyard.php");
    exit();
}
