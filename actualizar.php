
<?php
$mysqli = include_once "conexion.php";
$id = $_POST["idInc"];
$data = $_POST["data"];
$nouPrior = $_POST["prioritat"];
$tipus = $_POST["tipologia"];
$nouTecn = $_POST["tecnic"];

if ($nouTecn == "0"){
    $nouTecn = NULL;
}
$sentencia = $mysqli->prepare("UPDATE INCIDENCIA SET  prioritat = ?,data = ?,tipus = ?, tecnic = ?
WHERE idInc = ?;");
$sentencia->bind_param("isiii", $nouPrior,$data,$tipus,$nouTecn, $id);
$sentencia->execute();
header("Location: llistaincidencies.php");
?>