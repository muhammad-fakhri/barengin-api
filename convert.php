<?php
include 'db_connect.php';
$coor = $_GET['coordinate'];
if (isset($coor)) {
    sscanf($coor, '(%f, %f)', $lat, $lng);
    $data = array(
        'message' => "Ini dia koordinat yang sudah diconvert",
        'lat' => $lat,
        'lng' => $lng,
        'dummy'=> $coor,
        'status' => "200",
    );
} else {
    $data = array(
        'message' => "Tidak ada data koordinat yang dikirimkan !",
        'status'  => "409",
    );
}
echo json_encode($data);