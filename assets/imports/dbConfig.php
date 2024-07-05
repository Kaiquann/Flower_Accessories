<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$name = 'flower';

$connection = mysqli_connect($server, $user, $pass, $name);

if (!$connection) {
    die("Can't connect to database");
}





