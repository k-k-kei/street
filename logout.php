<?php

session_start();
require('function.php');

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// セッションを削除
session_destroy();

redirect("index.php");
exit();
