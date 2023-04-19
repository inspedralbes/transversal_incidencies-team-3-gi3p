<div class="modal fade" id="modalActuacionsUsuari<?php echo $incidencia["idInc"] ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actuacions</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="main">
                    <table class="table table-striped table-light  p-3 ml-auto mr-auto">
                    <h2><b>Incidencia</b></h2>

                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Tècnic</th>
                                <th scope="col">Data inici</th>
                                <th scope="col">Estat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <?php echo $incidencia['idInc'] ?>
                                </th>
                                <td>
                                    <?php if (empty($incidencia["tecnic"])) {
                                        echo "Sense assignar";
                                    } else {
                                        echo $incidencia["tecnic"];
                                    } ?>
                                </td>
                                <td>
                                    <?php echo $incidencia['data'] ?>
                                </td>
                                <td>
                                    <?php if (empty($incidencia["dataFi"])) {
                                        echo "En procés";
                                    } else {
                                        echo "Solucionat el ";
                                        echo $incidencia['dataFi'];
                                    } ?>
                                </td>

                            <tr>
                            <tr>
                                <td colspan=4><?php echo $incidencia['descripcio'] ?></td>

                            </tr>
                        </tbody>

                    </table>
                    <h2><b>Actuacions</b></h2>

                    <?php
                    $idInc = &$incidencia["idInc"];
                    $resultado = $mysqli->query("SELECT descripcio,data,temps,idAct FROM ACTUACIO WHERE incidencia = $idInc ORDER BY idAct");
                    $actuacions = $resultado->fetch_all(MYSQLI_ASSOC);

                    if (!$actuacions) {

                        echo "No hi ha cap actuació realitzada";
                    } else { ?>
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
                                foreach ($actuacions as $actuacio) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $actuacio["idAct"] ?>
                                        </th>
                                        <td>
                                            <?php echo $actuacio["data"] ?>
                                        </td>
                                        <td>
                                            <?php echo $actuacio["descripcio"] ?>
                                        </td>
                                        <td>
                                            <?php echo $actuacio["temps"] ?>
                                        </td>
                                    <tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
            </div>
        </div>
    </div>
</div>