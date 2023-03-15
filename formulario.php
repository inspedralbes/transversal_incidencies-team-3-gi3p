<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "encabezado.php"; ?>
</head>
<body>
<div class="row">
    <div class="col-12">
        <h1>Registrar incidencia</h1>
        <form action="registrar.php" method="POST">
            <div class="form-group">
                <label for="clase">Departament</label>
                <select name="clase" id="clase">
                    
                    <?php
                     include_once "conexion.php";

                    $sentencia = $mysqli->query("SELECT idDep, nom FROM DEPARTAMENT");
                    $departaments = $sentencia->fetch_all(MYSQLI_ASSOC);
                
                        foreach ($departaments as $departament) { ?>

                        <option value="<?php echo $departament["idDep"];?>"> <?php echo $departament["nom"];?> </option> <?php

                    } ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del problema</label>
                <textarea placeholder="Descripción" class="form-control" name="descripcion" id="descripcion" cols="30" rows="10" required></textarea>
            </div>
           
            <div class="form-group">
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-warning" href="index.php">Volver</a>
                
            </div>
        </form>
    </div>
</div>
</body>
</html>
