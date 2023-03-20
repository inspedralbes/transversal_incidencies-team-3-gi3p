<?php
include_once "encabezado.php";
$mysqli = include_once "conexion.php";
$id = $_GET["idInc"];
$sentencia = $mysqli->prepare("SELECT idInc, descripcio,prioritat,tipus, DEPARTAMENT.nom, TECNIC.idTec as tecnic,data FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN TECNIC ON TECNIC.idTec = INCIDENCIA.tecnic WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
# Obtenemos solo una fila, que será el incidencia a editar
$incidencia = $resultado->fetch_assoc();



if (!$incidencia) {
    exit("No hay resultados para ese ID");
}

?>
<div class="row">
    <div class="col-12">
        <h1>Actualizar incidencia</h1>
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="idInc" value="<?php echo $incidencia["idInc"] ?>">
            <input type="hidden" name="data" value="<?php echo $incidencia["data"] ?>">

            
            <label for="prioritat">Prioritat</label>
                <select name="prioritat" id="">
                    <option value="Alta">Alta</option>
                    <option value="Mitja">Mitja</option>
                    <option value="Baixa">Baixa</option>
            </select>

            <label for="tecnic">Tècnic</label>
            <select name="tecnic" id="tecnic">
            <?php
            $sentenciaTecnic = $mysqli->query("SELECT id_User, nombre FROM USUARIO WHERE tipo_User=2");
            $tecnics = $sentenciaTecnic->fetch_all(MYSQLI_ASSOC);

            foreach ($tecnics as $tecnic){ ?> 
                    
                    <option <?php if ($tecnic["id_User"] == $incidencia["tecnic"]) echo('selected') ?>  value="<?php echo $tecnic["id_User"]?>"> <?php echo $tecnic["nombre"];?> </option> 
            <?php                    
            }
             ?>
            <option value="0">Sense assignar</option>
            
            </select>
            <label for="tipologia">Tipologia</label>
            <select name="tipologia" id="tipologia">
                <?php
                    $sentenciaTipus = $mysqli->query("SELECT * FROM TIPOLOGIA");
                    $tipologies = $sentenciaTipus->fetch_all(MYSQLI_ASSOC);

                    foreach ($tipologies as $tipus){ ?> 
                    
                        <option <?php if ($tipus["idTip"] == $incidencia["tipus"]) echo('selected') ?>  value="<?php echo $tipus["idTip"]?>"> <?php echo $tipus["nom"];?> </option> 
            <?php                    
            } 
            ?>
            </select>
            <div class="form-group">
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-warning" href="llistaincidencies.php">Volver</a>
            </div>
        </form>
    </div>
</div>
<?php include_once "pie.php"; ?>