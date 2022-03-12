<?php
include "rover.php"; 


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
<?php
  if (isset($_REQUEST['ordres'])) {
    $rover1 = new rover($_REQUEST['ample'], $_REQUEST['alt'], $_REQUEST['x-inicial'], $_REQUEST['y-inicial'], $_REQUEST['orientacio-inicial']);
    $result = $rover1->executaOrdres($_REQUEST['ordres']);
    echo "x_final: {$result[1]}, y_final: {$result[2]}, orientacio: {$result[3]}<br />";
    if ($result[0]){
        echo "Resultat execució de ordres: TOT CORRECTE. <br />";
    } else {
        echo "resultat execució de ordres: ERROR. EN ALGUN MOMENT SUPERAT EL TAULER. <br />"; 
    }
    $rover1->mostraTauler();
  }
?>
  <form action="" method="post">
 <ul>
  <li>
    <label for="ordres">ordres:</label>
    <input type="text" id="ordres" name="ordres" value="<?php if (isset($_REQUEST['ordres'])) {echo $_REQUEST['ordres'];} else {echo 'AALAARALA';}?>">
  </li>
  <li>
    <label for="ample">ample:</label>
    <input type="text" id="ample" name="ample" value="<?php if (isset($_REQUEST['ample'])) {echo $_REQUEST['ample'];} else {echo '5';}?>">
  </li>
  <li>
    <label for="alt">alt:</label>
    <input type="text" id="alt" name="alt" value="<?php if (isset($_REQUEST['alt'])) {echo $_REQUEST['alt'];} else {echo '5';}?>">
  </li>
  <li>
    <label for="x-inicial">x-inicial:</label>
    <input type="text" id="x-inicial" name="x-inicial" value="<?php if (isset($_REQUEST['x-inicial'])) {echo $_REQUEST['x-inicial'];} else {echo '0';}?>">
  </li>
  <li>
    <label for="y-inicial">y-inicial:</label>
    <input type="text" id="y-inicial" name="y-inicial" value="<?php if (isset($_REQUEST['y-inicial'])) {echo $_REQUEST['y-inicial'];} else {echo '0';}?>">
  </li>
  <li>
    <label for="orientacio-inicial">orientacio-inicial (N, S, E, W):</label>
    <input type="text" id="orientacio-inicial" name="orientacio-inicial" value="<?php if (isset($_REQUEST['orientacio-inicial'])) {echo $_REQUEST['orientacio-inicial'];} else {echo 'E';}?>">
  </li>
  <li class="button">
  <button type="submit">Enviar</button>
</li>
 </ul>
</form>
</body>
</html>