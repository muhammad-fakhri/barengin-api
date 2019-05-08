<?php 
require_once 'db_connect.php';
$postdata = file_get_contents("php://input");
$email    = "";
$password = "";
if (isset($postdata)) {
    $request  = json_decode($postdata);
    $email    = $request->email;
    $password = $request->password;
}

//encrypt
$encrypt_password = md5($password);

$query_login = mysqli_query($connect, "SELECT * FROM users WHERE email='$email' AND password='$encrypt_password' ");
if (mysqli_num_rows($query_login)) {

    $row = mysqli_fetch_assoc($query_login);

    session_start(); // memulai fungsi session
    $_SESSION['email'] = $email;
    $data              = array(
        'message' => "Login Success",
        'data'    => $row,
        'status'  => "200",
    );
} else {
    $data = array(
        'message' => "Login Failed, Email or Password Wrong",
        'status'  => "404",
    );
}
echo json_encode($data);
