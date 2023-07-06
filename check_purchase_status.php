<?php

include "koneksi.php";
// Ambil nilai-nilai yang dikirimkan melalui metode POST
$id_produk = $_POST['id_produk'];
$id_user = $_POST['id_user'];


// Query untuk memeriksa status pembelian produk dan mengambil data jumlah dan total_harga
$sql = "SELECT * FROM keranjang WHERE id_produk='$id_produk' AND id_user='$id_user'";

$result = mysqli_query($koneksi, $sql);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Periksa jumlah baris hasil query
    if ($result->num_rows > 0) {
        // Buat array untuk menyimpan hasil query
        $response = array();

        // Iterasi semua baris hasil query menggunakan while
        while ($row = mysqli_fetch_assoc($result)) {
            $jumlah = $row['jumlah']; // Kolom jumlah
            $total_harga = $row['total_harga']; // Kolom total_harga

            // Tambahkan data ke array respons
            $response = array(
                'status' => 'purchased',
                'jumlah' => $jumlah,
                'total_harga' => $total_harga
            );
        }

    } else {
        // Jika tidak ada baris hasil, kirimkan respons 'not_purchased'
        $response = array(
            'status' => 'not_purchased'
        );

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
$koneksi->close();
?>