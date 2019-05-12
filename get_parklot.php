<?php

include 'db_connect.php';
if(isset($_GET['gate'])){
    $gate = $_GET['gate'];
}
if(isset($gate)){
    $query = mysqli_query($connect, "SELECT * FROM park_lot WHERE ParkLotPosition='$gate'");
    if (mysqli_num_rows($query)) {

        $data_park = array();
        while($result =mysqli_fetch_assoc($query)){
            $data_park[]=$result;
        }
        $data = array(
            'message' => "Data tempat parkirnya nya nih !",
            'data'    => $data_park,
            'status'  => "200",
        );
    } else {
        $data = array(
            'message' => "Gak ada datanya tempat parkir :( !",
            'status'  => "404",
        );
    }
} else {
    $query = mysqli_query($connect, "SELECT * FROM park_lot");
if (mysqli_num_rows($query)) {

    $data_park = array();
    while($result =mysqli_fetch_assoc($query)){
        $data_park[]=$result;
    }
    $data = array(
        'message' => "Data tempat parkirnya nya nih !",
        'data'    => $data_park,
        'status'  => "200",
    );
} else {
    $data = array(
        'message' => "Gak ada datanya tempat parkir :( !",
        'status'  => "404",
    );
}
}

echo json_encode($data);
?>