<?php

  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');
  header('Access-Control-Allow-Method:DELETE');
  header('Access-Control-Allow-Headers:Content-Type,Access-Control-allow-Headers,Authorization,x-request-with');
  
  include('function.php');

  $requestMethod = $_SERVER["REQUEST_METHOD"];

  if($requestMethod == "DELETE"){

    

      $deleteCustomer = deleteCustomer($_GET);
      echo $deleteCustomer ;

    }
  else
  {

    $data =[

        'status'  => 405,
        'message' => $requestMethod. 'method not allowed',
        
    ];
    header ("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);

  }


?>