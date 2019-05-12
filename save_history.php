<?php

include 'db_connect.php';

$postdata = file_get_contents("php://input");
$user_id            = "";
$park_lot_coordinate  = "";
if (isset($postdata)) {
    $request       = json_decode($postdata);
    $user_id            = $request->user_id;
    $park_lot_coordinate  = $request->park_lot_coordinate;

    //search for the parklot id first
    $query_select = mysqli_query($connect, "SELECT * FROM park_lot WHERE ParkLotCoor='$park_lot_coordinate'");

    if (mysqli_num_rows($query_select)) {
        //get the parklot id
        $result = mysqli_fetch_assoc($query_select);
        $id = $result['ParkLotId'];

        //ready the date and time
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $time = time('H:i:s');

        //insert the history to database
        $query_insert = mysqli_query(
            $connect,
            "INSERT INTO park_history (user_id, history_date, history_time, park_lot_id)  
    VALUES ($user_id, $date, $time, $id)"
        );

        $data = array(
            'message' => "Data history berhasil di insert",
            'user_id' => $user_id,
            'date' => $date,
            'time' => $time,
            'status'  => "200",
        );
    } else {
        $data = array(
            'message' => "Inser gagal, data tempat parkir tidak ditemukan",
            'status'  => "404",
        );
    }
} else {
    $data = array(
        'message' => "tidak ada input yang diberikan, insert gagal",
        'status'  => "409",
    );
}

echo json_encode($data);
