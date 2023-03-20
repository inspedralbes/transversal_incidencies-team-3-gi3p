
<?php
$mysqli = include_once "conexion.php";
$clase = $_POST["clase"];
$descripcion = $_POST["descripcion"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA
(departament, descripcio)
VALUES
(?, ?)");
$sentencia->bind_param("ss", $clase, $descripcion);
$sentencia->execute();
header("Location: llistaincidencies.php");
