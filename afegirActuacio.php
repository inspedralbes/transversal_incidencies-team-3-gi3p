<!DOCTYPE html>
<html lang="en">
<?php session_start()?>
<head>
    <?php include_once "encabezado.php";?>
    <title>Afegir actuació</title>
</head>
<?php
$idTecnic=$_SESSION["id"];
include_once "conexion.php";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$resultado = $mysqli->query("SELECT idDep, nom FROM DEPARTAMENT");
$DEPARTAMENT = $resultado->fetch_all(MYSQLI_ASSOC);
$resultado2 = $mysqli->query("SELECT idInc FROM INCIDENCIA Where tecnic=$idTecnic");
$incidenciaid = $resultado2->fetch_all(MYSQLI_ASSOC);
?>
<body>
    <div class="main">
    <?php include_once "menuSuperior.php";?>
        <form action="registrarActuacio.php" method="POST">
        

            <select name="idincidencia" id="idincidencia" required class="form-select">
                <?php foreach($incidenciaid as $incidencia){?>
                        <option value="<?php echo $incidencia["idInc"]?>"><?php echo $incidencia["idInc"]?></option>
                    <?php }?>
            </select>
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
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-warning" href="index.php">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
