<?php

require '../inc/dbcon.php';
function error442($message){

    $data =[
 
        'status'  => 422,
        'message' => $message,
        
    ];
    header ("HTTP/1.0 422 Unprocceble entity");
    return json_encode($data);
    exit();

}

function storeCustomer($customerInput){

    global $conn;

    $name = mysqli_real_escape_string($conn,$customerInput['name']);
    $email= mysqli_real_escape_string($conn,$customerInput['email']);
    $phone = mysqli_real_escape_string($conn,$customerInput['phone']);

    if(empty(trim($name))){

        return error442('enter your name');
     }elseif(empty(trim($email))){
        return error442('enter your email');
     }elseif(empty(trim($phone))){
        return error442('enter your phone');

    }
    else{

        $query = "INSERT INTO customers (name,email,phone) values ('$name','$email','$phone')";
        $result = mysqli_query($conn,$query);
        
        if($result){
            $data = [
                'status'  => 201,
                'message' => 'Customer created succesfully',
            ];
            header("HTTP/1.0  201 CREATED"); // Fixed the HTTP header
            return json_encode($data);
    
        }else{
            $data = [
                'status'  => 500,
                'message' => 'Internal server error',
            ];
            header("HTTP/1.0  500 Internal Server Error"); // Fixed the HTTP header
            return json_encode($data);


        }
    }

}
function getCustomerList(){

    global $conn;

    $query = "SELECT * FROM customers";
    $query_run = mysqli_query($conn, $query); 

    if($query_run){
        if(mysqli_num_rows($query_run) > 0){
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status'  => 200,
                'message' => 'Customer fetching successfully',
                'data'  => $res
            ];
            header("HTTP/1.0 200 OK"); // Fixed the HTTP header
            return json_encode($data);  
        } else {
            $data = [
                'status'  => 404,
                'message' => 'No customers found',
            ];
            header("HTTP/1.0 404 no customers Found"); // Fixed the HTTP header
            return json_encode($data);  
        }
    } 
    else 
    {
        $data = [
            'status'  => 500,
            'message' => 'Internal server error',
        ];
        header("HTTP/1.0  500 Internal Server Error");
        return json_encode($data);
    }
}

function getCustomer($customerParams){

    global $conn;

    if($customerParams['id'] == null){
        return error442('Enter your customer id');
    }
    
    $customerId = mysqli_real_escape_string($conn,$customerParams['id']);

    $query = "SELECT * FROM customers WHERE customer_id='$customerId' LIMIT 1";

    $result = mysqli_query($conn,$query);

    if($result){

        if(mysqli_num_rows($result)==1)
        {
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status'  => 200,
                'message' => 'customer fetched succesfully',
                'data' => $res
            ];
            header("HTTP/1.0  200 Ok"); // Fixed the HTTP header
            return json_encode($data);


        }else
        
        {
            $data = [
                'status'  => 404,
                'message' => 'no customer found',
            ];
            header("HTTP/1.0  404 Not found"); // Fixed the HTTP header
            return json_encode($data);


        }


    }else{

        $data = [
            'status'  => 500,
            'message' => 'Internal server error',
        ];
        header("HTTP/1.0  500 Internal Server Error"); // Fixed the HTTP header
        return json_encode($data);

 
    }

}

function updateCustomer($customerInput,$customerParams){

    global $conn;

    if(!isset($customerParams['id'])){

        return error442('customer id not found in url');
    }elseif($customerParams['id'] == null){

        return error442('enter the customer id ');

    }
    $customerId= mysqli_real_escape_string($conn,$customerParams['id']);

    $name = mysqli_real_escape_string($conn,$customerInput['name']);
    $email= mysqli_real_escape_string($conn,$customerInput['email']);
    $phone = mysqli_real_escape_string($conn,$customerInput['phone']);

    if(empty(trim($name))){

        return error442('enter your name');
     }elseif(empty(trim($email))){
        return error442('enter your email');
     }elseif(empty(trim($phone))){
        return error442('enter your phone');

    }
    else
    {

        $query = " UPDATE customers SET name='$name',email='$email',phone='$phone' WHERE customer_id ='$customerId' LIMIT 1";
        $result = mysqli_query($conn,$query);
        
        if($result){
            $data = [
                'status'  => 200,
                'message' => 'Customer Updated succesfully',
            ];
            header("HTTP/1.0  200 Success");
            return json_encode($data);
    
        }else{
            $data = [
                'status'  => 500,
                'message' => 'Internal server error',
            ];
            header("HTTP/1.0  500 Internal Server Error"); // Fixed the HTTP header
            return json_encode($data);


        }
    }

}

function deleteCustomer($customerParams){

    global $conn;

    if(!isset($customerParams['id'])){

        return error442('customer id not found in url');
    }elseif($customerParams['id'] == null){

        return error442('enter the customer id ');

    }

    $customerId= mysqli_real_escape_string($conn,$customerParams['id']);

    $query ="DELETE FROM customers WHERE customer_id ='$customerId' limit 1";
    $result = mysqli_query($conn,$query);

    if($result){
        $data = [
            'status'  => 200,
            'message' => 'delete customer successfully',
        ];
        header("HTTP/1.0 200 deteted"); // Fixed the HTTP header
        return json_encode($data);

    }else{

        $data = [
            'status'  => 404,
            'message' => 'customer not found',
        ];
        header("HTTP/1.0 404 not found"); // Fixed the HTTP header
        return json_encode($data);

    }

}


?>
