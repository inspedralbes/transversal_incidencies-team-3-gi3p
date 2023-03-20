
<?php
$mysqli = include_once "conexion.php";
$clase = $_POST["clase"];
$descripcion = $_POST["descripcion"];
$prioridad = $_POST["prioridad"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA
(departament, descripcio, prioritat)
VALUES
(?, ?, ?)");
$sentencia->bind_param("sss", $clase, $descripcion, $prioridad);
$sentencia->execute();
header("Location: llistaincidencies.php");
