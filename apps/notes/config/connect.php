<?php
require_once __DIR__ . '/../models/ActiveRecord.php';
$db = mysqli_connect('localhost','root','root','sb_notes');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_error();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
ActiveRecord::setDB($db);