<?php
require_once "../utils.php";
session_start();
p($_SESSION['login']);
p("Выход...");
session_destroy();
go("/");
