<!DOCTYPE html>
<html lang="ca">

<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
    
</head>
<script>
const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
</script>
<?php include_once "menuSuperior.php"; ?>
<body>
    
    <div class="main">
        <header id="containerTitol">
            <h1 id="titolPrincipal"><b>Incidències</b></h1>
        </header>

        <div id="taulaIncidencies">
            <div id="titolTaulaIncidencies">
                <p class="campIncidenciaId">id</p>
                <p class="campIncidenciaDep">Departament</p>
                <p class="campIncidenciaDescripcio">Descripcio</p>
                <p class="campIncidenciaPrio">Prioritat</p>
                <p class="campIncidenciaData">Data inici</p>
                <p class="campIncidenciaTecnic">Tècnic</p>


            </div>

            <?php
            $idTecnic = $_SESSION["id"];
            $resultado = $mysqli->query("SELECT INCIDENCIA.idInc,DATE_FORMAT(INCIDENCIA.data, '%d-%m-%Y') AS data,INCIDENCIA.descripcio,INCIDENCIA.dataFi,tipus,TIPOLOGIA.nom as TIPO,departament,DEPARTAMENT.nom as DEPT,INCIDENCIA.prioritat,TIPO_PRIORITAT.prioritat as PRIOR,tecnic,CONCAT(USUARIO.nombre,' ',USUARIO.pApellido) AS nomComplet FROM INCIDENCIA
            LEFT JOIN TIPOLOGIA ON TIPOLOGIA.idTip=INCIDENCIA.tipus
            JOIN DEPARTAMENT ON DEPARTAMENT.idDep=INCIDENCIA.departament
            LEFT JOIN USUARIO ON USUARIO.id_User=INCIDENCIA.tecnic
            LEFT JOIN TIPO_PRIORITAT ON TIPO_PRIORITAT.idPrior=INCIDENCIA.prioritat
            WHERE INCIDENCIA.tecnic=$idTecnic;");
            $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);

            foreach ($incidencies as &$incidencia) { ?>

            <a  data-bs-toggle="modal" data-bs-target="#modalActuacio<?php echo $incidencia["idInc"] ?>">
                <div class="incidencia <?php echo $incidencia["PRIOR"] ?> ">
                    <p class="campIncidenciaId"><?php echo $incidencia["idInc"]?></p>
                    <p class="campIncidenciaDep"><?php echo $incidencia["DEPT"]?></p>
                    <p class="campIncidenciaDescripcio"><?php echo $incidencia["descripcio"]?></p>
                    <p class="campIncidenciaPrio">
                        <?php
                        if (empty($incidencia["prioritat"])) {
                            echo "Sense assignar";
                        } else {
                            echo $incidencia["PRIOR"];
                        }
                        ?>
                    </p>
                    <p class="campIncidenciaData">
                        <?php echo $incidencia["data"] ?>
                    </p>
                    <p class="campIncidenciaTecnic">
                        <?php

                        if (empty($incidencia["tecnic"])) {
                            echo "Sense assignar";
                        } else {
                            echo $incidencia["nomComplet"];
                        }

                        ?>
                    </p>

            </div>
            </a>
            <?php 
                    include "modals/modalactuacions.php";
                    ?>
        <?php } ?>
    </div>
                    </div>
</body>
<?php include("footer.php") ?>
</html>