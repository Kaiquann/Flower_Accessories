<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$name = 'websystemassignments';

$connection = mysqli_connect($server, $user, $pass, $name);

if (!$connection) {
    die("Can't connect to database");
}

?>