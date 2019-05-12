<?php

include 'db_connect.php';
if(isset($_GET['coordinate'])){
    $coor = $_GET['coordinate'];
}   
if(isset($coor)){
    $query = mysqli_query($connect, "SELECT * FROM park_lot WHERE ParkLotCoor='$coor'");
    if (mysqli_num_rows($query)) {
        $result =mysqli_fetch_assoc($query);   
        $id = $result['ParkLotId']; 
        $quota = $result['ParkLotQuota'];
        $quota -= 1;
        mysqli_query($connect, "UPDATE park_lot SET ParkLotQuota='$quota' WHERE ParkLotId='$id'");
        $data = array(
            'message' => "Berhasil dikurangin !",
            'park_lot' => $result['ParkLotName'],
            'quota'   => $quota,
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