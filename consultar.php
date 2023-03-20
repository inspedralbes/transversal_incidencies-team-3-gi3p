<?php
include_once "encabezado.php";
$mysqli = include_once "conexion.php";
$id = $_GET["idInc"];
$sentencia = $mysqli->prepare("SELECT idInc, descripcio,prioritat,tipus,dataFi, DEPARTAMENT.nom, CONCAT(USUARIO.nombre,' ',USUARIO.pApellido,' ',USUARIO.sApellido) as tecnic,data FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User = INCIDENCIA.tecnic WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
# Obtenemos solo una+ fila, que será el incidencia a editar
$incidencia = $resultado->fetch_assoc();


if (!$incidencia) {
    exit("No hay resultados para ese ID");
}

$resultado= $mysqli->query("SELECT descripcio,data,temps,idAct FROM ACTUACIO WHERE incidencia = $id AND visible = 1 ORDER BY idAct");
$actuacions = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<section>
    <div class="con-desc"><h3>Descripció</h3>
    <p> <?php echo $incidencia['descripcio']?> </p>
    <h3>Tècnic</h3>
    <p> <?php if (empty($incidencia["tecnic"])) {
                echo "Sense assignar";
            } else {
                echo $incidencia["tecnic"];
            } ?> 
    </p></div>
    <div class="con-data">
    <h3>Data inici</h3>
    <p> <?php echo $incidencia['data']?> </p></div>
    <div class="con-estat">
    <h3>Estat</h3>
    <p><?php if (empty($incidencia["dataFi"])) {
                echo "En procés";
            } else {
                echo "Solucionat el "; echo $incidencia['dataFi'];
            } ?> </p></div>
    <h2>Actuacions</h2>



<?php 
if (!$actuacions) {

    echo "No hi ha cap actuació realitzada";
    }else{ ?>
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
        <?php } 
    } ?>


</tbody>
</table>
</section>
