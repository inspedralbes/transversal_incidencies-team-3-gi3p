<?php

session_start();

if(isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]===true){
    header("location: index.php");
    exit;
}

require_once "conexion.php";

$username=$password="";
$username_err=$password_err=$login_err="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["username"]))){
        $username_err="Por favor, introduce un usuario.";
    }else{
        $username =trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err="Por favor, introduzca su contraseña.";
    }else{
        $password=trim($_POST["password"]);
    }

    if(empty($username_err)&& empty($_password_err)){
        $sql="SELECT id_User,email,password FROM USUARIO WHERE email=?";

        if($stmt = mysqli_prepare($mysqli,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            $param_username=$username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt)==1){
                    mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password,$hashed_password)){
                            session_start();

                            $_SESSION["loggedin"]=true;
                            $_SESSION["id"]=$id;
                            $_SESSION["username"]=$username;

                            header("location: index.php");
                        }else{
                            $login_err="Usuario o contraseña incorrectas.";
                        }
                    }
                }else{
                    echo "Oops! Algo ha salido mal. Vuelve a intentarlo más tarde.";
                }
            }
            mysqli_smt_close($stmt);
        }
    }  
    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="username" id="username" placeholder="example@example.com" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Introduzca su contraseña..." class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>¿No tienes una cuenta? <a href="registerUser.php">Registrate ahora</a>.</p>
        </form>
    </div>
</body>
</html>