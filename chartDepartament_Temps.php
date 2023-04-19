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
$Nincidencies=[];
foreach ($tempsDeps as $temps){
  array_push($noms,$temps["nom"]);
  array_push($dades,$temps["Temps emprat per departament"]);
  array_push($Nincidencies, $temps["Numero d'incidencies"]);
}
$jsnoms=json_encode($noms);
$jsdades=json_encode($dades);
$jsnIncidencies=json_encode($Nincidencies);
?>
<body>
<h1 style="text-align: center"><b>Consulta per departament</b></h1>

<div class="chart">
  <canvas id="myChart"></canvas>
  <br>
</div>
<div class="chart">
  <canvas id="IncidenciesDep"></canvas>
  <br>
  <br>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx2 = document.getElementById('myChart');
  new Chart(ctx2, {
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
<script>
  const ctx = document.getElementById('IncidenciesDep');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo $jsnoms ?>,
      datasets: [{
        label: 'Numero incidencies',
        data: <?php echo $jsnIncidencies ?>,
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