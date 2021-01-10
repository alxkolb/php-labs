<?php
require_once "../connection.php";
require_once "../html.php";
require_once "../utils.php";

if (isset($_SESSION['login'])) {
    p("Вы уже вошли");
    go("/");
} else {
?>
<h1 class="center">Войти</h1>
<div class="center">
<form method="post">
    <input name="login" type="text" placeholder="Логин" required value="<?= $_COOKIE['last_login'] ?>" />
    <br /><input name="password" type="password" placeholder="Пароль" required />
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
