const modalOpenButton = document.getElementById("modal-open-button");
const modalCloseButton = document.getElementById("modal-close-button");
const modal = document.getElementById("modal");

modalOpenButton.addEventListener("click", () => {
  modal.classList.remove("hidden");
});

modalCloseButton.addEventListener("click", () => {
  modal.classList.add("hidden");
});

//+- button
$(document).ready(function () {
  // Fungsi untuk mengubah angka menjadi format rupiah

  $(".buy-btn").click(function () {
    // Mengecek keberadaan sessionID sebelum melakukan pembelian
    if (getCookie("sessionID")) {
      var container = $(this).closest(".container");
      container.find(".buy-btn").hide();
      container.find(".quantity").removeClass("hidden");
      container.find(".product-quantity").val("1");
      updateTotal(container, 1);
      var id_produk = container.find(".product-id").val();
      var id_user = container.find(".user-id").val();
      var jumlah = parseInt(container.find(".product-quantity").val());
      var total_harga = parseFloat(
        container.find(".total").val().replace("Rp ", "").replace(",", "")
      );

      // Kirim data ke file PHP untuk disimpan ke database menggunakan Ajax
      $.ajax({
        type: "POST",
        url: "http://localhost/juice/action/user/save_purchase.php",
        data: {
          id_produk: id_produk,
          id_user: id_user,
          jumlah: jumlah,
          total_harga: total_harga,
        },
        success: function (response) {},
        error: function (xhr, status, error) {
          console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
        },
      });
    } else {
      // Pengguna belum login atau tidak memiliki sessionID, arahkan ke halaman login
      window.location.href = "login.php?pesan=login";
    }
  });

  $(document).on("click", ".minus-btn", function () {
    var container = $(this).closest(".container");
    var quantity = parseInt(container.find(".product-quantity").val());
    if (quantity > 1) {
      quantity--;
      container.find(".product-quantity").val(quantity);
      updateTotal(container, quantity);
    } else if (quantity == 1) {
      // Hapus data produk dari database pesanan menggunakan Ajax
      var id_produk = container.find(".product-id").val();
      var id_user = container.find(".user-id").val();
      $.ajax({
        type: "POST",
        url: "http://localhost/juice/action/user/delete_product.php",
        data: {
          id_produk: id_produk,
          id_user: id_user,
        },
        success: function (response) {
          // Reset nilai jumlah dan tombol beli setelah data dihapus
          container.find(".product-quantity").val("0");
          container.find(".buy-btn").show();
          container.find(".quantity").addClass("hidden");
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
        },
      });
    }
  });

  $(document).on("click", ".plus-btn", function () {
    var container = $(this).closest(".container");
    var quantity = parseInt(container.find(".product-quantity").val());
    quantity++;
    container.find(".product-quantity").val(quantity);
    updateTotal(container, quantity);
  });

  function updateTotal(container, quantity) {
    var pricePerProduct = parseFloat(container.find(".product-price").val());
    var total = quantity * pricePerProduct;
    container.find(".total").val("Rp " + total.toLocaleString("id-ID"));

    var id_produk = container.find(".product-id").val();
    var id_user = container.find(".user-id").val();
    var total_harga = total;
    $.ajax({
      type: "POST",
      url: "http://localhost/juice/action/user/update_quantity.php",
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
  // Fungsi untuk mendapatkan nilai cookie
  function getCookie(name) {
    var cookieName = name + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(";");
    for (var i = 0; i < cookieArray.length; i++) {
      var cookie = cookieArray[i];
      while (cookie.charAt(0) === " ") {
        cookie = cookie.substring(1);
      }
      if (cookie.indexOf(cookieName) === 0) {
        return cookie.substring(cookieName.length, cookie.length);
      }
    }
    return null;
  }
});

//Mengecek database keranjang untuk memastikan produk sudah dibeli atau belum
$(document).ready(function () {
  $(".container").each(function () {
    var container = $(this);
    var id_produk = container.find(".product-id").val();
    if (id_produk !== undefined) {
      checkPurchaseStatus(container, id_produk);
    }
  });
});

function checkPurchaseStatus(container, id_produk) {
  var id_user = container.find(".user-id").val();

  $.ajax({
    type: "POST",
    url: "http://localhost/juice/action/user/check_purchase_status.php",
    data: {
      id_produk: id_produk,
      id_user: id_user,
    },
    success: function (response) {
      // response = JSON.parse(response); // Parse respons sebagai JSON jika tipe data adalah string
      if (response.status == "purchased") {
        container.find(".buy-btn").hide();
        container.find(".btn-minus").show();
        container.find(".btn-plus").show();
        container.find(".quantity").removeClass("hidden");
        container.find(".product-quantity").val(response.jumlah);
        container.find(".total").val(response.total_harga);
      } else {
        container.find(".buy-btn").show();
        container.find(".btn-minus").hide();
        container.find(".btn-plus").hide();
        container.find(".quantity").addClass("hidden");
        container.find(".product-quantity").val("0");
        container.find(".total").val(0);
      }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    },
  });
}

$(document).ready(function () {
  // Panggil fungsi calculateTotal() pada saat halaman pertama kali dimuat
  calculateTotal();

  // Tetapkan interval waktu (misalnya, 5 detik) untuk memperbarui jumlah dan harga secara berkala
  setInterval(function () {
    calculateTotal();
  }, 1000); // Ganti nilai 5000 dengan interval waktu yang diinginkan (dalam milidetik)
});

function calculateTotal() {
  // Mendapatkan ID pengguna dari suatu sumber (misalnya, dari elemen input)
  var id_user = $(".user-id").val();

  // Lakukan request AJAX untuk mendapatkan data terbaru dari database berdasarkan id_user
  $.ajax({
    type: "POST",
    url: "http://localhost/juice/action/user/get_latest_data.php",
    data: { id_user: id_user }, // Mengirimkan id_user ke skrip PHP
    dataType: "json",
    success: function (response) {
      // response = JSON.parse(response); // Parse respons sebagai JSON jika tipe data adalah string
      var totalQuantity = 0;
      var totalPrice = 0;

      // Lakukan perulangan untuk mengakses data terbaru dan menghitung jumlah pesanan keseluruhan dan total harga
      // Iterasi setiap data untuk menjumlahkan quantity dan price
      $.each(response, function (index, data) {
        var quantity = parseInt(data.jumlah);
        var price = parseInt(data.total_harga);

        if (!isNaN(quantity) && !isNaN(price)) {
          totalQuantity += quantity;
          totalPrice += price;
        }
      });

      // Menampilkan jumlah pesanan keseluruhan dan total harga
      $("#total-quantity").text(totalQuantity);
      $("#total-price").text("Rp " + totalPrice);

      // Menyembunyikan atau menampilkan div berdasarkan kondisi totalQuantity
      var button = $("#cart-btn");
      var total_div = $("#total-div");
      if (totalQuantity > 0) {
        total_div.removeClass("hidden");
        total_div.addClass("flex");
        button.addClass("with-badge");
      } else {
        button.removeClass("with-badge");
        total_div.removeClass("flex");
        total_div.addClass("hidden");
      }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    },
  });
}
