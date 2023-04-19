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
                <h1 id="titolPrincipal"><b>INCIDÈNCIES PEDRALBES</b></h1>
            </header>

            <form action="consultar.php" method="get">
                <div class="form-group princ consul">
                    <input type="number" name="idInc" id="idInc" class="form-control cercar"
                        placeholder="Introdueix l'ID de la teva incidencia..." min="1">
                    <button class="btn btn-primary cercar <?php include "selectorUser.php" ?>"><img
                            src="./img/if.png"></button>
                </div>
            </form>
            <div id="graella">
                <a href="formulario.php">
                    <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                        <img src="./img/add.png">
                        <h2>Crear<br> incidència</h2>
                    </div>
                </a>
                <a href="incidenciesUsuari.php">
                    <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                        <img src="./img/mine.png">
                        <h2>Les Meves<br>incidències </h2>
                    </div>
                </a>
                <?php if ($_SESSION["tipoUser"] < 2) { ?>
                    <a href="llistaincidencies.php">
                        <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                            <img src="./img/list.png">
                            <h2>Llistar<br> incidència</h2>
                        </div>
                    </a>
                <?php } ?>

                <?php if ($_SESSION["tipoUser"] < 3) { ?>

                    <a href="crearActuacion.php">
                        <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                            <img src="./img/write.png">
                            <h2>Registrar<br> actuació</h2>
                        </div>
                    </a>
                <?php } ?>
                <br>
                <?php if ($_SESSION["tipoUser"] < 2) { ?>
                    <a href="chartDepartament_Temps.php">
                        <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                            <img src="./img/book.png">
                            <h2>Consulta<br>departament</h2>
                        </div>
                    </a>

                    <a href="chartObert_tecnic.php">
                        <div class="btn btn-primary ml-2 tarjeta <?php include "selectorUser.php" ?>">
                            <img src="./img/informeTecnic.png">
                            <h2>Informe<br> dels tècnics</h2>
                        </div>
                    </a>
                    
                <?php } ?>
        
            </div>
        </div>
    </div>

</body>
<footer>
    <?php include_once "footer.php"; ?>
</footer>

</html>
