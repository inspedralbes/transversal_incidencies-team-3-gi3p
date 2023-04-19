<?php
if (!isset($_POST['grup'])) {
    $grup = 5;
    $_POST["grup"] = $grup;
}

switch ($_POST['grup']) {
    case 'fil1':
        $grup = 5;
        break;
    case 'fil2':
        $grup = 6;
        break;
    case 'fil3':
        $grup = 7;
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
            <h1><b>Informe dels tècnics</b></h1>
        </header>

        <form action="./chartObert_tecnic.php" method="post" id="formFiltre">
            <label for="grup">Mostrar per:</label>
            <select id="grup" class="form-select form-select-sm" aria-label=".form-select-sm example" name="grup">
                <option value="fil1" <?php if($grup===5){echo "selected";} ?>>Álvaro Pérez</option>
                <option value="fil2" <?php if($grup===6){echo "selected";} ?>>Ermengol Bota</option>
                <option value="fil3" <?php if($grup===7){echo "selected";} ?>>Toni Diaz</option>
            </select>
            <input id="enviaFiltre" class="btn btn-primary <?php include "selectorUser.php" ?>" type="submit">
        </form>

        <div id="taulaIncidencies3">
            <div id="titolTaulaIncidencies3">
                <p class="campIncidenciaId">id</p>
                <p class="campIncidenciaDep">Departament</p>
                <p class="campIncidenciaDescripcio">Descripcio</p>
                <p class="campIncidenciaPrio">Prioritat</p>
                <p class="campIncidenciaData">Data inici</p>
                <p class="campTempsEmprat">Temps oberta</p>
            </div>
            <?php
            $resultado = $mysqli->query("SELECT * FROM Incidencies_Obertes_per_Tecnic WHERE Incidencies_Obertes_per_Tecnic.tecnic=$grup;");
            $incObertes = $resultado->fetch_all(MYSQLI_ASSOC);

            foreach ($incObertes as $inc) { ?>
                <div class="incidencia3 <?php echo $inc["PRIOR"] ?>">
                    <p class="campIncidenciaId">
                        <?php echo $inc["idInc"] ?>
                    </p>
                    <p class="campIncidenciaDep">
                        <?php echo $inc["DEPT"] ?>
                    </p>
                    <p class="campIncidenciaDescripcio">
                        <?php echo $inc["descripcio"] ?>
                    </p>
                    <p class="campIncidenciaPrio">
                        <?php
                        if (empty($inc["PRIOR"])) {
                            echo "Sense assignar";
                        } else {
                            echo $inc["PRIOR"];
                        }
                        ?>
                    </p>
                    <p class="campIncidenciaData">
                        <?php echo $inc["data"] ?>
                    </p>
                    <p class="campTempsEmprat">
                        <?php echo $inc["difDies"]?> dies
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
<?php include("footer.php") ?>

</html>