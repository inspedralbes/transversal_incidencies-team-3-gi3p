<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "encabezado.php"; ?>
    <link rel="stylesheet" href="style.css">
</head>

<?php $mysqli = include_once "conexion.php";
include_once "menuSuperior.php"; ?>
<?php
$resultado = $mysqli->query("SELECT  * FROM Temps_NIncidencies_Departament");
$tempsDeps = $resultado->fetch_all(MYSQLI_ASSOC);

$dades=[];
$noms=[];
foreach ($tempsDeps as $temps){
  array_push($noms,$temps["nom"]);
  array_push($dades,$temps["Temps emprat per departament"]);

}
$jsnoms=json_encode($noms);
$jsdades=json_encode($dades);
?>
<body>
<div class="chart">
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo $jsnoms ?>,
      datasets: [{
        label: 'Temps emprat',
        data: <?php echo $jsdades ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</body>
<footer> <?php include_once "footer.php"; ?></footer>
</html>