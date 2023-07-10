<?php

include "koneksi.php";

$id_produk = $_POST['id_produk'];
$id_user = $_POST['id_user'];

// Query untuk menyimpan data ke dalam tabel pembelian
$sql = "DELETE FROM keranjang WHERE id_produk = '$id_produk' AND id_user = '$id_user'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    // Data berhasil disimpan
    echo '<script>console.log("Data pembelian berhasil dihapus ke database")</script>.';
} else {
    // Error saat menyimpan data
    echo 'Error hapus: ' . $koneksi->error;
}
// Tutup koneksi ke database