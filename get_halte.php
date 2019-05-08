<?php

include 'db_connect.php';

$query = mysqli_query($connect, "SELECT * FROM halte_lot");
if (mysqli_num_rows($query)) {
    $row  = mysqli_fetch_assoc($query_select);
    $data = array(
        'message' => "Data halte nya nih !",
        'data'    => $row,
        'status'  => "200"
    );
} else {
    $data = array(
        'message' => "Gak ada datanya halte :( !",
        'status'  => "404"
    );
}
echo json_encode($data);
