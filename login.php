<?php
require_once 'db_connect.php';
$postdata = file_get_contents("php://input");
$email    = "";
$password = "";
if (isset($postdata)) {
    $request          = json_decode($postdata);
    $email            = $request->email;
    $password         = $request->password;
    $encrypt_password = md5($password);
    $query            = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($query)) {
        $query_login = mysqli_query($connect, "SELECT * FROM users WHERE email='$email' AND password='$encrypt_password'");
        if (mysqli_num_rows($query_login)) {
            $row = mysqli_fetch_assoc($query_login);
            session_start();
            $_SESSION['email'] = $email;
            $data              = array(
                'message' => "Login Success",
                'data'    => $row,
                'status'  => "200",
            );
        } else {
            $data = array(
                'message' => "Password is wrong",
                'status'  => "406",
            );
        }
    } else {
        $data = array(
            'message' => "There is no account with this email",
            'status'  => "404",
        );
    }
} else {
    $data = array(
        'message' => "Login Error",
        'status'  => "409",
    );
}
echo json_encode($data);
