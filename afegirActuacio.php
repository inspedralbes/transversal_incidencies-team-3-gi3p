<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "encabezado.php";?>
    <title>Document</title>
</head>
<?php
$host = "localhost";
$usuario = "a22lorcrinor_bd";
$contrasenia = "InsPedralbes2022";
$base_de_datos = "a22lorcrinor_incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$resultado = $mysqli->query("SELECT idDep, nom FROM DEPARTAMENT");
$DEPARTAMENT = $resultado->fetch_all(MYSQLI_ASSOC);
$resultado2 = $mysqli->query("SELECT idInc FROM INCIDENCIA");
$incidenciaid = $resultado2->fetch_all(MYSQLI_ASSOC);
?>
<body>
    <form action="registrarActuacio">
        <select name="departament" id="departament" required class="form-control">
            <?php foreach($DEPARTAMENT as $departament){?>
                <option value="<?php echo $departament["idDep"]?>"><?php echo $departament["nom"]?></option>
            <?php } ?>
        </select>
                
        <select>
            <?php foreach($incidenciaid as $incidencia){?>
                    <option value="<?php echo $incidencia["idInc"]?>"><?php echo $departament["idInc"]?></option>
                <?php }?>
        </select>
        <fieldset>
            <legend>Estat de la incidencia</legend>
            <div>
                <input type="checkbox" id="completada" name="completada">
                <label for="completada">Completada</label>
            </div>
        </fieldset>
    </form>
</body>
</html>