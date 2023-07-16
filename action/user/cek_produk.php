<?php

if(isset($_POST['id_produk'])){
    include "../../koneksi.php";
    // Ambil nilai-nilai yang dikirimkan melalui metode POST
    $id_produk = $_POST['id_produk'];


    // Query untuk memeriksa status pembelian produk dan mengambil data jumlah dan total_harga
    $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $result = mysqli_query($koneksi, $sql);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Periksa jumlah baris hasil query
        if ($result->num_rows > 0) {
            // Buat array untuk menyimpan hasil query
            $response = array();

            // Iterasi semua baris hasil query menggunakan while
            while ($row = mysqli_fetch_assoc($result)) {

                // Tambahkan data ke array respons
                $response = array(
                    'nama_produk' => $row['nama_produk'],
                    'gambar' => $row['gambar'],
                    'harga' => $row['harga'],
                );
            }

        }
    } else {
        // Jika terjadi kesalahan dalam eksekusi query, kirimkan pesan kesalahan
        $response = array(
            'error' => 'Terjadi kesalahan dalam eksekusi query.'
        );

    }
    header('Content-Type: application/json');
    echo json_encode($response);
    // Tutup koneksi ke database
}else{
    header("Location:../../not_found.php");
}
?>