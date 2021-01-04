<?php
    class Database {
        public static function GetConnection() {
            $conection = mysqli_connect("localhost", "root", "", "tienda");
            if (mysqli_errno($conection)) {
                return "<h1>Error al conectarse a la Base de Datos</h1>";
            } else {
                return $conection;
            }
        }
    }
?>

