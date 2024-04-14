<?php

include 'connection.php';

// $departure = $_POST['departure'];
// $destination = $_POST['destination'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$departure = "DEE";
$destination = "EGY";
$conn = new OpenLDBWSConnection();
var_dump($conn);
$OpenLDBWS = $conn->connect();
var_dump($OpenLDBWS);
$response = $OpenLDBWS->GetArrivalDepartureBoard(10, $departure, array($destination));
header("Content-Type: text/plain");
print_r($response);
