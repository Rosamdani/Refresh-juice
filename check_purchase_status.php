<?php

include "koneksi.php";
// Ambil nilai-nilai yang dikirimkan melalui metode POST
$id_produk = $_POST['id_produk'];
$id_user = $_POST['id_user'];

// Query untuk memeriksa status pembelian produk dan mengambil data jumlah dan total_harga
$sql = "SELECT jumlah, total_harga FROM pembelian WHERE id_produk='$id_produk' AND id_user='$id_user'";

$result = mysqli_query($koneksi, $sql);

if ($result->num_rows > 0) {
    // Produk sudah dibeli

    echo "console.log('Data sudah ada!')";
    $row = $result->fetch_assoc();
    $data = array(
        'status' => 'purchased',
        'jumlah' => $row['jumlah'],
        'total_harga' => $row['total_harga']
    );
} else {
    // Produk belum dibeli
    $data = array('status' => 'not_purchased');
}

// Tutup koneksi ke database
$koneksi->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);