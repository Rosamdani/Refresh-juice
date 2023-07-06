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
  function formatRupiah(angka) {
    var formatter = new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
    });
    return formatter.format(angka);
  }

  $(".buy-btn").click(function () {
    var container = $(this).closest(".container");
    container.find(".buy-btn").hide();
    container.find(".quantity").removeClass("hidden");
    container.find(".product-quantity").val("1");
    calculateTotal(container, 1);
    var id_produk = container.find(".product-id").val();
    var id_user = container.find(".user-id").val();
    var jumlah = parseInt(container.find(".product-quantity").val());
    var total_harga = parseFloat(
      container.find(".total").val().replace("Rp ", "").replace(",", "")
    );

    // Kirim data ke file PHP untuk disimpan ke database menggunakan Ajax
    $.ajax({
      type: "POST",
      url: "save_purchase.php",
      data: {
        id_produk: id_produk,
        id_user: id_user,
        jumlah: jumlah,
        total_harga: total_harga,
      },
      success: function (response) {
        console.log(response); // Tampilkan respons dari server (opsional)
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
      },
    });
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
        url: "delete_product.php",
        data: {
          id_produk: id_produk,
          id_user: id_user,
        },
        success: function (response) {
          console.log(response); // Tampilkan respons dari server (opsional)

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
    calculateTotal(container, quantity);
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
      url: "update_quantity.php",
      data: {
        id_produk: id_produk,
        id_user: id_user,
        jumlah: quantity,
        total_harga: total_harga,
      },
      success: function (response) {
        console.log(response); // Tampilkan respons dari server (opsional)
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
      },
    });
  }

  function calculateTotal(container, quantity) {
    var pricePerProduct = parseFloat(container.find(".product-price").val());
    var total = quantity * pricePerProduct;
    container.find(".total").val("Rp " + total.toLocaleString("id-ID"));

    // Kirim data ke file PHP untuk mengupdate jumlah di database menggunakan Ajax
    var id_produk = container.find(".product-id").val();
    var id_user = container.find(".user-id").val();
    var total_harga = total;
    $.ajax({
      type: "POST",
      url: "update_quantity.php",
      data: {
        id_produk: id_produk,
        id_user: id_user,
        jumlah: quantity,
        total_harga: total_harga,
      },
      success: function (response) {
        console.log(response); // Tampilkan respons dari server (opsional)
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText); // Tampilkan pesan kesalahan (opsional)
      },
    });
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
    url: "check_purchase_status.php",
    data: {
      id_produk: id_produk,
      id_user: id_user,
    },
    success: function (response) {
      // response = JSON.parse(response); // Parse respons sebagai JSON jika tipe data adalah string
      if (response.status == "purchased") {
        console.log("Status Berhasil : " + response.status);
        container.find(".buy-btn").hide();
        container.find(".btn-minus").show();
        container.find(".btn-plus").show();
        container.find(".quantity").removeClass("hidden");
        container.find(".product-quantity").val(response.jumlah);
        container
          .find(".total")
          .val("Rp " + formatRupiah(response.total_harga));
      } else {
        console.log("Respon Gagal : " + response.status);
        container.find(".buy-btn").show();
        container.find(".btn-minus").hide();
        container.find(".btn-plus").hide();
        container.find(".quantity").addClass("hidden");
        container.find(".product-quantity").val("0");
        container.find(".total").val("Rp 0");
      }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    },
  });
}

function formatRupiah(angka) {
  var formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
  });
  return formatter.format(angka);
}
