<?php
include "koneksi.php";
// Mengatur session pada awal script
session_start();

// Mengecek apakah session ID tersedia di cookie
if (isset($_COOKIE['sessionID'])) {
  // Mengambil session ID dari cookie
  $sessionID = $_COOKIE['sessionID'];

  // Mengecek session ID pada tabel session
  $query = "SELECT * FROM tabel_session WHERE session_id = '$sessionID'";
  $result = mysqli_query($koneksi, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    // Session ID valid, pengguna sudah login
    $row = mysqli_fetch_assoc($result);
    $userID = $row['user_id'];
    $statuLogin = true;
    echo "Berhasil login";
  } else {
    // Session ID tidak valid, pengguna belum login atau session telah kedaluwarsa
    // Redirect ke halaman login atau melakukan tindakan lain
    echo "Anda belum login";
  }

  $koneksi->close();
} else {
  // Cookie sessionID tidak tersedia, Anda belum login
  // Redirect ke halaman login atau melakukan tindakan lain
  echo "Anda belum login";
}
?>