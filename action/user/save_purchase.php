<?php

include "../../koneksi.php";

if(isset($_POST['id_produk'] ) && isset($_POST['id_user']) && isset($_POST['jumlah']) && isset($_POST['total_harga'])){
    $id_produk = $_POST['id_produk'];
    $id_user = $_POST['id_user'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'] * 1000;
    
    // Query untuk menyimpan data ke dalam tabel pembelian
    $sql = "INSERT INTO keranjang (id_produk, id_user, jumlah, total_harga) VALUES ('$id_produk', '$id_user', '$jumlah', '$total_harga')";
    $query = mysqli_query($koneksi, $sql);
    
    if ($query) {
        // Data berhasil disimpan
        echo 'Data pembelian berhasil disimpan ke database.';
    } else {
        // Error saat menyimpan data
        echo 'Error: ' . $koneksi->error;
    }
    // Tutup koneksi ke database
    $koneksi->close();
}else{
    header("Location:../../not_found.php");
}