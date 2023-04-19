<?php

if (!isset($_POST['sort'])) {
    $sort = "TIPO_PRIORITAT.idPrior DESC";
    $sort2 = 3;
    $_POST["sort"] = $sort;
}

switch ($_POST['sort']) {
    case 'fil1':
        $sort = "INCIDENCIA.idInc";
        $sort2 = 1;
        break;
    case 'fil2':
        $sort = "DEPARTAMENT.idDep";
        $sort2 = 2;
        break;
    case 'fil3':
        $sort = "TIPO_PRIORITAT.idPrior DESC";
        $sort2 = 3;
        break;
    case 'fil4':
        $sort = "USUARIO.id_User DESC";
        $sort2 = 4;
        break;
    case 'fil5':
        $sort = "INCIDENCIA.dataFi DESC";
        $sort2 = 5;
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
            <h1><b>Incidències</b></h1>
        </header>

        <?php
        $usuari = $_SESSION['id'];
        $resultado = $mysqli->query("SELECT INCIDENCIA.idInc,DATE_FORMAT(INCIDENCIA.data, '%d-%m-%Y') AS data,INCIDENCIA.descripcio,INCIDENCIA.dataFi,tipus,TIPOLOGIA.nom as TIPO,departament,DEPARTAMENT.nom as DEPT,INCIDENCIA.prioritat,TIPO_PRIORITAT.prioritat as PRIOR,tecnic,CONCAT(USUARIO.nombre,' ',USUARIO.pApellido) AS nomComplet FROM INCIDENCIA LEFT JOIN TIPOLOGIA ON TIPOLOGIA.idTip=INCIDENCIA.tipus JOIN DEPARTAMENT ON DEPARTAMENT.idDep=INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User=INCIDENCIA.tecnic LEFT JOIN TIPO_PRIORITAT ON TIPO_PRIORITAT.idPrior=INCIDENCIA.prioritat WHERE usuari=$usuari ORDER BY $sort");
        $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);
        if (!$incidencies) {
            ?>
            <div id="taulaIncidencies">
                <div id="titolTaulaIncidencies">
                    <p class="campIncidenciaId">id</p>
                    <p class="campIncidenciaDep">Departament</p>
                    <p class="campIncidenciaDescripcio">Descripcio</p>
                    <p class="campIncidenciaPrio">Prioritat</p>
                    <p class="campIncidenciaData">Data inici</p>
                    <p class="campIncidenciaTecnic">Tècnic</p>
                </div>
            </div>
            <p class="buit"> No tens cap incidencia creada, pots crear una <a class="crearInc"
                    href="formulario.php">aqui</a> </p>
            <?php
        } else {
            ?>
            <form action="./incidenciesUsuari.php" method="post" id="formFiltre">
                <label for="sort">Ordenar per:</label>
                <select id="sort" class="form-select form-select-sm" aria-label=".form-select-sm example" name="sort">
                    <option value="fil1" <?php if ($sort2 === 1) {
                        echo "selected";
                    } ?>>Id</option>
                    <option value="fil2" <?php if ($sort2 === 2) {
                        echo "selected";
                    } ?>>Departament</option>
                    <option value="fil3" <?php if ($sort2 === 3) {
                        echo "selected";
                    } ?>>Prioritat</option>
                    <option value="fil4" <?php if ($sort2 === 4) {
                        echo "selected";
                    } ?>>Tècnic</option>
                    <option value="fil5" <?php if ($sort2 === 5) {
                        echo "selected";
                    } ?>>Completades </option>
                </select>
                <input id="enviaFiltre" class="btn btn-primary <?php include "selectorUser.php" ?>" type="submit">
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
                foreach ($incidencies as $incidencia) { ?>
                    <a data-bs-toggle="modal" data-bs-target="#modalActuacionsUsuari<?php echo $incidencia["idInc"] ?>">

                        <?php if (empty($incidencia["dataFi"])) {
                            ?> <div class="incidencia <?php echo $incidencia["PRIOR"] ?> "> <?php
                        } else {
                            ?> <div class="incidencia completada ?> ">
                                    <?php
                        } ?>
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
                    <?php
                    include "modals/modalActuacionsUsuari.php";
                    ?>
                <?php }
        }
        ?>


        </div>
    </div>
</body>
<?php include("footer.php") ?>

</html>