<?php
require 'OpenLDBWS.php';
include 'connection.php';
//new chang

//new change
// $departure = $_POST['departure'];
// $destination = $_POST['destination'];
$departure = "DEE";
$destination = "EGY";
$conn = new OpenLDBWSConnection();
$OpenLDBWS = $conn->connect();
$response = $OpenLDBWS->GetArrivalDepartureBoard(10, $departure, array($destination));
header("Content-Type: text/plain");
print_r($response);
