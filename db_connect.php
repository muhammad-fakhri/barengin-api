<?php
//http://stackoverflow.com/questions/18382740/cors-not-working-php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT, PATCH,");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// $localhost = "fdb24.atspace.me";
// $username = "3037919_barengin";
// $password = "fakhri123";
// $db_name = "3037919_barengin";
$localhost = "127.0.0.1";
$username = "root";
$password = "";
$db_name = "barengin";

//create connection
$connect = mysqli_connect($localhost, $username, $password, $db_name);

//check connection
if($connect->connect_error) {
  die("connection failed : ". $connect->connect_error);
} 
// else {
// 	echo "Database Konek coy !";
// }
?>
