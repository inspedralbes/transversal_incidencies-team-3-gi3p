<div class="modal fade" id="modalIncidencies<?php echo $incidencia["idInc"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Actualitzar incidencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
<?php
$id=$incidencia["idInc"];
$sentencia = $mysqli->prepare("SELECT idInc, descripcio,prioritat,tipus, DEPARTAMENT.nom, USUARIO.id_User as tecnic,data FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDep = INCIDENCIA.departament LEFT JOIN USUARIO ON USUARIO.id_User = INCIDENCIA.tecnic WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
# Obtenemos solo una fila, que será el incidencia a editar
$incidencia = $resultado->fetch_assoc();

if (!$incidencia) {
    exit("No hay resultados para ese ID");
}

?>

<div>
    
    <div class="modalUpdt">
        <form action="actualizar.php" method="POST" id="update<?php echo $incidencia["idInc"]?>">
            <input type="hidden" name="idInc" value="<?php echo $incidencia["idInc"] ?>">
            <input type="hidden" name="data" value="<?php echo $incidencia["data"] ?>">


            <label for="prioritat">Prioritat</label><br>
                <select name="prioritat" class="form-select" id="">
                    <option value="3" <?php if ( $incidencia["prioritat"] == "3") echo('selected') ?> >Alta</option>
                    <option value="2" <?php if ( $incidencia["prioritat"] == "2") echo('selected') ?>>Mitja</option>
                    <option value="1" <?php if ( $incidencia["prioritat"] == "1") echo('selected') ?>>Baixa</option>
            </select><br>

            <label for="tecnic">Tècnic</label><br>
            <select name="tecnic" id="tecnic" class="form-select">
                <option value="0" selected>Sense assignar</option>

            <?php
            $sentenciaTecnic = $mysqli->query("SELECT id_User, CONCAT(USUARIO.nombre,' ',USUARIO.pApellido) AS nomComplet FROM USUARIO WHERE tipo_User=2");
            $tecnics = $sentenciaTecnic->fetch_all(MYSQLI_ASSOC);

            foreach ($tecnics as $tecnic){ ?> 
                    
                    <option <?php if ($tecnic["id_User"] == $incidencia["tecnic"]) echo('selected') ?>  value="<?php echo $tecnic["id_User"]?>"> <?php echo $tecnic["nomComplet"];?> </option> 
            <?php                    
            }
             ?>
            
            </select>
            <br>
            <label for="tipologia">Tipologia</label><br>
            <select name="tipologia" id="tipologia" class="form-select">
                <?php
                    $sentenciaTipus = $mysqli->query("SELECT * FROM TIPOLOGIA");
                    $tipologies = $sentenciaTipus->fetch_all(MYSQLI_ASSOC);

                    foreach ($tipologies as $tipus){ ?> 
                    
                        <option <?php if ($tipus["idTip"] == $incidencia["tipus"]) echo('selected') ?>  value="<?php echo $tipus["idTip"]?>"> <?php echo $tipus["nom"];?> </option> 
            <?php                    
            } 
            ?>
            <br>
            </select>
        </form>
    </div>
</div>

            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tanca</button>
                   <button type="button" onclick=alerta<?php echo $incidencia["idInc"]?>()  class="btn btn-danger" onclick="alerta()" >El·limina</button>
                   <script>
                    function alerta<?php echo $incidencia["idInc"]?>() {
                        
                        Swal.fire({
                            title: 'Estas segur?',
                            text: "No podrás revertir-ho",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, esborra-ho!',
			    cancelButtonText: 'Cancela'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                'Esborrar!',
                                'La incidencia ha sigut borrada',
				'success'
                                ).then(function() {
                                
                                    window.location.href =  "eliminarIncidencia.php?idInc=<?php echo $incidencia['idInc']?>";
                                });
                                
                            }
                            })
                        }

                    </script>
                <input type="submit" form="update<?php echo $incidencia["idInc"]?>" class="btn btn-primary <?php include "selectorUser.php"?>" script value="Enregistra">
            </div>
        </div>
    </div>
</div>