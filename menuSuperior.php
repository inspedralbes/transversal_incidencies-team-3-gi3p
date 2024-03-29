<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
include_once "conexion.php";
?>

<?php
$id = $_SESSION["id"];
$sentencia = $mysqli->prepare("SELECT nombre,pApellido,sApellido,CONCAT(USUARIO.nombre,' ',USUARIO.pApellido,' ',USUARIO.sApellido) as NombreCompleto,tipo_User FROM USUARIO WHERE id_User=?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
$nombre = $resultado->fetch_assoc();
?>

<nav class="menuSup navbar navbar-dark bg-primary <?php include "selectorUser.php" ?>">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo_pedralbes.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Menú (<?php
      if(empty($nombre["sApellido"])){
        echo $nombre["nombre"].' '.$nombre["pApellido"];
      }else{
        echo $nombre["nombre"].' '.$nombre["pApellido"].' '.$nombre["sApellido"];
      }
      ?>)
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="formulario.php">Crear Incidència</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="incidenciesUsuari.php">Veure les meves incidències</a>
        </li>
        <?php if ($nombre["tipo_User"] < 2) { ?>
          <li class="nav-item">
            <a class="nav-link" href="llistaincidencies.php">Llistat d'incidències</a>
          </li>
        <?php } ?>
        <?php if ($nombre["tipo_User"] < 3) { ?>
          <li class="nav-item">
            <a href="crearActuacion.php"><span class="nav-link">Registrar actuació</a>
          </li>
        <?php } ?>
        <?php if ($nombre["tipo_User"] < 3) { ?>
          <li class="nav-item">
            <a href="chartDepartament_Temps.php"><span class="nav-link">Consultar consum per departament</a>
          </li>
        <?php } ?>
        <?php if ($nombre["tipo_User"] < 3) { ?>
          <li class="nav-item">
            <a href="chartObert_tecnic.php"><span class="nav-link">Informe dels tecnics</a>
          </li>
        <?php } ?>
        <li>
          <hr class="separador">
        </li>
        <li>
        <a href="correus.php"><span class="nav-link">Correus</a>
        </li>
        <li>
          <a class="nav-link active" href="logout.php">Sortir del compte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>