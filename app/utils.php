<?php
function p($string) {
    echo "<p>$string</p>";
}
function go($link) {
    header("Location: $link", true);
}
// $timeFormat = "d.m.Y H:i";
$timeFormat = "d.m.Y";
