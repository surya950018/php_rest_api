<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-allow-Headers,Authorization,x-Request-with');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "PUT"){

 $inputdata =json_decode(file_get_contents("php://input"), true);
if(empty($inputdata)){

    $updateCustomer = updateCustomer($_POST,$_GET);

}else{
    $updateCustomer = updateCustomer($inputdata,$_GET);


    }
    echo $updateCustomer;
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