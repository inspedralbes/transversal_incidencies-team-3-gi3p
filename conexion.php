<?php
$host = "labs.inspedralbes.cat";
$usuario = "a22lorcrinor_bd";
$contrasenia = "InsPedralbes2022";
$base_de_datos = "a22lorcrinor_incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;
