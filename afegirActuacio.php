<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$host = "localhost";
$usuario = "a20erigomvil_bd";
$contrasenia = "Ausias123!";
$base_de_datos = "a20erigomvil_incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$resultado = $mysqli->query("SELECT idDepartament, nomDepartament FROM DEPARTAMENT");
$DEPARTAMENT = $resultado->fetch_all(MYSQLI_ASSOC);

?>
<body>
    <form action="registrarActuacio">
        <select name="departament" id="departament" required class="form-control">
            <?php foreach()?>
        </select>
    </form>
</body>
</html>