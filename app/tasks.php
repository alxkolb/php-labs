<?php

// Обработка запроса
if (isset($_REQUEST['task'])) {
    // № задачи
    $task = $_REQUEST['task'];

    $taskClass = "Task" . $task;
    ( new $taskClass() ) -> run();
}


/**
 * Найти площадь полной поверхности и объем куба по известному ребру
 */
class Task1 {
    function s($lenght) {
        return 6 * ($lenght**2);
    }

    function v($lenght) {
        return $lenght**3;
    }

    public function run() {
        $val = $_REQUEST['val'];
        echo "Площадь = " . self::s($val) . "<br/>Объём = " . self::v($val);
    }
}

/**
 * Даны три положительных числа. Проверить, могут ли они быть длинами сторон треугольника.
 * Если да, то вычислить радиус вписанной окружности.
 */
class Task2 {
    function isTriangle($a, $b, $c) {
        return ($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a);
    }

    /** Полупериметр */
    private function p($a, $b, $c) {
        return ($a + $b + $c) / 2;
    }

    function getRadius($a, $b, $c) {
        if (!self::isTriangle($a, $b, $c)) return null;

        $p = self::p($a, $b, $c);
        return sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
    }

    public function run() {
        // todo: json_decode
        $a = (int) $_REQUEST['a'];
        $b = (int) $_REQUEST['b'];
        $c = (int) $_REQUEST['c'];

        $isTriangle = self::isTriangle($a, $b, $c);
        echo "Треугольник? - " . ($isTriangle ? "Да" : "Нет");
        if ($isTriangle)
            echo "<br/>Радиус вписанной окружности = " . self::getRadius($a, $b, $c);
    }
}
