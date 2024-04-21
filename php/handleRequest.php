<?php
include 'connection.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$departure = $_POST['departure'];
$destination = $_POST['destination'];
//echo "departure: . $departure . " , "destination:" . $destination;
if ($departure == NULL || $destination == NULL) {
    $response =  array("result"=>0, "error"=>"destination or departure are empty");
    echo json_encode($response);
} else { //start of else block


$conn = new OpenLDBWSConnection();
$OpenLDBWS = $conn->connect();

$journey = $OpenLDBWS->GetDepBoardWithDetails(50,$departure, $destination);

$tripArray = [];


header("Content-Type: text/plain");

if($journey == null){
    echo "No data found";
    return;
} else {
//    print_r($journey);
//    echo "Departure: \n";
//    echo "  Departure from: " . $journey->GetStationBoardResult->locationName . " leaves at: " . $journey->GetStationBoardResult->trainServices->service[0]->std;
//    echo "\nArrival: \n"; 
//    echo "  Arrival from: " . $journey->GetStationBoardResult->locationName . " arrives at: " . $journey->GetStationBoardResult->trainServices->service[0]->subsequentCallingPoints->callingPointList[0]->callingPoint[6]->st;
    //print_r($journey);
    $departureName = $journey->GetStationBoardResult->locationName;
    // loops through the array of locations to find the the correct one
    foreach($journey->GetStationBoardResult->trainServices->service as $services) {
            echo "Departing from: " . $departureName . ", at: " . $services->std . " on Platform " .$services->platform . "\n\n";
            foreach($services->subsequentCallingPoints->callingPointList[0]->callingPoint as $callingPoints) {
                if($callingPoints->crs == $destination) { 
                    $singleTrip = array("departureName"=>$departureName, "platform"=>$services->platform, "std"=>$services->std, "arrivalName"=>$callingPoints->locationName, "st"=>$callingPoints->st);
                    array_push($tripArray, $singleTrip);
                    echo "Arriving at : " . $callingPoints->locationName . ", at: " . $callingPoints->st . "\n";

                }
        }

            echo "-------------------------------------------------------\n\n";
    }

    print_r($tripArray);
    echo json_encode($tripArray);
    
    //foreach ($journey->GetStationBoardResult->trainServices->service[0]->subsequentCallingPoints->callingPointList[0]->callingPoint as $arrival) {
    //            if ($arrival->crs == $destination) {
    //                echo " Arrival from: " . $arrival->locationName . " arrives at: " . $arrival->st;
    //                $encodedString = json_encode($journey);
    //                $response = array("result"=>1, "error"=>"no error", "tripInfo"=>$encodedString);
    //                echo json_encode($response);
    //            }
 
    //} 
  }
}// end else block
