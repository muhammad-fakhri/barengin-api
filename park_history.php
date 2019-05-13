<?php

include 'db_connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($connect, "SELECT park_history.history_id, park_history.history_date, park_history.history_time, park_lot.ParkLotName 
    FROM park_history 
    INNER JOIN park_lot ON park_history.park_lot_id = park_lot.ParkLotId 
    WHERE park_history.user_id='$id'");
    if (mysqli_num_rows($query)) {
    
        $data_history = array();
        while($result =mysqli_fetch_assoc($query)){
            $data_history[]=$result;
        }
    
        $data = array(
            'message' => "Data parkir history",
            'data'    => $data_history,
            'status'  => "200",
        );
    } else {
        $data = array(
            'message' => "Tidak ada data parkir history dari user ini !",
            'status'  => "404",
        );
    } 

} else {
    $data = array(
        'message' => "Tidak ada id yang dikirmkan :( !",
        'status'  => "409",
    );
}

echo json_encode($data);
?>