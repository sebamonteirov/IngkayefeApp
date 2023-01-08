<!DOCTYPE html>
<head>
<link href="css/styles.css" rel="stylesheet">
</head>
<body>
<table>
  <tr>
    <th>Fecha y hora</th>
    <th>Temperatura</th>
    <th>Humedad</th>
    <th>V. del viento</th>
  </tr>
  <?php
        require_once "php/conexion.php";
        session_start();
        $sensorId = $_GET['sensorId'];
        $sql = "SELECT * FROM data_sensor WHERE id = '$sensorId' ORDER BY date DESC, time DESC";
        $query = mysqli_query($conn, $sql);
        $data = array();

        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
          $data[] = $result;
        }
            
        $date = $data[0]['date'] . " " . $data[0]['time'];
        $t = $data[0]['temperature'];
        $h = $data[0]['humidity'];
        $v = $data[0]['wind'];

        echo "<tr>";
        echo "<td>$date</td>";
        if ($t >= 30) {
          echo "<td class='bg-red'>$t</td>";
        } else {
          echo "<td class='bg-green'>$t</td>";
        }

        if ($h >= 30) {
          echo "<td class='bg-red'>$h</td>";
        } else {
          echo "<td class='bg-green'>$h</td>";
        }

        if ($v >= 30) {
          echo "<td class='bg-red'>$v</td>";
        } else {
          echo "<td class='bg-green'>$v</td>";
        }

        echo "</tr>";

    ?>
</table>

<table>
  <tr>
    <td>Peligro de incendio</td>
    <?php

    $tA = ($t >= 30) ? true : false;
    $hA = ($h >= 30) ? true : false;
    $vA = ($v >= 30) ? true : false;

    $fireCounter = 0;

    if ($tA || $hA || $vA) {
      if ($tA) $fireCounter++;
      if ($hA) $fireCounter++;
      if ($vA) $fireCounter++;

      switch ($fireCounter) {
        case 1: echo "<td class='bg-yellow'>Media baja</td>"; break;
        case 2: echo "<td class='bg-yellow'>Media</td>"; break;
        case 3: echo "<td class='bg-red'>Alta</td>"; break;
        
        default: echo "<td class='bg-yellow'>Media baja</td>"; break;
      }
    } else {
      echo "<td class='bg-green'>Muy baja</td>";
    }
    ?>
  </tr>
</table>

<?php echo "<h2>Historial de mediciones de sensor id=$sensorId</h2>"; ?>

<table>
  <tr>
    <th>Fecha y hora</th>
    <th>Temperatura</th>
    <th>Humedad</th>
    <th>V. del viento</th>
  </tr>
  <?php
        foreach ($data as $valor) {
            
            $date = $valor['date'] . " " . $valor['time'];
            $t = $valor['temperature'];
            $h = $valor['humidity'];
            $v = $valor['wind'];

            echo "<tr><td>$date</td><td>$t</td><td>$h</td><td>$v</td></tr>";
        }
        unset($valor);
    ?>
</table>
</body>
</html>