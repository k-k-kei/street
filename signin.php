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
        <h1>サインイン</h1>
    </div>

    <form action="signin_act.php" method="post">
        <div>ユーザー名</div><input type="text" name="u_name"><br>
        <div>ユーザーID</div><input type="text" name="u_id"><br>
        <div>パスワード</div><input type="password" name="u_pw"><br>
        <input type='hidden' name='csrfToken'
            value='<?= $csrfToken ?>'>
        <input type="submit" value="サインイン">
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>