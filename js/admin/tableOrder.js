$(document).ready(function () {
  // Ganti dengan API key yang valid
  const apiUrl = "http://localhost/juice/action/api/getProduct.php"; // Ganti dengan URL endpoint API Anda

  // Buat permintaan menggunakan $.ajax
  $.ajax({
    url: apiUrl,
    type: "GET",
    data: {
      produk: "apiKey",
    },
    success: function (data) {
      console.log(data);
    },
    error: function (xhr, status, error) {
      console.error("Terjadi kesalahan saat mengambil data: " + error);
    },
  });
});
