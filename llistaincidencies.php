<?php

if(!isset($_POST['sort'])){
    $sort = "TIPO_PRIORITAT.idPrior DESC";
    $_POST["sort"] = $sort;
}

switch ($_POST['sort']) {
    case 'fil1':
        $sort = "INCIDENCIA.idInc";
        break;
    case 'fil2':
        $sort = "DEPARTAMENT.idDep";
        break;
    case 'fil3':
        $sort = "TIPO_PRIORITAT.idPrior DESC";
        break;
    case 'fil4':
        $sort = "USUARIO.id_User DESC";
        break;
}

?>

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

<?php
$mysqli = include_once "conexion.php";
include_once "menuSuperior.php";
?>

<body>
    <div class="main">

        <header id="containerTitol">
            <h1 id="titolPrincipal"><b>Incidències</b></h1>
        </header>

        <form action="./llistaincidencies.php" method="post" id="formFiltre">
            <label for="sort">Ordenar per:</label>
            <select id="sort" class="form-select form-select-sm" aria-label=".form-select-sm example" name="sort">
                <option value="fil1">Id</option>
                <option value="fil2">Departament</option>
                <option value="fil3">Prioritat</option>
                <option value="fil4">Tècnic</option>
            </select>
            <input id="enviaFiltre" class="btn btn-primary <?php include "selectorUser.php"?>" type="submit">
        </form>

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

            $resultado = $mysqli->query("SELECT INCIDENCIA.idInc,DATE_FORMAT(INCIDENCIA.data, '%d-%m-%Y') AS data,INCIDENCIA.descripcio,INCIDENCIA.dataFi,tipus,TIPOLOGIA.nom as TIPO,departament,DEPARTAMENT.nom as DEPT,INCIDENCIA.prioritat,TIPO_PRIORITAT.prioritat as PRIOR,tecnic,CONCAT(USUARIO.nombre,' ',USUARIO.pApellido) AS nomComplet FROM INCIDENCIA LEFT JOIN TIPOLOGIA ON TIPOLOGIA.idTip=INCIDENCIA.tipus JOIN DEPARTAMENT ON DEPARTAMENT.idDep=INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User=INCIDENCIA.tecnic LEFT JOIN TIPO_PRIORITAT ON TIPO_PRIORITAT.idPrior=INCIDENCIA.prioritat ORDER BY $sort");
            $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);

            foreach ($incidencies as $incidencia) { ?>
            <a data-bs-toggle="modal"
                        data-bs-target="#modalIncidencies<?php echo $incidencia["idInc"] ?>">
                <div class="incidencia <?php echo $incidencia["PRIOR"] ?> ">
                
                    <p class="campIncidenciaId">
                        <?php echo $incidencia["idInc"] ?>
                    </p>
                    <p class="campIncidenciaDep">
                        <?php echo $incidencia["DEPT"] ?>
                    </p>
                    <p class="campIncidenciaDescripcio">
                        <?php echo $incidencia["descripcio"] ?>
                    </p>
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
                    <?php include("modals/modalActualitzarIncidencia.php") ?>

            <?php } ?>

        </div>
    </div>
</body>
<?php include("footer.php") ?>

</html>
