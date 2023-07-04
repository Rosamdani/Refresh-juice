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

<body class=" bg-gray-200">
    <!-- Navbar -->
    <div class="w-full shadow-md fixed bg-white">
        <nav class="container mx-auto flex justify-between items-center h-28 ">
            <div class="logo flex space-x-2 items-center">
                <img src="assets/logo/logo.png" class="w-[60px] h-[60px]" alt="Belum ada">
                <p class="text-2xl font-bold">Refresh Juice</p>
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
                <a href="#"><i class="fa-solid fa-cart-shopping hover:text-orange-600"></i></a>
                <a href="#"><i class="fa-solid fa-user hover:text-orange-600"></i></a>



            </div>
        </nav>
    </div>
    <!-- End Navbar -->
    <div class="container mx-auto min-w-[40%] text-xl">


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
    </div>
    <!-- End Konten Produk -->

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
            <form method="get">
                <div class="mb-4">
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-700">Kata kunci</label>
                    <input type="text" id="search" name="cari"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Masukkan kata kunci">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-orange-400 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded">Cari</button>
                    <button id="modal-close-button"
                        class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END MODAL -->

    <!-- SCRIPT JS -->
    <script>
    const modalOpenButton = document.getElementById('modal-open-button');
    const modalCloseButton = document.getElementById('modal-close-button');
    const modal = document.getElementById('modal');

    modalOpenButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    modalCloseButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
    </script>

</body>

</html>


<!-- Function PHP -->
<?php

function items($query)
{
?>
<div class="grid grid-cols-4 gap-5 pt-32 mb-20">
    <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
    <form method="post" class="card-produk w-[350px] h-[500px] rounded-lg shadow-md border bg-white">
        <input type="hidden" name="id" value="<?= $row['id_produk'] ?>">
        <input type="hidden" name="id_kategori" value="<?= $row['id_kategori'] ?>">
        <div class="">
            <img src="<?= $row['gambar'] ?>" alt="" class="w-full h-[350px] rounded-lg">
            <div class="px-5 py-2 space-y-1">
                <p class="text-orange-400 font-bold text-2xl"><?= $row['nama_produk'] ?></p>
                <p class="text-base">Rp.<?= $row['harga'] ?></p>
                <p><?= $row['deskripsi'] ?></p>
                <input type="submit" value="Beli" name="submit-beli"
                    class="w-full py-2 rounded-lg bg-orange-600 text-white cursor-pointer hover:bg-orange-700">
            </div>
        </div>
    </form>

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