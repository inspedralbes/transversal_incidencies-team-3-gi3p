<?php
include_once "encabezado.php";
$mysqli = include_once "conexion.php";
$id = $_GET["idInc"];
$sentencia = $mysqli->prepare("SELECT idInc, descripcio,prioritat,tipus,dataFi, DEPARTAMENT.nom, TECNIC.nom as tecnic,data FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN TECNIC ON TECNIC.idTec = INCIDENCIA.tecnic WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
# Obtenemos solo una+ fila, que será el incidencia a editar
$incidencia = $resultado->fetch_assoc();

if (!$incidencia) {
    exit("No hay resultados para ese ID");
}

?>
<section>
    <h3>Descripció</h3>
    <p> <?php echo $incidencia['descripcio']?> </p>
    <h3>Tècnic</h3>
    <p> <?php if (empty($incidencia["tecnic"])) {
                echo "Sense assignar";
            } else {
                echo $incidencia["tecnic"];
            } ?> 
    </p>
    <h3>Data inici</h3>
    <p> <?php echo $incidencia['data']?> </p>
    <h3>Estat</h3>
    <p><?php if (empty($incidencia["dataFi"])) {
                echo "En procés";
            } else {
                echo "Solucionat el "; echo $incidencia['dataFi'];
            } ?> </p>

</section>