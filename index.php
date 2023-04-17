<?php
session_start();
require_once "conexion.php";
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    require "conexionUser.php";
    $_SESSION["tipoUser"] = $nombre["tipo_User"];
    header("location: homeAdmin.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["regCheck"])) {
        if (empty(trim($_POST["usernameLog"]))) {
            $username_err = "Por favor, introduce un usuario.";
        } else {
            $username = trim($_POST["usernameLog"]);
        }

        if (empty(trim($_POST["passwordLog"]))) {
            $password_err = "Por favor, introduzca su contraseña.";
        } else {
            $password = trim($_POST["passwordLog"]);
        }

        if (empty($username_err) && empty($_password_err)) {
            $sql = "SELECT id_User,email,password FROM USUARIO WHERE email=?";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["usernameLog"] = $username;

                                require "conexionUser.php";
                                $_SESSION["tipoUser"] = $nombre["tipo_User"];
                                header("location: homeAdmin.php");

                            } else {
                                $login_err = "Usuario o contraseña incorrectas.";
                            }
                        }
                    } else {
                        $login_err = "Usuario o contraseña incorrectas.";
                    }
                } else {
                    echo "Oops! Alguna cosa ha anat malament. Torna-ho a intentar més tard.";
                }
                mysqli_stmt_close($stmt);
            }

        }
        mysqli_close($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="pruebas.css">
</head>

<script>
    ///MI LLAMADA AL MODAL
    let myModal = new bootstrap.Modal("#exampleModal");
    const modalToggle = document.getElementById('exampleModal');
    myModal.show(modalToggle);
</script>

<script>
    <?php
    if (!empty($_SESSION["reg_user_error"]) || !empty($_SESSION["reg_password_error"]) || !empty($_SESSION["reg_password_confirm_err"]) || !empty($_SESSION["reg_nom_error"]) || !empty($_SESSION["reg_pcog_error"])) { ?>
        $(window).load(function () {
            $('#exampleModal').modal('show');
        });
    <?php } ?>
</script>

<script>
    <?php //if (empty($_SESSION["hola"]) && empty($_SESSION["reg_user_error"]) && empty($_SESSION["reg_password_error"]) && empty($_SESSION["reg_password_confirm_err"]) && empty($_SESSION["reg_nom_error"]) && empty($_SESSION["reg_pcog_error"])) { ?>
        /*const timeout = setTimeout(showMsg, 2000);
        function showMsg() {
            document.getElementById("okMsg").style.display = "block";
        }*/
    <?php //} ?>
</script>



<body>
    <div class="gridLogin">
        <div class="logoInstiContainer">
            <img class="logoInsti" src="img/logo_pedralbes.png" alt="logoInsti">
        </div>
        <div class="verticalLine"></div>
        <div class="wrapperLog loginForm">
            <?php
            if (!empty($login_err)) {
                echo '<div id="login_error" class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>
            <script>
                const myTimeout = setTimeout(hideMessage, 5000);
                function hideMessage() {
                    document.getElementById("login_error").style.display = "none";
                }
            </script>

            <?php
            echo '<div id="okMsg" class="alert alert-success"> Usuari creat correctament! </div>';
            ?>

            <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="usernameLog">Email</label>
                    <input type="email" name="usernameLog" id="usernameLog" placeholder="exemple@exemple.com"
                        class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $username; ?>">
                    <span class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="passwordLog">Contrasenya</label>
                    <input type="password" name="passwordLog" id="passwordLog"
                        placeholder="Introdueixi la seva contrasenya..."
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?> ">
                    <span class="invalid-feedback">
                        <?php echo $password_err; ?>
                    </span>
                </div>
                <br>
                <div class="form-group">
                    <input form="login" type="submit" class="btn btn-primary loginButton" value="Inicia la sessió">
                </div>
                <div class="messLog">
                    <p>No tens compte? <a data-bs-toggle="modal" href="#exampleModal">Registra't ara</a>.</p>
                </div>
            </form>
        </div>
    </div>
</body>

<?php
//$_SESSION["hola"] = "a";
include "modals/modal.php";
?>
<footer> <?php include_once "footer.php"; ?></footer>
</html>