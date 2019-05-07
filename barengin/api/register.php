<?php

include 'db_connect.php';

$postdata   = file_get_contents("php://input");
$name       = "";
$email      = "";
$password   = "";
$repassword = "";
if (isset($postdata)) {
    $request    = json_decode($postdata);
    $name       = $request->name;
    $email      = $request->email;
    $password   = $request->password;
    $repassword = $request->repassword;
}
if ($password == $repassword) {
    $encrypt_password = md5($password);
    $query            = mysqli_query($connect, "SELECT * FROM users WHERE email='$email' AND password='$encrypt_password'");

    if (mysqli_num_rows($query)) {
        $data = array(
            'message' => "Email has been taken!",
            'status'  => "409",
        );
    } else {
        $query = mysqli_query($connect, "INSERT INTO users (name,email,password) VALUES ('$name','$email','$encrypt_password')");
        $data  = array(
            'message' => "Your account is success created !",
            'status'  => "200",
        );
    }

} else {
    $data = array(
        'message' => "Your password is not match !",
        'status'  => "400",
    );
}

echo json_encode($data);