

<div class="modal fade" id="modalActuacio<?php echo $incidencia["idInc"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Actuacions</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <?php
        $idInc = & $incidencia["idInc"];
        $resultado= $mysqli->query("SELECT descripcio,data,temps,idAct FROM ACTUACIO WHERE incidencia = $idInc ORDER BY idAct");
        $actuacions = $resultado->fetch_all(MYSQLI_ASSOC);
      
        if (!$actuacions) {
        
            echo "No hi ha cap actuació realitzada";
            }else{ ?>
                <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Data</th>
                        <th scope="col">Descripcio</th>
                        <th scope="col">Temps</th>
                    </tr>
                </thead>
                <tbody>
        
            <?php
                foreach ($actuacions as $actuacio){ ?>
                    <tr>
                        <th scope="row"><?php echo $actuacio["idAct"] ?></th>
                        <td><?php echo $actuacio["data"] ?></td>
                        <td><?php echo $actuacio["descripcio"] ?></td>
                        <td><?php echo $actuacio["temps"] ?></td>
                    <tr>
                <?php } ?>
                </tbody>
                </table> 
             <?php } ?>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
        <a href="afegirActuacio.php?idInc=<?php echo $incidencia["idInc"] ?>"><button type="button" class="btn btn-primary <?php include "selectorUser.php" ?>" >Afegir actuació</button></a> 
      </div>
    </div>
  </div>
</div>