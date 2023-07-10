<?php
// Koneksi ke database
include "koneksi.php";

// Mendapatkan id_user dari permintaan POST
$id_user = $_POST['id_user'];

// Hapus semua data produk dari database berdasarkan id_user
$query = "DELETE FROM keranjang WHERE id_user = '$id_user'";
$result = mysqli_query($koneksi, $query);

// Menutup koneksi ke database
?>