<?php
//<------------------Error reporting------------------------>
error_reporting(E_ALL);
ini_set('display_errors', 1);

// <------------------Headers------------------------>
//for cross origin "multiple domain" request
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

// <------------------Database connect------------------------>

include 'DBConnect.php';    //include the database connection file
$objDb = new DBConnect();   //create a new object
$conn = $objDb->connect();  //call the connect function
var_dump($conn);            //dump the connection object

$user = json_decode(file_get_contents('php://input'));     
$method = $_SERVER['REQUEST_METHOD'];   //get the request method
switch($method) {
    case 'POST':
        $sql ="INSERT INTO users(id, name, email, mobile, created_at) VALUES(null, :name, :email, :mobile, :created_at)";
        $stmt = $conn->prepare($sql);
        $created_at = date('Y-m-d');
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':mobile', $user->mobile);
        $stmt->bindParam(':created_at', $created_at);
        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record created successfully'];
        } else {
            $response = ['status' => 0, 'message' => 'Error in creating record'];
        }
        echo json_encode($response);
        break;
}


?>