<?php
include_once("../db_connect.php");
class DocumentController {

  private $requestMethod;
  private $docId;

  public function __construct($requestMethod, $docId)
  {
     $this->requestMethod = $requestMethod;
    $this->docId = $docId;
  }

  public function processRequest()
  {
	  //echo 'ss:'.$this->docId;die;
    switch ($this->requestMethod) {
      case 'GET':
        if ($this->docId) {
          $response = $this->getDoc($this->docId);
        } else {
          $response = $this->getAllDoc();
        };
        break;
      default:
        $response = $this->notFoundResponse();
        break;
    }
    header($response['status_code_header']);
    if ($response['body']) {
      echo $response['body'];
    }
  }

  private function getAllDoc()
  {
	  $conn = new mysqli("localhost","root","","documents");
      $query = "SELECT * from docupload";

	  $result = $conn->query($query);
      if ($result->num_rows > 0) {
		  $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
	  }else{
		  $row = "";
	  }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($row);
    return $response;
  }

  private function getDoc($id)
  {
    $result = $this->find($id);
    if (! $result) {
      return $this->notFoundResponse();
    }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($result);
    return $response;
  }

  public function find($id)
  {
	  $conn = new mysqli("localhost","root","","documents");
    $query = "select * from docupload where id =".$id;
	 $result = $conn->query($query);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
	}else{
		$row = "";
	}
	return $row;
    
  }

  
  private function unprocessableEntityResponse()
  {
    $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
    $response['body'] = json_encode([
      'error' => 'Invalid input'
    ]);
    return $response;
  }

  private function notFoundResponse()
  {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    return $response;
  }
}
?>