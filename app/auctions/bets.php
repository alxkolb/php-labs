<?php
require_once "../connection.php";
require_once "../utils.php";
require_once "../html.php";

if (isset($_REQUEST['id'])) {
    $id = (int) $_REQUEST['id'];
    $connection = Connection::connect();
    $sql = "select * from auctions where id = $id";
    $auction = $connection->query($sql);
    $sql = "select * from bets where auction = $id";
    $bets = $connection->query($sql);
    if (!$auction) p("Лот не найден");
    else {
        $maxPrice = 0;
        $title = $auction[0]['title'];
        echo "<h2>$title</h2>";
?>
<table>
    <tr>
        <th>№ заявки</th><th>Ставка</th><th>Пользователь</th><th>Дата</th>
    </tr>
<?php
        foreach ($bets as $bet) {
            $betId = $bet['id'];
            $price = (int) $bet['price'];
            $maxPrice = max($price, $maxPrice);
            $time = (int) $bet['time'];
            $user = $bet['user'];

?>
    <tr>
        <td><?=$betId?></td><td><?=$price?></td><td><?=$user?></td><td><?=$time?></td>
    </tr>
<?php
        }
?>
</table>
<?php
    p("Текущая максимальная ставка: $maxPrice");
        if($_SESSION['login']) {
            $login = $_SESSION['login'];
            ?>
            <p>Сделать ставку:</p>
            <form method="post">
                <!-- <input type="hidden" name="id" value="<?=$id?>"/> -->
                <input type="number" name="newPrice" placeholder="Цена"/>
                <input type="hidden" name="newBet" value="true"/>
                <input type="submit" value="Отправить"/>
                <a href="">Обновить</a>
            </form>
            <?php
            if (isset($_REQUEST['newBet'])) {
                $newPrice = (int) $_REQUEST['newPrice'];
                if ($newPrice <= $maxPrice) p("Ставка ниже текущей максимальной");
                else {
                    $sql = "insert into bets (auction, price, user) values ($id, $newPrice, '$login')";
                    p($sql);
                    $addBet = $connection->query($sql);
                    p($addBet ? "Принято" : "Ошибка");
                }
            }
        }
    }
}
