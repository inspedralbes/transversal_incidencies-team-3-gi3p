<?php include_once "encabezado.php"; ?>
<div class="row">
    <div class="col-12">
        <h1>Registrar incidencia</h1>
        <form action="registrar.php" method="POST">
            <div class="form-group">
                <label for="clase">Departament</label>
                <select name="clase" id="clase" >
                    <option value="CIE">Ciencias</option>
                    <option value="MAT">Matematicas</option>
                    <option value="CAT">Catalan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del problema</label>
                <textarea placeholder="Descripción" class="form-control" name="descripcion" id="descripcion" cols="30" rows="10" required></textarea>
            </div>
           
            <div class="form-group">
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-warning" href="index.php">Volver</a>
                
            </div>
        </form>
    </div>
</div>
<?php include_once "pie.php"; ?>
