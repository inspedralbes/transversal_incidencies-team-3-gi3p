<!DOCTYPE html>

<html lang="en">
<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
    <title>Incidencies Pedralbes</title>
</head>
<body>
    <?php
        $sentencia = $mysqli->prepare("SELECT id_User, nombre FROM USUARIO WHERE tipo_User=2");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
    # Obtenemos solo una fila, que será el incidencia a editar
        $user = $resultado->fetch_assoc();
    ?>
    <form>
        <label for="tecnic">Tecnic</label>
        <select name="tecnic" class="form-select" id="">
            <?php foreach ($user as $user) ?>
                <option value="Alta" <?php if ( $incidencia["prioritat"] == "Alta") echo('selected') ?> >Alta</option>
                <option value="Mitja" <?php if ( $incidencia["prioritat"] == "Mitja") echo('selected') ?>>Mitja</option>
                <option value="Baixa" <?php if ( $incidencia["prioritat"] == "Baixa") echo('selected') ?>>Baixa</option>
        </select>
    </form>
</body>
</html>