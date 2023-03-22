<?php 
require_once "conexion.php"; 
?>
<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<div class="menuSuperior">
<p>
<?php echo $_SESSION["username"] ?></p>
<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</div>