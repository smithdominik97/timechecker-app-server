<?php
include 'connection.php';




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
;
    //print_r($journey);
    $departureName = $journey->GetStationBoardResult->locationName;
    // loops through the array of locations to find the the correct one
    foreach($journey->GetStationBoardResult->trainServices->service as $services) {
            foreach($services->subsequentCallingPoints->callingPointList[0]->callingPoint as $callingPoints) {
                if($callingPoints->crs == $destination) { 
                    $singleTrip = array("depName"=>$departureName, "depPlatform"=>$services->platform, "depSt"=>$services->std, "depEt"=>$services->etd ,"destName"=>$callingPoints->locationName, "destSt"=>$callingPoints->st, "destEt"=>$callingPoints->et);
                    array_push($tripArray, $singleTrip);

                }
        }

          
    }

    echo json_encode($tripArray);
    
 }
}// end else block
