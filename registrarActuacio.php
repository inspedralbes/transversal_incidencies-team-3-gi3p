<?php
$mysqli = include_once "conexion.php";
$desc = $_POST["descripcion"];
$id = $_POST["idincidencia"];
$terminada=$_POST["completada"];
$visible= $_POST["visible"];
$min=$_POST["temps"];

echo $id;
if(empty($visible)){
    $visible=0;
}
if(!empty($terminada)){
    $sentencia = $mysqli->prepare("UPDATE INCIDENCIA SET 
    dataFi=? WHERE idInc=?");
    $sentencia->bind_param("si", date("Y-m-d h:i:s"), $id);
    $sentencia->execute();
} 
$sentencia2 = $mysqli->prepare("INSERT INTO ACTUACIO
(descripcio, visible, incidencia, temps)
VALUES
(?, ?, ?, ?)");
$sentencia2->bind_param("siii", $desc,$visible, $id, $min);
$sentencia2->execute();
header("Location: llistaincidencies.php");