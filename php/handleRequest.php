<?php
include 'connection.php';

// $departure = $_POST['departure'];
// $destination = $_POST['destination'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$departure = "DEE";
//$destination = "EGY";
$conn = new OpenLDBWSConnection();
$OpenLDBWS = $conn->connect();
// $response = $OpenLDBWS->GetArrivalDepartureBoard(10, "EGY", array("EGY"));
$response = $OpenLDBWS->GetDepartureBoard(10,"DEE");
$departures = $OpenLDBWS->GetDepBoardWithDetails(1,"DEE", "EGY");
$arrivals = $OpenLDBWS->GetArrBoardWithDetails(1, "EGY");

$serviceId = null;

//$response = $OpenLDBWS->GetNextDepartures("DEE", "EGY", 120, 120);
header("Content-Type: text/plain");

if($response == null){
    echo "No data found";
    return;
} else {
    print_r($departures);
    echo "Departure: \n";
    echo "  Departure from: " . $departures->GetStationBoardResult->locationName . " leaves at: " . $departures->GetStationBoardResult->trainServices->service[0]->std;
    echo "\nArrival: \n"; 
    echo "  Arrival from: " . $departures->GetStationBoardResult->locationName . " arrives at: " . $departures->GetStationBoardResult->trainServices->service[0]->subsequentCallingPoints->callingPointList[0]->callingPoint[10]->st; 
  }

