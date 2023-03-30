<?php
session_start();
//$username = $password = $confirm_password = $nombre = $pApellido = "";
//$username_err = $password_err = $confirm_password_err = "";

include_once "conexion.php";

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty(trim($_POST["username"]))) {
    
    $_SESSION["reg_user_error"] = "Si us plau, introdueixi l'usuari.";
} elseif (!filter_var(trim($_POST["username"]), FILTER_VALIDATE_EMAIL)) {
    $_SESSION["reg_user_error"] = "L'usuari ha de ser un email.";
    $_SESSION["reg_error"] = true;
} else {
    $sql = "SELECT id_User FROM USUARIO WHERE email = ?";
    if ($stmt = mysqli_prepare($mysqli, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = trim($_POST["username"]);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                $_SESSION["reg_user_error"] = "Aquest mail ja té un compte associada.";
            } else {
                $username = trim($_POST["username"]);
            }
        } else {
            echo "Oops! Alguna cosa ha anat malament. Torna-ho a intentar més tard.";
        }

        mysqli_stmt_close($stmt);
    }
}

if (empty(trim($_POST["password"]))) {
    $_SESSION["reg_password_error"] = "Si us plau, introdueix una contrasenya.";
} elseif (strlen(trim($_POST["password"])) < 6) {
    $_SESSION["reg_password_error"] = "La contrasenya ha de tenir un minim de 6 caràcters.";
} else {
    $password = trim($_POST["password"]);
}

if (empty(trim($_POST["confirm_password"]))) {
    $_SESSION["reg_password_confirm_err"] = "Si us plau, introdueix una contrasenya.";
} else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($_SESSION["reg_password_error"]) && ($password != $confirm_password)) {
        $_SESSION["reg_password_confirm_err"] = "Les contrasenyes no coincideixen.";
    }
}

if (empty(trim($_POST["nom"]))) {
    $_SESSION["reg_nom_error"] = "Si us plau, introdueixi el seu nom.";
} else {
    $nombre = trim($_POST["nom"]);
}

if (empty(trim($_POST["pCog"]))) {
    $_SESSION["reg_pcog_error"] = "Si us plau, introdueixi el seu primer cognom.";
} else {
    $pApellido = trim($_POST["pCog"]);
}


$sApellido = trim($_POST["sCog"]);

if (empty($_SESSION["reg_user_error"]) && empty($_SESSION["reg_password_error"]) && empty($_SESSION["reg_password_confirm_err"]) && empty($_SESSION["reg_nom_error"]) && empty($_SESSION["reg_pcog_error"])) {

    $sql = "INSERT INTO USUARIO (email, password,nombre,pApellido,sApellido) VALUES (?, ?,?,?,?)";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_nombre, $param_pApellido, $param_sApellido);


        // Set parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $param_nombre = $nombre;
        $param_pApellido = $pApellido;
        $param_sApellido = $sApellido;

        if (mysqli_stmt_execute($stmt)) {
            session_destroy();
            header("location: index.php");
        } else {
            echo "Oops! Alguna cosa ha anat malament. Torna-ho a intentar més tard.";
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($mysqli);
header("location: index.php");
//}
?>