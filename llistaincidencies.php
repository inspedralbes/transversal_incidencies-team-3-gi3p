<?php include_once "encabezado.php"; ?>


<body>
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
        $mysqli = include_once "conexion.php";
        $resultado = $mysqli->query("SELECT idInc, descripcio, prioritat, DEPARTAMENT.nom as departament , CAST(INCIDENCIA.data AS date) AS data, CONCAT(USUARIO.nombre,' ',USUARIO.pApellido,' ',USUARIO.sApellido) as tecnic FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User = INCIDENCIA.tecnic WHERE INCIDENCIA.dataFi IS NULL ORDER BY idInc");
        $incidencies = $resultado->fetch_all(MYSQLI_ASSOC);
        
        foreach ($incidencies as $incidencia) { ?>

        
        <div class="incidencia">
            <p class="campIncidenciaId"><?php echo $incidencia["idInc"] ?></p>
            <p class="campIncidenciaDep"><?php echo $incidencia["departament"] ?></p>
            <p class="campIncidenciaDescripcio"><?php echo $incidencia["descripcio"] ?></p>
            <p class="campIncidenciaPrio"> <?php 
            
            if (empty($incidencia["prioritat"])) {
                echo "Sense assignar";
            } else {
                echo $incidencia["prioritat"];
            } ?> </p>
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


   
</body>
<?php include_once "pie.php"; ?>

