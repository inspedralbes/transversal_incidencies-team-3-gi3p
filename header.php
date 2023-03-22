<?php 
require_once "conexion.php"; 
?>

<header>
<p>
<?php echo $_SESSION["username"] ?></p>
<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</header>