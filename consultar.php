
<!DOCTYPE html>
<html lang="ca">
<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
//$mysqli = include_once "conexion.php";
include_once "menuSuperior.php";?>


<?php

$id = $_GET["idInc"];
$sentencia = $mysqli->prepare("SELECT idInc, descripcio,prioritat,tipus,dataFi, DEPARTAMENT.nom, CONCAT(USUARIO.nombre,' ',USUARIO.pApellido,' ',USUARIO.sApellido) as tecnic,data FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User = INCIDENCIA.tecnic WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
# Obtenemos solo una+ fila, que será el incidencia a editar
$incidencia = $resultado->fetch_assoc();


if (!$incidencia) {
    echo '<script>              
    alert("No s\'ha trobat cap resultat amb aquesta id");
    window.location.href =  "homeAdmin.php";
    
    </script>';
}

$resultado= $mysqli->query("SELECT descripcio,data,temps,idAct FROM ACTUACIO WHERE incidencia = $id AND visible = 1 ORDER BY idAct");
$actuacions = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<div class ="main">
<table class="table table-striped table-light w-25 p-3 ml-auto mr-auto">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Tècnic</th>
                <th scope="col">Data inici</th>
                <th scope="col">Estat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?php echo $incidencia['idInc']?></th>
                <td><?php if (empty($incidencia["tecnic"])) {
                echo "Sense assignar";
            } else {
                echo $incidencia["tecnic"];
            } ?> </td>
                <td><?php echo $incidencia['data']?></td>
                <td><?php if (empty($incidencia["dataFi"])) {
                echo "En procés";
            } else {
                echo "Solucionat el "; echo $incidencia['dataFi'];
            } ?> </td>

            <tr>
                <tr>
                <td colspan=4><?php echo $incidencia['descripcio']?></td>

                </tr>
        </tbody>
</table>
    <h2><b>Actuacions</b></h2>



    <?php
        if (!$actuacions) {
        
            echo "No hi ha cap actuació realitzada";
            }else{ ?>
            <div class="tab">
                <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Data</th>
                        <th scope="col">Descripcio</th>
                        <th scope="col">Temps</th>
                    </tr>
                </thead>
                <tbody>
        
            <?php
                foreach ($actuacions as $actuacio){ ?>
                    <tr>
                        <th scope="row"><?php echo $actuacio["idAct"] ?></th>
                        <td><?php echo $actuacio["data"] ?></td>
                        <td><?php echo $actuacio["descripcio"] ?></td>
                        <td><?php echo $actuacio["temps"] ?></td>
                    <tr>
                <?php } ?>
                </tbody>
                </table> 
                </div>
             <?php } ?>
</section>
<a class="btn btn-secondary ml-2" href="index.php">Tornar</a>

</div>
</body>
<div class="foot">
<footer> <?php include_once "footer.php"; ?></footer>
</div>
</html>
