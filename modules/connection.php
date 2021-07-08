<?php

$bdhost = 'localhost';
$bdname = 'enigma';
$bduser = 'root';
$bdpass = '';

$link = mysqli_connect($bdhost, $bduser, $bdpass, $bdname);

if (mysqli_connect_errno())
{
    echo "Database connection failed.";
}

mysqli_set_charset($link, 'utf8mb4');
