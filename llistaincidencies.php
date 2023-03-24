
<!DOCTYPE html>
<html lang="ca">
<?php session_start()?>
<head>
    <?php include_once "encabezado.php"; ?>
    <title>Llistat de incidencies</title>
</head>
<body>
<div class="main">

<?php 
$mysqli=include_once "conexion.php";
include_once "menuSuperior.php";?>

<header id="containerTitol">
        <a href="index.php"><h1 id="titolPrincipal">Incidències</h1></a>
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
        
        $resultado = $mysqli->query("SELECT idInc, descripcio, prioritat, DEPARTAMENT.nom as departament , CAST(INCIDENCIA.data AS date) AS data, USUARIO.nombre as tecnic FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User = INCIDENCIA.tecnic WHERE INCIDENCIA.dataFi IS NULL ORDER BY idInc");
        $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);
        
        foreach ($incidencies as $incidencia) { ?>

        
        <div class="incidencia">
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
            <p class="campIncidenciaData"><?php echo $incidencia["data"] ?></p>
            <p class="campIncidenciaTecnic"><?php 
            
            if (empty($incidencia["tecnic"])) {
                echo "Sense assignar";
            } else {
                echo $incidencia["tecnic"];
            } 
            ?> </p>
            <a class="botoEditar" href="editar.php?idInc=<?php echo $incidencia["idInc"] ?>">Editar</a>
        </div>

        <?php } ?>
        
    </div>


        </div>
</body>
</html>

