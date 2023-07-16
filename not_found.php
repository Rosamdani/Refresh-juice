<!DOCTYPE html>
<html>

<head>
    <title>Your Request Not Found</title>
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

    <div class="w-full h-[100vh] flex items-center justify-center">
        <?php
    // Path ke file SVG Anda
    $file = 'assets/icon/Page Not Found.svg';

    // Mendapatkan tipe konten dari file SVG
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $file_info->file($file);

    // Menghasilkan tag <img> dengan sumber file SVG
    echo "<img class='w-[50%] h-[50%]' src='data:$mime_type;base64," . base64_encode(file_get_contents($file)) . "' alt='SVG Image'>";    
    ?>
    </div>
</body>

</html>