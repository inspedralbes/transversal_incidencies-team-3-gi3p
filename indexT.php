<!DOCTYPE html>
<html lang="ca">
<?php session_start()?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "encabezado.php";?>
    <title>Incidències Pedralbes</title>
</head>



<body>
<?php $mysqli=include_once "conexion.php";?>
<?php include_once "menuSuperior.php";?>
    <div class="main">
        <div class="body">

            <header id="containerTitol">
                <h1 id="titolPrincipal">Incidencies Pedralbes</h1>
            </header>

            <a href="formulario.php" class="botoPagPrincipal">Crear incidencia</a>
            <a href="selectTecnico.php" class="botoPagPrincipal">Crear actuacion</a>
            <form action="consultar.php" method="get">
            <div class="form-group princ">
                <input type="number" name="idInc" id="idInc" class="princ">
                <button class="btn btn-light">Cercar incidencia</button>
            </div>
            </form>
        </div>
    </div>
</body>

</html>