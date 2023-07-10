<?php
include 'koneksi.php';
include 'cek_sesi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/85550cfb5f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap');

    * {
        font-family: 'poppins';
    }
    </style>
</head>

<body class=" bg-gray-200">
    <!-- Navbar -->
    <div class="w-full shadow-md fixed bg-white">
        <nav class="w-[50%] mx-auto flex justify-between items-center h-28 ">
            <div class="logo flex space-x-2 items-center">
                <img src="assets/logo/logo.png" class="w-[60px] h-[60px]" alt="Belum ada">
                <p class="text-lg font-bold">Refresh Juice</p>
            </div>
            <ul class="flex space-x-10">
                <li><a class="hover:text-orange-600" href="index.php">Beranda</a></li>
                <li><a class="hover:text-orange-600" href="#">Kategori</a></li>
                <li><a class="hover:text-orange-600" href="#">Langganan</a></li>
                <li><a class="hover:text-orange-600" href="#">Pengiriman</a></li>
            </ul>
            <div class="flex space-x-7 text-orange-400">
                <button type="button" id="modal-open-button"><i
                        class="fa-solid fa-magnifying-glass hover:text-orange-600"></i></button>
                <?php
                
                if(isset($_COOKIE['sessionID'])){
                    ?>

                <a href="#"><i class="fa-solid fa-user hover:text-orange-600"></i></a>

                <?php
                }else{
                    ?>
                <a href="login.php" class="px-3 py-2 rounded text-white bg-orange-400">Login</a>
                <?php
                }

                ?>



            </div>
        </nav>
    </div>
    <!-- End Navbar -->

    <input type="hidden" class="user-id" value="<?=$userID?>">
    <div class="w-[50%] mx-auto min-w-[400px] pt-32 h-[100vh] text-lg flex space-x-5">

        <!-- Tanggal Pengiriman -->
        <div class="kiri w-[25%] min-w-[300px]">
            <div class="form w-full rounded-md bg-white space-y-5 pb-10 shadow-sm">
                <p class="w-full px-2 py-4 border-b-gray-300 border">Keranjang Belanjamu</p>
                <div class="w-full px-5 space-y-5 text-sm">
                    <div class="w-full">
                        <p class="text-lg mb-2">Tanggal Pengiriman :</p>
                        <input
                            class="w-full h-[50px]  text-gray-500 rounded-md border outline-orange-400 border-gray-300 px-2"
                            type="date" name="tgl_kirim">
                    </div>
                    <div class="w-full">
                        <p class="text-xl">Catatan tambahan :</p>
                        <textarea name="catatan" id="catatan"
                            class="w-full h-[50px] px-2 py-1 text-gray-500 rounded-md border outline-orange-400 border-gray-300"
                            placeholder="Masukkan catatan tambahan..."></textarea>
                    </div>
                    <div class="w-full">
                        <p id="text-xl">Total : </p>
                        <p id="total-quantity" class="text-xl font-bold"></p>
                    </div>
                    <div class="w-full">
                        <p id="text-xl">Total Harga : </p>
                        <p id="total-price" class="text-xl font-bold"></p>
                    </div>
                    <div class="w-full flex space-x-5">
                        <button
                            class="px-3 py-2 rounded duration-300 text-white font-bold ease-in-out bg-blue-400 hover:bg-blue-600">Pesan</button>
                        <button
                            class="px-3 py-2 rounded duration-300 text-white font-bold ease-in-out bg-red-400 hover:bg-red-600"
                            onclick="deleteAllData()">Batalkan semua</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disini produk keranjang ditampilkan -->
        <div id="data-container" class="kanan w-full bg-white h-full rounded-md overflow-y-auto">

        </div>
        <!-- End Produk keranjang -->
    </div>

    <!-- Footer -->
    <footer class="w-full pt-20 border-t-[7px] bg-white border-orange-400 h-[400px]">
        <div class="container"></div>
    </footer>
    <!-- End Footer -->

    <script src="checkout.js"></script>
</body>

</html>