<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/85550cfb5f.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap');

        * {
            font-family: 'poppins';
        }
    </style>
</head>

<body>
    <div class="container mx-auto min-w-[40%] text-xl">
        <!-- Navbar -->
        <nav class="w-full flex justify-between items-center h-28 ">
            <div class="logo flex space-x-2 items-center">
                <img src="assets/logo/logo.png" class="w-[60px] h-[60px]" alt="Belum ada">
                <p class="text-2xl font-bold">Refresh Juice</p>
            </div>
            <ul class="flex space-x-10">
                <li><a class="hover:text-orange-600 font-bold" href="#">Beranda</a></li>
                <li><a class="hover:text-orange-600" href="#">Kategori</a></li>
                <li><a class="hover:text-orange-600" href="#">Langganan</a></li>
                <li><a class="hover:text-orange-600" href="#">Pengiriman</a></li>
            </ul>
            <div class="flex space-x-7 text-orange-400">
                <a href="#"><i class="fa-solid fa-magnifying-glass hover:text-orange-600"></i></a>
                <a href="#"><i class="fa-solid fa-cart-shopping hover:text-orange-600"></i></a>
                <a href="#"><i class="fa-solid fa-user hover:text-orange-600"></i></a>
                
                
                
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Konten Produk -->
        <?php

        if (isset($_GET['cari'])) { // Jika pengguna melakukan pencarian
            $key = $_GET['cari'];
            $sql = "SELECT * FROM produk WHERE nama_pro = '$key'";
            $query = mysqli_query($koneksi, $sql);

            if ($query->num_rows > 0) { //Jika produk yang dicari ditemukan
        ?>

                <div class="grid grid-cols-4 gap-5">

                </div>

            <?php
            } else { //Jika produk yang dicari tidak ditemukan
            ?>



                <?php
            }
        } else { // Jika pengguna tidak melakukan pencarian
            $sql = "SELECT * FROM produk";
            $query = mysqli_query($koneksi, $sql);

            if ($query->num_rows > 0) {
                while ($row = mysqli_fetch_array($query)) {
                ?>

                    <div class="grid grid-cols-4 gap-5">
                        <div class="card-produk w-"></div>
                    </div>

        <?php
                }
            }
        }

        ?>
        <!-- End Konten Produk -->
    </div>
</body>

</html>