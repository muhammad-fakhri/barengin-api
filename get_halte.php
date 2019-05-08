<?php

include 'db_connect.php';

$query = mysqli_query($connect, "SELECT * FROM halte_lot");
if (mysqli_num_rows($query)) {

    // $data_halte = array();
    // while($result =mysqli_fetch_assoc($query)){
    //     $data_halte[]=$result;
    // }

    $row  = mysqli_fetch_assoc($query);
    $data = array(
        'message' => "Data halte nya nih !",
        // 'data'    => $data_halte,
        'data'    => $row,
        'status'  => "200",
    );
} else {
    $data = array(
        'message' => "Gak ada datanya halte :( !",
        'status'  => "404",
    );
}
echo json_encode($data);
?>