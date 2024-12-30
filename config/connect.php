<?php
class Connect {
    protected function Conection(){
        $serverName = "localhost";
        //$dbUsername = "u342802217_sb_main";$dbPassword = "F9eXCg;m!c2";$bNamed = "u342802217_sb_main";
        $dbUsername = "root";$dbPassword = "root";$bNamed = "cocounut_sb";
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
