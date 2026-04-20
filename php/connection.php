<?php

include 'OpenLDBWS.php';
//new change
class OpenLDBWSConnection {

  private $accessToken;

  // add api key to access OpenLDBWS data
  function __construct() {
    $this->accessToken = "";
  }

 public function connect() {
      $OpenLDBWS = new OpenLDBWS($this->accessToken);
      return $OpenLDBWS;
  }
}





?>
