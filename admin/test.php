<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body>
    <script>
    $(document).ready(function() { // Ganti dengan API key yang valid
        const apiUrl = "http://localhost/juice/action/api/getProduct.php"; // Ganti dengan URL endpoint API Anda

        // Buat permintaan menggunakan $.ajax
        $.ajax({
            url: apiUrl,
            type: "GET",
            data: {
                produk: "apiKey"
            },
            success: function(data) {
                // Hasil dari API akan tersedia dalam variabel 'data'
                // Di sini Anda bisa memanipulasi data dan menampilkan hasilnya
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan saat mengambil data: " + error);
            }
        });
    });
    </script>
</body>

</html>