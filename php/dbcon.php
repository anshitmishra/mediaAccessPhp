<?php
$username = "root";
$password = "";
$server="localhost";
$database = "anshit";
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: application/json');
// header('Access-Conterol-Allow-Origin: *');
//  // Allow from any origin
//  if (isset($_SERVER['HTTP_ORIGIN'])) {
//     // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
//     // you want to allow, and if so:
//     header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//     header('Access-Control-Allow-Credentials: true');
//     header('Access-Control-Max-Age: 86400');    // cache for 1 day
// }

// // Access-Control headers are received during OPTIONS requests
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//         // may also be using PUT, PATCH, HEAD etc
//         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//         header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

//     exit(0);
// }

$connection = new mysqli($server,$username,$password,$database);

date_default_timezone_set("Asia/kolkata");
if($connection){
mysqli_set_charset($connection,"utf8mb4");
}else{ 
die(mysqli_connect_error());
}

?>
