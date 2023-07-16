<?php


if(isset($_POST['id_user'])){
    // Koneksi ke database
    include "../../koneksi.php";

    // Mendapatkan id_user dari permintaan POST
    $id_user = $_POST['id_user'];

    // Query untuk mendapatkan data terbaru berdasarkan id_user
    $query = "SELECT * FROM keranjang WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $query);

    $data = array();

    if ($result->num_rows > 0) {

        // Iterasi semua baris hasil query menggunakan while
        while ($row = $result->fetch_assoc()) {
            $id_produk = $row['id_produk'];
            $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
            $result_produk = mysqli_query($koneksi, $sql); // Ganti $result menjadi $result_produk
            if($result_produk){
                while($hasil = mysqli_fetch_array($result_produk)){
                    $nama_produk = $hasil['nama_produk'];
                    $harga = $hasil['harga'];
                    $gambar = $hasil['gambar'];
                }
            }
            $item = array(
                'jumlah' => $row['jumlah'],
                'total_harga' => $row['total_harga'],
                'id_keranjang' => $row['id_keranjang'],
                'id_produk' => $row['id_produk'],
                'nama_produk' => $nama_produk,
                'gambar' => $gambar,
                'harga' => $harga,
            );
            $data[] = $item;
        }

    }

    // Mengembalikan data sebagai respons JSON
        header('Content-Type: application/json');
        echo json_encode($data);

}else{
    header('Location:../../not_found.php');
}

?>