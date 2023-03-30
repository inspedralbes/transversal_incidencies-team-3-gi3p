
<!DOCTYPE html>
<html lang="ca">
<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $mysqli=include_once "conexion.php";
        include_once "menuSuperior.php";?>
    <div class="main">



    <header id="containerTitol">
            <h1 id="titolPrincipal"><b>Incidències</b></h1>
        </header>
        
        <div id="taulaIncidencies">
            <div id="titolTaulaIncidencies">
                <p class="campIncidenciaId">id</p>
                <p class="campIncidenciaDep">Departament</p>
                <p class="campIncidenciaDescripcio">Descripcio</p>
                <p class="campIncidenciaPrio">Prioritat</p>
                <p class="campIncidenciaData">Data inici</p>
                <p class="campIncidenciaTecnic">Tècnic</p>
                <p class="campIncidenciaAccio">Acció</p>

            </div>
            <?php
            
            $resultado = $mysqli->query("SELECT * FROM incidencies");
            $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);
            
            foreach ($incidencies as $incidencia) { ?>

            
            <div class="incidencia <?php echo $incidencia["prioritat"] ?> ">
                <p class="campIncidenciaId"><?php echo $incidencia["idInc"] ?></p>
                <p class="campIncidenciaDep"><?php echo $incidencia["departament"] ?></p>
                <p class="campIncidenciaDescripcio"><?php echo $incidencia["descripcio"] ?></p>
                <p class="campIncidenciaPrio"><?php
                if(empty($incidencia["prioritat"])){
                    echo "Sense assignar";
                } else{
                    echo $incidencia["prioritat"] ;
                } 
                ?></p>
                <p class="campIncidenciaData"><?php echo $incidencia["DATA"] ?></p>
                <p class="campIncidenciaTecnic"><?php 
                
                if (empty($incidencia["tecnic"])) {
                    echo "Sense assignar";
                } else {
                    echo $incidencia["tecnic"];
                } 
                ?> </p>
                <a class="btn btn-secondary botoEditar" href="editar.php?idInc=<?php echo $incidencia["idInc"] ?>">Editar</a>
            </div>

            <?php } ?>
            
        </div>
    </div>
</body>
<footer> <?php include_once "footer.php"; ?></footer>
</html>

