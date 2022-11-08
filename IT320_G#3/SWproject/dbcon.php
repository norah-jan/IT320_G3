<?php

$sname= "localhost";
$unmae= "root";
$password = "admin";
$db_name = "swproject";

$con = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$con) {
    echo "Connection failed!";
}