<?php
class Connect {
    protected function Conection(){
        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $bNamed = "sb_notes";
        try {
            $connect = new PDO("mysql:host=$serverName;dbname=$bNamed", $dbUsername, $dbPassword);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect; // Agrega esta línea para devolver la conexión
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}