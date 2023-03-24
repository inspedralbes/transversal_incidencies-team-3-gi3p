
<?php
$control=0;
$mysqli = include_once "conexion.php";
$clase = $_POST["clase"];
$descripcion = $_POST["descripcion"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA
(departament, descripcio)
VALUES
(?, ?)");
$sentencia->bind_param("ss", $clase, $descripcion);
$sentencia->execute();
//header("Location: llistaincidencies.php");
$resul=$mysqli->query("SELECT LAST_INSERT_ID() AS id FROM INCIDENCIA");
$id=$resul->fetch_all(MYSQLI_ASSOC);
foreach($id as $id){
    if($control==0){
        echo $id["id"];
        $control=1;
    } 
    
}
?>

