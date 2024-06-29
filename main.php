<?php
header('Content-Type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "", "tabiblio");
//$con = mysqli_connect("localhost", "onsec1453800_7dnf5", "tN6!Vn@3*KQYx1c", "onsec1453800_7dnf5");
if (mysqli_connect_errno()) {
    echo "Erreur de conncection " . mysqli_connect_error();
}

if (isset($_GET['t_k'])) $token = $_GET['t_k'];
else
if (isset($_COOKIE['t_k'])) $token = $_COOKIE['t_k'];

mysqli_set_charset($con, "utf8");

define('API_URL', "http://api-tabiblio.loc:81/");

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'an',
        'm' => 'mois',
        'w' => 'semaine',
        'd' => 'jour',
        'h' => 'heure',
        'i' => 'minute',
        's' => 'seconde',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ?  'il y a ' . array_values($string)[0] : 'à l\'instant';
}
