<?php
session_start();

// Menghapus session ID dari cookie
if (isset($_COOKIE['sessionID'])) {
  setcookie('sessionID', '', time() - 3600, '/');
}else{
    echo "Anda belum login";
    header("Location:index.php");
    exit;
}

// Menghapus data session dari server
session_unset();
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai setelah logout
echo "Berhasil logout";
exit;
?>