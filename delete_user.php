<?php

include 'db_connect.php';

// $postdata = file_get_contents("php://id");
$id = $_GET['id'];
if (isset($id)) {
    // $request       = json_decode($postdata);
    // $id            = $request->id;
    // $id    = $postdata;
    $query_select = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
    if (mysqli_num_rows($query_select)) {
        $row   = mysqli_fetch_assoc($query_select);
        $query = mysqli_query($connect, "DELETE FROM users WHERE id='$id'");
        $data  = array(
            'message' => "Data berhasil dihapus",
            'data'    => $row,
            'status'  => "200",
        );
    } else {
        $data = array(
            'message' => "Data tidak ditemukan",
            'status'  => "404",
        );
    }
} else {
    $data = array(
        'message' => "Ada Kesalahan",
        'status'  => "409",
    );

}
echo json_encode($data);
