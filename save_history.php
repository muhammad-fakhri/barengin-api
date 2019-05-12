<?php
include 'db_connect.php';
$user_id            = $_GET['id'];
$park_lot_coordinate  = $_GET['coordinate'];
if (isset($user_id) && isset($park_lot_coordinate)) {
    //search for the parklot id first
    $query_select = mysqli_query(
        $connect,
        "SELECT * FROM park_lot 
        WHERE ParkLotCoor='$park_lot_coordinate'"
    );

    if (mysqli_num_rows($query_select)) {
        //get the parklot id
        $result = mysqli_fetch_assoc($query_select);
        $id = $result['ParkLotId'];

        //ready the date and time
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        // $time = time('H:i:s');
        $time = time();

        //insert the history to database
        $query_insert = mysqli_query(
            $connect,
            "INSERT INTO park_history (user_id, history_date, history_time, park_lot_id)  
    VALUES ('$user_id', '$date', '$date', '$id')"
        );

        $data = array(
            'message' => "Data history berhasil di insert",
            'user_id' => $user_id,
            'date' => $date,
            'time' => $date,
            'status'  => "200",
        );
    } else {
        $data = array(
            'message' => "Insert gagal, data tempat parkir tidak ditemukan",
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
