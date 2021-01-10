<?php
session_start();
if (!isset($title)) $title = "Аукцион";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link type="text/css" rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="header">
        <a href="/">На главную</a>
        <a href="/auctions">Аукционы</a>
        <?php if (!isset($_SESSION['login'])) { ?>
        <a href="/auth/signin.php">Войти</a>
        <a href="/auth/signup.php">Регистрация</a>
        <?php } else { ?>
        <a href="/account">Настройки аккаунта</a>
        <a href="/auth/signout.php">Выйти</a>
        <?php } ?>
    </div>
    <p><br/></p>
