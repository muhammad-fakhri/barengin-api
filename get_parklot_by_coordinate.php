<?php

include 'db_connect.php';
if(isset($_GET['coordinate'])){
    $coor = $_GET['coordinate'];
}
if(isset($coor)){
    $query = mysqli_query($connect, "SELECT * FROM park_lot WHERE ParkLotCoor='$coor'");
    if (mysqli_num_rows($query)) {
        $result =mysqli_fetch_assoc($query);
        $data = array(
            'message' => "Data tempat parkirnya nya nih !",
            'data'    => $result['ParkLotId'],
            'status'  => "200",
        );
    } else {
        $data = array(
            'message' => "Gak ada datanya tempat parkir nya :( !",
            'status'  => "404",
        );
    }
} else {
    $data = array(
        'message' => "Tidak ada data koordinate yang dikirim",
        'status'  => "409",
    );
}

echo json_encode($data);
?>