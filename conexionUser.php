<?php 
$id=$_SESSION["id"];
$sentencia=$mysqli->prepare("SELECT CONCAT(USUARIO.nombre,' ',USUARIO.pApellido,' ',USUARIO.sApellido) as NombreCompleto,tipo_User FROM USUARIO WHERE id_User=?");
$sentencia->bind_param("i",$id);
$sentencia->execute();
$resultado=$sentencia->get_result();
$nombre=$resultado->fetch_assoc();

?>