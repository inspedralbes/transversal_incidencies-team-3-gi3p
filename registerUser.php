<?php
require_once "conexion.php";
 
$username = $password = $confirm_password = $nombre = $pApellido = "";
$username_err = $password_err = $confirm_password_err = "";
$sApellido=NULL;
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Si us plau, introdueixi l'usuari.";
    } elseif(!preg_match('/^[a-zA-Z0-9_@.]+$/', trim($_POST["username"]))){
        $username_err = "L'usuari ha de ser un email.";
    } else{
        $sql = "SELECT id_User FROM USUARIO WHERE email = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Aquest mail ja té un compte associada.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Alguna cosa ha anat malament. Torna-ho a intentar més tard.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Si us plau introdueix una contrasenya...";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contrasenya ha de tenir un minim de 6 caràcters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Si us plau, introdueix una contrasenya.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Les contrasenyes no coincideixen.";
        }
    }
        $nombre= trim($_POST["nom"]);
        $pApellido=trim($_POST["pCog"]);
        $sApellido=trim($_POST["sCog"]);

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO USUARIO (email, password,nombre,pApellido,sApellido) VALUES (?, ?,?,?,?)";
         
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password,$param_nombre,$param_pApellido,$param_sApellido);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nombre=$nombre;
            $param_pApellido=$pApellido;
            $param_sApellido=$sApellido;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="ca">
<?php include_once "encabezado.php";?>
    <div class="wrapper">
        <h2>Registrar</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="username" id="username" placeholder="example@example.com" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Inserti el seu nom" required>
            </div>
            <div class="form-group">
                <label for="pCog">Primer Cognom</label>
                <input type="text" name="pCog" id="pCog" class="form-control" placeholder="Inserti el seu primer cognom." required>
            </div>
            <div class="form-group">
                <label for="sCog">Segon Cognom</label>
                <input type="text" name="sCog" id="sCog" class="form-control" placeholder="Inserte su segundo apellido... (Opcional)" >
            </div>    
            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" name="password" id="password" placeholder="Introdueixi la contrasenya..." class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmi la contrasenya</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Torna a escriure la contrasenya..." class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Ya tinc compte. <a href="login.php">Login aquí</a>.</p>
        </form>
    </div>    
</body>
</html>