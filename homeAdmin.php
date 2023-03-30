

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>

<?php $mysqli = include_once "conexion.php";
include_once "menuSuperior.php"; ?>

<body>


    <div class="main">
        <div class="body">

            <header id="containerTitol">
                <h1 id="titolPrincipal"><b>INCIDENCIES PEDRALBES</b></h1>
            </header>

            <form action="consultar.php" method="get">
                <div class="form-group princ consul">
                    <input type="number" name="idInc" id="idInc" class="form-control" placeholder="1" min="1">
                    <button class="btn btn-primary cercar <?php include "selectorUser.php" ?>"><img src="./img/if.png"> Cercar incidencia</button>
                </div>
            </form>
            <div id="graella">
                <a href="formulario.php">
                    <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                        <img src="./img/add.png">
                        <h2>Crear<br> incidencia</h2>
                    </div>
                </a>
                <?php if ($_SESSION["tipoUser"] < 2) { ?>
                    <a href="llistaincidencies.php">
                        <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                            <img src="./img/list.png">
                            <h2>Llistar<br> incidencia</h2>
                        </div>
                    </a>
                <?php } ?>

                <?php if ($_SESSION["tipoUser"] < 3) { ?>

                    <a href="crearActuacion.php">
                        <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                            <img src="./img/write.png">
                            <h2>Registrar<br> actuacio</h2>
                        </div>
                    </a>
                <?php } ?>


            </div>
        </div>
      
</body>
<footer> <?php include_once "footer.php"; ?></footer>
</html>