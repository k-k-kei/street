<?php

session_start();

require('database.php');
require('function.php');


    $loginId = $_POST['loginId'];
    $loginPw = $_POST['loginPw'];

    // ログインidで空白を許可しないバリデーション
    //CSRF対策
    if (!empty($_POST['loginId'])) {
        if ($_POST['csrfToken'] === $_SESSION['csrfToken']) {
            $sql = "SELECT * FROM users WHERE u_id=:loginId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':loginId', $loginId);
            $res = $stmt->execute();

            if ($res==false) {
                sql_error($stmt);
            }

            $val = $stmt->fetch();

            // パスワードで空白を許可しないバリデーション
            if (password_verify($loginPw, $val["u_pw"]) === true) {
                if ($val["id"] !="") {
                    $_SESSION["chk_ssid"] = session_id();
                    $_SESSION["u_name"] = $val["u_name"];

                    redirect("index_login.php");
                } else {
                    redirect("login.php");
                    exit();
                }
            } else {
                redirect("login.php");
            }
        } else {
            redirect("login.php");
        }
    } else {
        echo("ログイン情報が空白です");
    }
