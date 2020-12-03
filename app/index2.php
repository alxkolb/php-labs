<?php
$title = "ПР №2, часть 2";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>

<body>
    <h1><?= $title ?></h1>
    <div id="task1">
        <h2>Найти площадь полной поверхности и объем куба по известному ребру</h2>
        <form action="" method="GET"> <input type="hidden" name="task" value="1" />
            Длинна ребра:
            <input type="number" step="0.01" name="val" />
            <input type="submit" value="Найти" />
        </form>
    </div>
    <div id="task2">
        <h2>
            Даны три положительных числа. Проверить, могут ли они быть длинами сторон треугольника.
            Если да, то вычислить радиус вписанной окружности.
        </h2>
        <form action="" method="GET"> <input type="hidden" name="task" value="2" />
            <?php foreach (array('a', 'b', 'c') as $numName) { echo "$numName:"; ?>
            <input type="number" name="<?=$numName?>" />
            <?php } ?>
            <input type="submit" value="Проверить и вычислить" />
        </form>
    </div>
    <div id="task3">
        <h2>
            Дано натуральное число n. Переставить его цифры так, чтобы образовалось максимальное число, записанное теми
            же цифрами.
        </h2>
        <form action="" method="GET"> <input type="hidden" name="task" value="3" />
            Число:
            <input type="number" name="val" />
            <input type="submit" value="Переставить" />
        </form>
    </div>
    <?php if (isset($_REQUEST['task'])) { ?>
    <div>
        <h2>Ответ:</h2>
        <?php require("task2.php"); ?>
    </div>
    <?php } ?>
</body>

</html>