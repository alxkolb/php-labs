<?php
require_once "../connection.php";
require_once "../html.php";
require_once "../utils.php";

if (isset($_SESSION['login'])) {
    p("Вы уже вошли");
    go("/");
} else {
?>
<h1 style="text-align: center;">Войти</h1>
<style type="text/css">
        input {
            width: 400px;
        }
        form {
            position: relative;
            left: 30%;
        }
    </style>
<div>
<form method="get">
    <input name="login" type="text" placeholder="Логин" required="true" value="<?= $_COOKIE['last_login'] ?>" />
    <br /><input name="password" type="password" placeholder="Пароль" required="true" />
    <input name="send" type="hidden" value="true"/>
    <br /><input type="submit" />
</form>
</div>
<?php
    if (isset($_REQUEST['send'])) {
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        $sql = "select password, priveleges from users where login = '$login'";
        $query = Connection::connect()->query($sql);
        $dbPassword = $query ? $query[0]['password'] : null;
        if (!$query) {
            p("Неверный логин");
        } else if (!password_verify($password, $dbPassword)) {
            p("Неверный пароль");
        } else {
            $_SESSION['login'] = $login;
            $_SESSION['priveleges'] = $query[0]['priveleges'];
            setcookie("last_login", $login, time() + 60*60*24*30 /* 30 дней */);
            p("Вы вошли");
            go("/");
        }
    }
}
