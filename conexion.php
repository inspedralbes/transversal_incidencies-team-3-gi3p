<?php
$host = "localhost";
$usuario = "a22rauespgom_G3";
$contrasenia = "RaulLorisGalaEric1";
$base_de_datos = "a22rauespgom_G3_Incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;
