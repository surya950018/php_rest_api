<?php

  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');
  header('Access-Control-Allow-Method:GET');
  header('Access-Control-Allow-Headers:Content-Type,Access-Control-allow-Headers,Authorization,x-request-with');
  
  include('function.php');

  $requestMethod = $_SERVER["REQUEST_METHOD"];

  if($requestMethod == "GET"){

    if(isset($_GET['id'])){

      $customer = getCustomer($_GET);
      echo $customer;

    }
    
    else{

      $customerList = getCustomerList();
      echo $customerList;

    }

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