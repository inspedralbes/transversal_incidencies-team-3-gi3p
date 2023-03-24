<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php 
$id=$_SESSION["id"];
$sentencia=$mysqli->prepare("SELECT CONCAT(USUARIO.nombre,' ',USUARIO.pApellido,' ',USUARIO.sApellido) as NombreCompleto FROM USUARIO WHERE id_User=?");
$sentencia->bind_param("i",$id);
$sentencia->execute();
$resultado=$sentencia->get_result();
$nombre=$resultado->fetch_assoc();

?>


<div class="menuSuperior">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <?php echo $nombre["NombreCompleto"]?>
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
    <li>
      <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="logout.php">Sortir</a></li>
  </ul>
</div>


<!--
<nav class="navbar bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menú</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a href="logout.php" class="dropdown-item">Sortir</a></li>
      </ul>
    </div>
  </div>
</nav>
-->