<?php

session_start();

require('function.php');
require('database.php');

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
    <link rel="stylesheet" href="css/login.css">
    <title>STREET</title>
</head>

<body>
    <div class="text">
        <h1>ログイン</h1>
    </div>

    <form action="login_act.php" method="post">
        <div>ユーザーID</div><input type="text" name="loginId"><br>
        <div>パスワード</div><input type="password" name="loginPw"><br>
        <input type='hidden' name='csrfToken'
            value='<?= $csrfToken ?>'>
        <input type="submit" value="ログイン">
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>