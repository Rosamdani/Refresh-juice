<?php

include "../../koneksi.php";

if(isset($_POST['id_produk'] ) && isset($_POST['id_user']) && isset($_POST['jumlah']) && isset($_POST['total_harga'])){
    $id_produk = $_POST['id_produk'];
    $id_user = $_POST['id_user'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];
    
    // Query untuk mengupdate jumlah di dalam tabel pembelian
    $sql = "UPDATE keranjang SET jumlah='$jumlah', total_harga='$total_harga' WHERE id_produk='$id_produk' AND id_user='$id_user'";
    $query = mysqli_query($koneksi, $sql);
    
    if ($query) {
        // Jumlah berhasil diupdate
        echo 'Jumlah produk berhasil diupdate di database.';
        echo "id_produk : ".$id_produk;
        echo "id_user : ".$id_user;
        echo "jumlah : ".$jumlah;
        echo "total_harga : ".$total_harga;
    } else {
        // Error saat mengupdate jumlah
        echo 'Error: ' . $koneksi->error;
    }
    // Tutup koneksi ke database
    $koneksi->close();
}else{
    header("Location:../../not_found.php");
}