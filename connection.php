<?php

$bdhost = 'localhost';
$bdname = 'enigma';
$bduser = 'root';
$bdpass = '';

$link = mysqli_connect($bdhost, $bduser, $bdpass, $bdname)
    or die("Error connecting to db");

if (mysqli_connect_errno())
{
    echo "Database connection failed.";
}
