<?php

$koneksi = mysqli_connect("localhost","root","","juice");

if(!$koneksi){
    header("Location:timeout.php");
}
?>