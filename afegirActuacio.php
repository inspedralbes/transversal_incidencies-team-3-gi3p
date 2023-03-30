<?php include_once "menuSuperior.php";?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <?php include_once "encabezado.php";?>
</head>
<?php
$idTecnic=$_SESSION["id"];
/*include_once "conexion.php";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}*/
$idInc = $_GET["idInc"];
$resultado = $mysqli->query("SELECT idDep, nom FROM DEPARTAMENT");
$DEPARTAMENT = $resultado->fetch_all(MYSQLI_ASSOC);
$resultado2 = $mysqli->query("SELECT idInc,descripcio FROM INCIDENCIA Where tecnic=$idTecnic");
$incidenciaid = $resultado2->fetch_all(MYSQLI_ASSOC);
?>
<body>
    <div class="main">

        <form action="registrarActuacio.php" method="POST">
            <input type="hidden" name="idInc" value="<?php echo $idInc ?>">
            <label>Descripció de l'actuació</label>
            <textarea placeholder="Descripción" class="form-control" name="descripcion" id="descripcion" cols="30" rows="10" maxlength="500" required></textarea>
            <div class="form-group">
            <label for="temps">Temps</label>
            <input type="number" class="form-control" name="temps" id="temps"></input>
            </div>
            <fieldset>
                <legend>Estat de la incidencia</legend>
                <div>
                    <div class="form-check">
                        <input type="checkbox" id="completada" name="completada"class="form-check-input" value=1>
                        <label for="completada" class="form-check-label">Completada</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="visible" name="visible" class="form-check-input" value=1>
                        <label for="visible" class="form-check-label">Visible per l'usuari</label>
                    </div>
                </div>
            </fieldset>
            <div class="form-group">
                <button class="btn btn-primary <?php include "selectorUser.php" ?>">Guardar</button>
                <a class="btn btn-secondary " href="crearActuacion.php">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>