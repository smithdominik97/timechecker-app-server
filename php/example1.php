<?php
//new change
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
  require("OpenLDBWS.php");
  $OpenLDBWS = new OpenLDBWS("c69fed7e-e5f5-4ad0-9517-0c73ad909809");
  $response = $OpenLDBWS->GetDepartureBoard(10,"PAD");
  header("Content-Type: text/plain");
  print_r($response);
?>
