// Fungsi untuk memuat data produk dari server
function loadProduk() {
  var id_user = $(".user-id").val();
  $.ajax({
    url: "http://localhost/juice/action/user/get_data_keranjang.php", // Ganti dengan URL ke server-side script PHP Anda
    method: "POST",
    data: { id_user: id_user },
    dataType: "json",
    success: function (response) {
      // Menghapus semua elemen dengan class "item" sebelum memuat data baru
      $(".item").remove();

      // Memproses data produk yang diterima dari server
      // Mengiterasi dan menampilkan data menggunakan $.each
      $.each(response, function (index, item) {
        // Menampilkan data pada halaman
        var html = `
                <div class="item flex w-full py-2 justify-between px-5 border border-b-gray-300">
                    <div class="produk flex space-x-3">
                        <img src="${
                          item.gambar
                        }" alt="" class="product-image w-[100px] h-[100px] rounded-md">
                        <div class="keterangan">
                            <p class="text-xl font-bold nama_produk">${
                              item.nama_produk
                            }</p>
                            <p class="total-harga">${formatRupiah(
                              item.total_harga
                            )}</p>
                            
                        </div>
                    </div>
                    <div class="btn h-full  items-end justify-center flex flex-col">
                      <input type="hidden" class="product-id" value="${
                        item.id_produk
                      }">
                      <input type="hidden" class="total_harga" value="${
                        item.harga
                      }">
                      <input type="hidden" class="user-id" value="${id_user}">
                        <button
                            class="w-[30px] h-[30px] plus text-white float-right hover:bg-orange-600 duration-300 ease-in-out bg-orange-400 rounded btn-minus">+</button>
                        <input readonly value="${
                          item.jumlah
                        }" type="text" class="jumlah pr-3 w-[70px] flex text-right outline-none border-none">
                        <button
                            class="w-[30px] h-[30px] minus text-white float-right hover:bg-orange-600 duration-300 ease-in-out bg-orange-400 rounded btn-plus">-</button>
                    </div>
                </div>
            `;
        $("#data-container").append(html);
      });
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

// Fungsi untuk menghitung jumlah keseluruhan dan total harga keseluruhan
function calculateTotal() {
  var totalQuantity = 0;
  var totalPrice = 0;

  $(".item").each(function () {
    var quantity = parseInt($(this).find(".jumlah").val());
    var price = parseFloat($(this).find(".total_harga").val());

    totalQuantity += quantity;
    totalPrice += quantity * price;
  });

  // Tampilkan nilai jumlah keseluruhan dan total harga keseluruhan
  $("#total-quantity").text(totalQuantity);
  $("#total-price").text(formatRupiah(totalPrice));
}

// Memuat data produk saat halaman checkout dimuat
$(document).ready(function () {
  // Memuat ulang data produk setiap 5 detik
  setInterval(function () {
    loadProduk();
    calculateTotal();
  }, 1000); // Ganti angka 5000 dengan interval yang diinginkan (dalam milidetik)
});

// Fungsi untuk mengubah angka menjadi format rupiah
function formatRupiah(angka) {
  var formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0, // Mengubah opsi minimumFractionDigits menjadi 0
  });
  return formatter.format(angka);
}

function buttonProduk() {
  //Ketika tombol - di klik
  $(document).on("click", ".minus", function () {
    var container = $(this).closest(".item");
    var quantity = parseInt(container.find(".jumlah").val());
    if (quantity > 1) {
      quantity--;
      container.find(".jumlah").val(quantity);
      updateTotal(container, quantity);
    } else if (quantity === 1) {
      var id_produk = container.find(".product-id").val();
      var id_user = container.find(".user-id").val();

      // Hapus data produk dari database pesanan menggunakan Ajax
      $.ajax({
        type: "POST",
        url: "http://localhost/juice/action/user/../../action/user/delete_product.php",
        data: {
          id_produk: id_produk,
          id_user: id_user,
        },
        success: function (response) {
          loadProduk(); // Memuat ulang data produk setelah menghapus
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
        },
      });
    }
    calculateTotal();
  });

  $(document).on("click", ".plus", function () {
    var container = $(this).closest(".item");
    var quantity = parseInt(container.find(".jumlah").val());
    quantity++;
    container.find(".jumlah").val(quantity);
    updateTotal(container, quantity);
    calculateTotal();
  });

  function updateTotal(container, quantity) {
    var pricePerProduct = parseFloat(container.find(".total_harga").val());
    var total = quantity * pricePerProduct;
    container.find(".total-harga").text(formatRupiah(total));

    var id_produk = container.find(".product-id").val();
    var id_user = container.find(".user-id").val();
    var total_harga = total;
    $.ajax({
      type: "POST",
      url: "http://localhost/juice/action/user/../../action/user/update_quantity.php",
      data: {
        id_produk: id_produk,
        id_user: id_user,
        jumlah: quantity,
        total_harga: total_harga,
      },
      success: function (response) {},
      error: function (xhr, status, error) {
        console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
      },
    });
  }
}

buttonProduk();
loadProduk();

// Fungsi untuk menghapus semua data
function deleteAllData() {
  var id_user = $(".user-id").val();

  // Menampilkan konfirmasi penghapusan
  var confirmation = confirm(
    "Apakah Anda yakin ingin membatalkan semua pesanan?"
  );

  if (confirmation) {
    // Menghapus semua data produk dari database menggunakan Ajax
    $.ajax({
      type: "POST",
      url: "http://localhost/juice/action/user/../../action/user/delete_all_data.php",
      data: {
        id_user: id_user,
      },
      success: function (response) {
        calculateTotal();
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
      },
    });
    calculateTotal();
  }
}
