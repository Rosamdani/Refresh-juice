<?php

include "koneksi.php";
// Mengatur session pada awal script
session_start();


if(isset($_POST['action']) && isset($_POST['username']) && isset($_POST['password'])){
    if($_POST['action'] == "Login"){
        login();
    }else if($_POST['action'] == "Register"){
        register();
    }
}

//Function untuk login
function login(){
    global $koneksi;
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($koneksi, $sql);

    if($query->num_rows > 0){
        while($row = mysqli_fetch_array($query)){
            $userID = $row['id_user'];
        }
    }else{
        echo "Username atau Password Salah!";
    }

    setKuki($userID);

}

//Function untuk register
function register(){

}

function setKuki($userID){
    global $koneksi;
    
    $sessionID = bin2hex(random_bytes(16));

    // Menyimpan session ID ke dalam cookie
    setcookie('sessionID', $sessionID, time() + (86400 * 30), '/'); // Cookie berlaku selama 30 hari
    
    // Menyimpan session ID ke dalam session
    $_SESSION['sessionID'] = $sessionID;
    
    echo "Sesi anda adalah : ";
    echo $sessionID;

    
    $query = "INSERT INTO tabel_session (session_id, user_id) VALUES ('$sessionID', '$userID')";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
      // Melanjutkan ke halaman selanjutnya setelah login/register
      header('Location: index.php');
      exit();
    } else {
      // Terjadi kesalahan dalam menyimpan session ID ke dalam database
      // Handle error
      echo "Error: " . mysqli_error($koneksi);
    }
    
    $koneksi->close();
}

?>