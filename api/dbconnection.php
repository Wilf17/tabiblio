<?php
header('Content-Type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "", "tabiblio");
//$con = mysqli_connect("185.98.131.91", "onsec1453800_7dnf5", "tN6!Vn@3*KQYx1c", "onsec1453800_7dnf5");
if (mysqli_connect_errno()) {
    echo "Erreur de conncection " . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8");

define('ROOT', __DIR__);