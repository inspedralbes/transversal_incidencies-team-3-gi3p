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
include_once "conexion.php";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$resultado = $mysqli->query("SELECT id_User, nombre FROM USUARIO WHERE tipo_User=2");
$Tecnic = $resultado->fetch_all(MYSQLI_ASSOC);

?>
<body>
    <form action="afegirActuacio.php">
       
    <label for="tecnic">Selecciona tecnic</label>
       <select name="tecnic" id="tecnic" required class="form-select">
           <?php foreach($Tecnic as $tecnic){?>
                   <option value="<?php echo $tecnic["id_User"]?>"><?php echo $tecnic["nombre"]?></option>
               <?php }?>
       </select>
       <div class="form-group">
            <button class="btn btn-success">Guardar</button>
            <a class="btn btn-warning" href="index.php">Volver</a>
        </div>
   </form>
</body>