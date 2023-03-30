<!DOCTYPE html>
<html lang="ca">

<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include_once "conexion.php"; ?>

    <div class="main">

        <?php include_once "menuSuperior.php"; ?>

        <div class="row">
            <div class="col-12">
                <h1><b>Registrar incidencia</b></h1>
                <form action="registrar.php" method="POST">
                    <div class="form-group">
                        <label for="clase">Departament</label>
                        <select name="clase" id="clase">
                            <?php $sentencia = $mysqli->query("SELECT idDep, nom FROM DEPARTAMENT");
                            $departaments = $sentencia->fetch_all(MYSQLI_ASSOC);

                            foreach ($departaments as $departament) { ?>

                                <option value="<?php echo $departament["idDep"]; ?>"> <?php echo $departament["nom"]; ?>
                                </option>
                                <?php

                            } ?>

                        </select>
                    </div>
                    <div class="form-group" id="descPro">
                        <label for="descripcion">Descripció del problema</label>
                        <textarea placeholder="Descripción" class="form-control" name="descripcion" id="descripcion"
                            cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary <?php include "selectorUser.php" ?>">Guardar</button>
                        <a class="btn btn-secondary ml-2" href="index.php">Volver</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer> <?php include_once "footer.php"; ?></footer>
</html>