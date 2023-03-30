<?php include_once "menuSuperior.php"; ?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
    
</head>
<script>
let myModal = new bootstrap.Modal("#modalActuacio");
    const modalToggle = document.getElementById('modalActuacio');
    myModal.show(modalToggle);

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
</script>
<body>
    
    <div class="main">
        <header id="containerTitol">
            <h1 id="titolPrincipal">Incidències</h1>
        </header>

        <div id="taulaIncidencies">
            <div id="titolTaulaIncidencies">
                <p class="campIncidenciaId">id</p>
                <p class="campIncidenciaDep">Departament</p>
                <p class="campIncidenciaDescripcio">Descripcio</p>
                <p class="campIncidenciaPrio">Prioritat</p>
                <p class="campIncidenciaData">Data inici</p>
                <p class="campIncidenciaTecnic">Tècnic</p>
                <p class="campIncidenciaAccio">Acció</p>
                <p class="campIncidenciaAccio">Acció</p>

            </div>

            <?php
            include_once "conexion.php";
            $idTecnic = $_SESSION["id"];
            $resultado = $mysqli->query("SELECT nombre FROM USUARIO WHERE id_User = $idTecnic");
            $tecnic = $resultado->fetch_assoc();
            $nomTecnic = $tecnic["nombre"];
            $resultado = $mysqli->query("SELECT * FROM incidencies WHERE tecnic = '$nomTecnic'");
            $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);

            foreach ($incidencies as $incidencia) { ?>


                <div class="incidencia <?php echo $incidencia["prioritat"] ?> ">
                    <p class="campIncidenciaId">
                        <?php echo $incidencia["idInc"] ?>
                    </p>
                    <p class="campIncidenciaDep">
                        <?php echo $incidencia["departament"] ?>
                    </p>
                    <p class="campIncidenciaDescripcio">
                        <?php echo $incidencia["descripcio"] ?>
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
                    <p class="campIncidenciaData">
                        <?php echo $incidencia["DATA"] ?>
                    </p>
                    <p class="campIncidenciaTecnic">
                        <?php

                        if (empty($incidencia["tecnic"])) {
                            echo "Sense assignar";
                        } else {
                            echo $incidencia["tecnic"];
                        }

                        ?>
                        
                    </p>
                        <a data-bs-toggle="modal" href="#modalActuacio">Mostrar actuacions</a>
                        <?php include "modals/modalactuacions.php";?> 

            </div>
        <?php } ?>
    </div>
</body>


</html>