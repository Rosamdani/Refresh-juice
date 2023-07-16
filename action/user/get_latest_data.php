<?php
// Koneksi ke database

if(isset($_POST['id_user'])){
    include "../../koneksi.php";
// Mendapatkan id_user dari permintaan POST
    $id_user = $_POST['id_user'];

    // Query untuk mendapatkan data terbaru berdasarkan id_user
    $query = "SELECT * FROM keranjang WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $query);

    $data = array();

    if ($result->num_rows > 0) {

        // Iterasi semua baris hasil query menggunakan while
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

    }

    // Mengembalikan data sebagai respons JSON
    header('Content-Type: application/json');
    echo json_encode($data);

    // Menutup koneksi ke database
}else{
header("Location:../../not_found.php");
}