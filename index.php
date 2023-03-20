<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "encabezado.php";?>
    <title>Document</title>
</head>

<body>
    <div class="body">
        <header id="containerTitol">
            <h1 id="titolPrincipal">Incidencies Pedralbes</h1>
        </header>
        <a href="formulario.php" class="botoPagPrincipal">Crear incidencia</a>
        <a href="llistaincidencies.php" class="botoPagPrincipal">Lista incidencies</a>
        <a href="afegirActuacio.php" class="botoPagPrincipal">Crear actiacuacions</a>
        <form action="consultar.php" method="get">
        <div class="form-group princ">
            <input type="number" name="idInc" id="idInc" class="princ">
            <button class="btn btn-light">Cercar incidencia</button>
        </div>
        </form>
    </div>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</body>

</html>