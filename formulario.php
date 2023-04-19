<!DOCTYPE html>
<html lang="ca">

<head>
    <?php include_once "menuSuperior.php"; ?>

    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>
<?php include_once "conexion.php"; ?>

<body>

    <div class="main">
        <h1><b>Registrar incidència</b></h1>
        <form action="registrar.php" method="POST" class="formulari">
            <div class="form-group">
                <label for="clase"><legend>Departament</legend></label>
                <select name="clase" id="clase" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <?php $sentencia = $mysqli->query("SELECT idDep, nom FROM DEPARTAMENT");
                    $departaments = $sentencia->fetch_all(MYSQLI_ASSOC);

                    foreach ($departaments as $departament) { ?>

                        <option value="<?php echo $departament["idDep"]; ?>"> <?php echo $departament["nom"]; ?>
                        </option>
                        <?php

                    } ?>

                </select>
            </div>
            <div class="form-group" method="POST">
                <label for="descripcion"><legend>Descripció del problema</legend></label>

                <textarea placeholder="Descriu el teu problema" class="form-control" name="descripcion" id="descripcion"
                    cols="10" rows="10" required></textarea>

                <div class="form-check">
                    <input type="hidden" name="usuari" value="<?php echo $_SESSION["id"] ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary <?php include "selectorUser.php" ?>">Enregistra</button>
                    <a class="btn btn-secondary ml-2" href="index.php">Tornar</a>

                </div>
        </form>

    </div>
    </div>


</body>

<?php include_once "footer.php"; ?>

</html>