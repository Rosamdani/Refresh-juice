<?php

include "../../koneksi.php";


// Route untuk mengambil semua data produk
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $koneksi;
    
    $query = "SELECT * FROM produk ORDER BY id_produk DESC";
    $result = $koneksi->query($query);
    
    $produk = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produk[] = $row;
        }
    }

    $koneksi->close();

    header('Content-Type: application/json');
    echo json_encode($produk);
    exit();
}

// Route untuk mengambil jumlah semua produk
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $koneksi;
    
    $query = "SELECT COUNT(*) AS jumlah_produk FROM produk";
    $result = $koneksi->query($query);
    
    $jumlahProduk = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $jumlahProduk = $row['jumlah_produk'];
    }

    $koneksi->close();

    header('Content-Type: application/json');
    echo json_encode(["jumlah_produk" => $jumlahProduk]);
    exit();
}