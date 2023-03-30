<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Registrar-se</title>
    <?php //include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="pruebas.css">
</head>

<h2>Inscriu-te</h2>
<!--<form id="register" onsubmit="submitMessage()" action="register.php" method="post">-->
<form id="register" action="register.php" method="post">
    <input type="hidden" name="regCheck" id="regCheck" value="1">
    <div class="form-group">
        <label for="username">Email</label>
        <input type="text" name="username" id="username" placeholder="example@example.com" class="form-control 
            <?php
            if ((!empty($_SESSION["reg_user_error"]))) {
                echo 'is-invalid';
            }
            ?>
        ">
        <span class="invalid-feedback">
            <?php echo $_SESSION["reg_user_error"];
            unset($_SESSION["reg_user_error"]);
            ?>
        </span>
    </div>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Inserti el seu nom" class="form-control
        <?php
        if ((!empty($_SESSION["reg_nom_error"]))) {
            echo 'is-invalid';
        }
        ?>
        ">
        <span class="invalid-feedback">
            <?php echo $_SESSION["reg_nom_error"];
            unset($_SESSION["reg_nom_error"]);
            ?>
        </span>
    </div>
    <div class="form-group">
        <label for="pCog">Primer Cognom</label>
        <input type="text" name="pCog" id="pCog" placeholder="Inserti el seu primer cognom." class="form-control
        <?php
        if ((!empty($_SESSION["reg_pcog_error"]))) {
            echo 'is-invalid';
        }
        ?>
        ">
        <span class="invalid-feedback">
            <?php echo $_SESSION["reg_pcog_error"];
            unset($_SESSION["reg_pcog_error"]);
            ?>
        </span>
    </div>
    <div class="form-group">
        <label for="sCog">Segon Cognom</label>
        <input type="text" name="sCog" id="sCog" class="form-control"
            placeholder="Inserte su segundo apellido... (Opcional)">
    </div>
    <div class="form-group">
        <label for="password">Contrasenya</label>
        <input type="password" name="password" id="password" placeholder="Introdueixi la contrasenya..." class="form-control 
            <?php
            if ((!empty($_SESSION["reg_password_error"]))) {
                echo 'is-invalid';
            }
            ?>">
        <span class="invalid-feedback">
            <?php echo $_SESSION["reg_password_error"];
            unset($_SESSION["reg_password_error"]);
            ?>
        </span>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirmi la contrasenya</label>
        <input type="password" name="confirm_password" id="confirm_password"
            placeholder="Torna a escriure la contrasenya..." class="form-control 
            <?php
            if ((!empty($_SESSION["reg_password_confirm_err"]))) {
                echo 'is-invalid';
            }
            ?>">
        <span class="invalid-feedback">
            <?php echo $_SESSION["reg_password_confirm_err"];
            unset($_SESSION["reg_password_confirm_err"]);
            ?>
        </span>
    </div>
    <br>
    <div class="form-group">
        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
    </div>
</form>

</body>

</html>