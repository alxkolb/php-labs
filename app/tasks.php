<?php

class Task6 {
    /*
    Напечатать самое длинное слово, найденное в тексте, находящемся в заданном текстовом файле.
    */
    public static function run() {
        $file = file("task6.txt");
        $words = array();
        $text = "";
        foreach ($file as $line) {
            $words = array_merge($words, preg_split("/[\s,]+/", $line));
            $text = $text . $line . "<br>";
        }

        $maxLengthWorld = "";
        foreach ($words as $word) {
            if (strlen($word) > strlen($maxLengthWorld))
                $maxLengthWorld = $word;
        }
        return array("word" => $maxLengthWorld, "text" => $text);
    }
}

class Task7 {
    /*
    Реализовать с файлами действия в соответствии с вариантом группы функций:
    (результаты выполнения представить в отчете, наименование фалов – ФИО_студента)
    Создание и удаление файлов, Получение информации о файле.
    */

    public static function mkfile(string $fileName="kolbasov.a.a") {
        return "Статус создания: " . (touch($fileName) == 1 ? "создан" : "ошибка");
    }

    public static function rmfile(string $fileName="kolbasov.a.a") {
        return "Статус удаления: " . (unlink($fileName) == 1 ? "удалён" : "ошибка");
    }

    public static function info(string $fileName="kolbasov.a.a") {
        if (!file_exists($fileName)) return "Файл не найден";

        $type = filetype($fileName);
        $size = filesize($fileName);
        $timeStamp = "d.m.Y H:i:s";
        $createTime = date($timeStamp, filectime($fileName));
        $editTime = date($timeStamp, filemtime($fileName));

        return "
        <br>Тип: $type
        <br>Размер: $size B
        <br>Время создания: $createTime
        <br> Время модификации: $editTime
        ";
    }
}
