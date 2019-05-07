<?php

include 'db_connect.php';

$postdata = file_get_contents("php://input");
$id            = "";
$name          = "";
$email         = "";
$license_plate = "";
$address       = "";
$phone_number  = "";
if (isset($postdata)) {
    $request       = json_decode($postdata);
    $id            = $request->id;
    $name          = $request->name;
    $email         = $request->email;
    $license_plate = $request->license_plate;
     $address      = $request->address;
    $phone_number  = $request->phone_number;
}
$query_register = mysqli_query($connect, "UPDATE users SET name='$name', email='$email', license_plate='$license_plate',  address='$address',  phone_number='$phone_number' WHERE id='$id'");

$query_select = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
if (mysqli_num_rows($query_select)) {
    $row  = mysqli_fetch_assoc($query_select);
    $data = array(
        'message' => "Data setelah di update",
        'data'    => $row,
        'status'  => "200",
    );
} else {
    $data = array(
        'message' => "Update gagal",
        'status'  => "404",
    );
}

echo json_encode($data);
