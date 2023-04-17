<!DOCTYPE html>
<html lang="ca">

<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>

<?php
$mysqli = include_once "conexion.php";
include_once "menuSuperior.php";
?>

<body>
    <div class="main">

        <header id="containerTitol">
            <h1 id="titolPrincipal"><b>Incidències per Tècnic</b></h1>
        </header>


        <div id="taulaIncidencies">
            <div id="titolTaulaIncidenciesObertes">
                </table>
                <p class="campIncidenciaDescripcio">Descripcio</h5>
                <p class="campIncidenciaDataa">Data</h5>
                <p class="campIncidenciaPrioritatt">Prioritat</p>
                <p class="campIncidenciaNombree">Nombre</p>
 
            </div>
            <?php

            $resultado = $mysqli->query("SELECT  * FROM Incidencies_Obertes_per_Tecnic");
            $incObertes = $resultado->fetch_all(MYSQLI_ASSOC);

            foreach ($incObertes as $incidencia) { ?>
                    <p class="campIncidenciaDep">
                        <?php echo $incidencia["descripcio"] ?>
                    </p>
                    <p class="campIncidenciaData">
                        <?php echo $incidencia["data"] ?>
                    </p>
                    <p class="campIncidenciaPrio">
                    <?php
                        if (empty($incidencia["prioritat"])) {
                            echo "Sense assignar";
                        } else {
                            echo $incidencia["prioritat"];
                        }
                        ?>
                    </p>
                    <p class="campIncidenciaNom">
                    <?php
                        if (empty($incidencia["nombre"])) {
                            echo "Sense assignar";
                        } else {
                            echo $incidencia["nombre"];
                        }
                        ?>
                    </p>
                   
           <?php }?>         
               
        </div>
    </div>
</body>
<?php include("footer.php") ?>
</html>