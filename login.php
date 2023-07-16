<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Refresh Juice</title>
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

<body>
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
            </div>
        </nav>
    </div>
    <!-- End Navbar -->
    <div class="w-[50%] pt-32 mx-auto min-w-[400px] h-[100vh] flex text-lg">

        <form action="action/user/aksi_login.php" method="post" class="h-full flex items-center min-w-[50%]">
            <div class="w-full space-y-5 px-5 py-10">
                <?php if(isset($_GET['pesan']) == "login"){ 
                    ?>

                <p class="w-full py-3 pb-10 rounded text-base flex px-10 bg-red-400 text-white"><span
                        class="font-bold">Perhatian </span> : Sebelum melakukan pembelian, harap login atau register
                    terlebih dahulu!</p>

                <?php
                } ?>
                <div class="w-full">
                    <p class="text-4xl font-bold mb-3">Selamat Datang</p>
                    <p>Silahkan masuk ke akun anda atau <a href="#" class="text-orange-400">Buat akun baru</a></p>
                </div>
                <div class="w-full">
                    <input class="w-full h-[50px]  text-gray-500 rounded border outline-orange-400 border-gray-300 px-2"
                        type="text" name="username" placeholder="Masukkan username">
                </div>
                <div class="w-full">
                    <input class="w-full h-[50px]  text-gray-500 rounded border outline-orange-400 border-gray-300 px-2"
                        type="password" name="password" placeholder="Masukkan password">
                </div>
                <div class="w-full">
                    <a href="#" class="text-orange-400">Lupa password?</a>
                </div>
                <div class="w-full">
                    <input
                        class="w-full h-[50px] rounded bg-orange-400 mt-5 hover:bg-orange-600 font-bold text-white cursor-pointer"
                        type="submit" value="Login">
                </div>
                <input type="hidden" name="action" value="Login">
            </div>
        </form>
        <div class="w-full h-full border">

        </div>
    </div>
</body>

</html>