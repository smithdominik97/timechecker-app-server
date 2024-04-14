<?php

include 'OpenLDBWS.php';
//new change
class OpenLDBWSConnection {

  private $accessToken;

  function __construct() {
    $this->accessToken = "c69fed7e-e5f5-4ad0-9517-0c73ad909809";
  }

 public function connect() {
      $OpenLDBWS = new OpenLDBWS($this->accessToken);
      return $OpenLDBWS;
  }
}





?>
