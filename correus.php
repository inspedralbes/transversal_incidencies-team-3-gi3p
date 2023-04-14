<!DOCTYPE html>
<html lang="ca">
<head>


    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>
<?php include_once "menuSuperior.php"; ?>
<body>
<div class="correus">
    <h1><b>Correus Electrònics del team</b></h1>
    
   
        <a href="mailto:a22rauespgom@inspedralbes.cat?Subject=Correu%20de%20Raúl%20Espinosa%20Gómez"><button class="btn btn-primary correo <?php include "selectorUser.php" ?>"><img src="./img/if.png"> Raúl Espinosa Gómez</button></a></li>
        <a href="mailto:a22lorcrinor@inspedralbes.cat?Subject=Correu%20de%20Loris%20Crisafo%20Norte"><button class="btn btn-primary correo <?php include "selectorUser.php" ?>"><img src="./img/if.png"> Loris Crisafo Norte</button></a></li>
        <a href="mailto:a19galdelred@inspedralbes.cat?Subject=Correu%20de%20Gala%20del%20Águila"><button class="btn btn-primary correo <?php include "selectorUser.php" ?>"><img src="./img/if.png">Gala del Águila Redó</button></a></li>
        <a href="mailto:a20erigomvil@inspedralbes.cat?Subject=Correu%20de%20Eric%20Gómez%20Vilà"><button class="btn btn-primary correo <?php include "selectorUser.php" ?>"><img src="./img/if.png">Eric Gómez Vilà</button></a></li>
    
    <a class="btn btn-secondary tornar" href="index.php">Tornar</a>
    </div>
   


</body>
<footer><?php include_once "footer.php"; ?></footer>
</html>