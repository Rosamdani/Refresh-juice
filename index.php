<?php
include 'koneksi.php';
include 'cek_sesi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/85550cfb5f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap');

    * {
        font-family: 'poppins';
    }

    .with-badge {
        position: relative;
    }

    .with-badge::before {
        content: "";
        position: absolute;
        top: -5px;
        right: -5px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #FF3A3A;
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
                <li><a class="text-orange-600 font-bold" href="#">Beranda</a></li>
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

                <a href="#" id="cart-btn"><i class="fa-solid fa-cart-shopping hover:text-orange-600"></i></a>
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
    <div class="w-[50%] mx-auto min-w-[400px] text-lg">

        <!-- Konten Produk -->
        <?php
        if (isset($_GET['cari'])) { // Jika pengguna melakukan pencarian
            $key = $_GET['cari'];
            $sql = "SELECT * FROM produk WHERE nama_produk = '$key'";
            $query = mysqli_query($koneksi, $sql);

            if ($query->num_rows > 0) { //Jika produk yang dicari ditemukan
                items($query);
            } else { //Jika produk yang dicari tidak ditemukan
                item_kosong();
            }
        } else { // Jika pengguna tidak melakukan pencarian
            $sql = "SELECT * FROM produk";
            $query = mysqli_query($koneksi, $sql);
            if ($query->num_rows > 0) {
                items($query);
            }
        }

        ?>
        <div id="total-div"
            class="fixed left-[50%] -translate-x-[50%] bottom-10 w-[60%] py-3 rounded-lg px-10 bg-orange-600 text-white flex justify-between items-center">
            <div>
                <p>Total Pesanan : <span id="total-quantity"></span></p>
                <p>Total Harga: <span id="total-price"></span></p>
            </div>
            <a href="" class="px-3 rounded-md py-1 bg-orange-400">Lihat Keranjang</a>
        </div>
    </div>
    <!-- End Konten Produk -->


    <!-- Menampilkan total produk dan total harga -->

    <!-- Footer -->
    <footer class="w-full pt-20 border-t-[7px] bg-white border-orange-400 h-[400px]">
        <div class="container"></div>
    </footer>
    <!-- End Footer -->


    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white w-1/3 rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Form Pencarian</h2>
            <div class="mb-4">
                <form method="get">
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-700">Kata kunci</label>
                    <input type="text" id="search" name="cari"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Masukkan kata kunci">
                </form>
            </div>
            <div class="flex justify-end">
                <button data-modal-hide="modal" id="modal-close-button"
                    class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded">Batal</button>
            </div>
        </div>
    </div>
    <!-- END MODAL -->

    <!-- SCRIPT JS -->
    <script src="script.js"></script>

</body>

</html>


<!-- Function PHP -->
<?php

function items($query)
{
    global $userID;
?>
<div class="grid grid-cols-3 gap-5 pt-32 mb-20 w-full">
    <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
    <div method="post" class="card-produk w-[100%] pb-5 rounded-lg shadow-md border bg-white">
        <input type="hidden" name="id_kategori" value="<?= $row['id_kategori'] ?>">
        <div class="">
            <img src="<?= $row['gambar'] ?>" alt="" class="w-full h-[300px] rounded-lg">
            <div class="px-5 py-2 space-y-1 overflow-hidden">
                <input class="text-orange-400 font-bold text-2xl w-full outline-none border-none" readonly
                    value="<?= $row['nama_produk'] ?>">
                <p><?= $row['deskripsi'] ?></p>
                <div class="container w-full space-y-2">
                    <input type="hidden" class="product-id" value="<?=$row['id_produk']?>">
                    <input type="hidden" class="user-id" value="<?=@$userID?>">
                    <input type="number" class="text-base product-price" value="<?= $row['harga'] ?>" readonly>
                    <button
                        class="buy-btn w-full bg-orange-400 text-white font-bold text-lg rounded-md px-4 py-2">Beli</button>
                    <div class="quantity justify-between flex items-center space-x-2 hidden">
                        <button
                            class="minus-btn bg-orange-400 text-white font-bold text-lg rounded-md px-3 py-1">-</button>
                        <input type="number" class="product-quantity w-16 text-center" value="0" min="0" readonly>
                        <button
                            class="plus-btn bg-orange-400 text-white font-bold text-lg rounded-md px-3 py-1">+</button>
                    </div>
                    <input type="hidden" class="total" name="total" value="0" readonly>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
        ?>
</div>
<?php
}

function item_kosong()
{
?>
<div class="w-full h-[60vh] flex flex-col justify-center items-center text-slate-400">
    <img src="assets/img/box.png" alt="" class="w-52 h-52 mb-2">
    <h3 class="text-xl font-semibold">Produk yang anda cari tidak ada!</h3>
    <p class="text-sm mt-1">Mohon gunakan kata kunci yang lain</p>
</div>
<?php
}