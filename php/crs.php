<?php

$stationFile = "stations.json";


if(file_exists($stationFile)) {
  $jsonString = file_get_contents($stationFile);
  header('Content-Type: application/json');
  echo $jsonString;
} else {
    echo "file not found";
}
?>
