<?php
include_once "conexion.php";
$id = $_GET["idInc"];
$mysqli->query("DELETE FROM INCIDENCIA WHERE idInc = $id");
header("location: llistaincidencies.php");
 
?>