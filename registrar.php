
<?php
$control=0;
$mysqli = include_once "conexion.php";
$clase = $_POST["clase"];
$descripcion = $_POST["descripcion"];
$usuario =$_POST["usuari"];
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
        $pasar=$id["id"];
        $mysqli->query("UPDATE `INCIDENCIA` SET `usuari` = '$usuario' WHERE `INCIDENCIA`.`idInc` = $pasar");

        $control=1;
    } 
    
}
?>
<?php include_once "menuSuperior.php"; ?>
<!DOCTYPE html>
<html lang="cat">
<head>
<?php include_once "encabezado.php"; ?>
<link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
    <div class="mostrarId">
        <h1><br>El teu id es:<br></h1>
        <h1 class="idAMostrar"><?php echo $pasar?></h1>
        <a href="index.php" class="btn btn-primary <?php include "selectorUser.php" ?>">Continua</a>
    </div>
</body>
<footer> <?php include_once "footer.php"; ?></footer>
</html>

