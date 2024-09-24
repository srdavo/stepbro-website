<?php
require_once __DIR__ . '/../models/ActiveRecord.php';
$db = mysqli_connect('localhost','root','root','cocounut_sb');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
ActiveRecord::setDB($db);