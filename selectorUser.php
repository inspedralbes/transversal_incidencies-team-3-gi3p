<?php
switch ($nombre["tipo_User"]) {
  case 1:
    echo "admin";
    break;
  case 2:
    echo "tecnic";
    break;
  case 3:
    echo "user";
    break;
}
echo " ";
echo $nombre["nombre"];
?>