<?php
include "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css.css">
</head>

<body class="bg-gray-200">
    <nav class="w-full h-28 shadow-lg fixed z-10 bg-white">
        <div class="flex justify-between h-full px-10 items-center text-xl">
            <div class="logo-container">
                <img src="assets/logo.jpeg" alt="Logo">
            </div>
            <div class="navbar">
                <ul class="flex space-x-5">
                    <li class="font-bold"><a href="index.php">Home</a></li>
                    <div class="dropdown">
                        <li><button class="dropbtn">Bank Soal</li>
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="bank_soal.php">Lihat</a></li>
                            <li class=""><a href="upload_soal.php">Upload</a></li>
                        </div>
                    </div>
                    <div class="dropdown">
                        <li class=""><button class="dropbtn">Alumni</li>
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <li><a href="alumni.php">Alumni</a></li>
                            <li class="demis.php"><a href="demis.php">Demisioner</a></li>
                        </div>
                    </div>
                    <li><a href="#">Aspirasi</a></li>
                    <div class="dropdown">
                        <li><button class="dropbtn">Informatics Store</li>
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <li><a href="produk.php">Produk</a></li>
                            <a href="promo.php">Promo</a>
                        </div>
                    </div>
                    <li><a href="#">Tentang Kami</a></li>
                </ul>
            </div>
            <a href="dashboard.php">Login</a>
        </div>
    </nav>

    <section class="w-full py-36 max-h-fit">
        <div class="w-[90%] h-20 border mx-auto grid grid-cols-2 gap-5">
            <?php
            // Query untuk mendapatkan data berita
            $sql = "SELECT * FROM berita WHERE tampil = 0";
            $index = 0;
            $query = mysqli_query($koneksi, $sql);
            if ($query->num_rows > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    if ($index == 0) {
            ?>
            <div class="col-span-2 bg-white relative h-[400px]">
                <img src="<?= $row['gambar'] ?>" class="w-full h-full bg-cover" alt="News">
                <div
                    class="absolute top-0 left-0 text-white max-w-fit px-10 bg-gradient-to-br from-black to-transparent">
                    <p class="text-2xl max-w-[90%] py-2"><?= $row['judul'] ?></p>
                </div>
                <div class="absolute max-w-fit left-10 bottom-7 flex space-x-5">
                    <button class="px-3 py-2 bg-gray-300" data-value="<?= $row['id_berita'] ?>"
                        onclick="showModal(this.getAttribute('data-value'))">Komen</button>
                    <button class="px-3 py-2 bg-gray-300">Selengkapnya</button>
                </div>
            </div>
            <?php
                    } else {
            ?>
            <div class="bg-white relative h-[400px] max-h-[1000px]">
                <img src="<?= $row['gambar'] ?>" class="w-full h-full bg-cover" alt="News">
                <div
                    class="absolute top-0 left-0 text-white max-w-fit px-10 bg-gradient-to-br from-black to-transparent">
                    <p class="text-2xl max-w-[90%] py-2"><?= $row['judul'] ?></p>
                </div>
                <div class="absolute max-w-fit left-10 bottom-7 flex space-x-5">
                    <button class="px-3 py-2 bg-gray-300" data-value="<?= $row['id_berita'] ?>"
                        onclick="showModal(this.getAttribute('data-value'))">Komen</button>
                    <button class="px-3 py-2 bg-gray-300">Selengkapnya</button>
                </div>
            </div>
            <?php
                    }
                    $index++;
                }
            }
            ?>
        </div>
    </section>

    <div id="commentModal" class="fixed bottom-0 w-full bg-white shadow comment-modal translate-y-full">
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-2">Komentar</h2>
            <ul class="space-y-4 max-h-[500px] overflow-y-auto" id="commentList">
                <!-- Daftar komentar -->
            </ul>
            <form id="commentForm" class="mt-4">
                <input type="hidden" id="modalIdBerita" name="id_berita">
                <textarea id="commentInput" class="w-full h-20 px-4 py-2 border border-gray-300 rounded"
                    placeholder="Tulis komentar"></textarea>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded mt-4">Post Komentar</button>
                <button id="closeModalButton" class="px-4 py-2 bg-red-500 text-white rounded">Tutup</button>
            </form>
        </div>
    </div>

    <script>
    const commentModal = document.getElementById('commentModal');
    const showModalButtons = document.querySelectorAll('.show-modal-button');
    const closeModalButton = document.getElementById('closeModalButton');
    const commentForm = document.getElementById('commentForm');
    const commentInput = document.getElementById('commentInput');
    const commentList = document.getElementById('commentList');
    const modalIdBerita = document.getElementById('modalIdBerita');

    function showModal(id_berita) {
        modalIdBerita.value = id_berita;
        commentModal.classList.remove('translate-y-full');
        getComments(id_berita);
    }

    function hideModal() {
        commentModal.classList.add('translate-y-full');
    }

    function getComments(id_berita) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_comments.php?id_berita=' + id_berita, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    displayComments(response.comments);
                } else {
                    console.error('Error: ' + xhr.status);
                }
            }
        };
        xhr.send();
    }

    function displayComments(comments) {
        commentList.innerHTML = ''; // Menghapus komentar yang ada sebelumnya
        if (comments.length > 0) {
            comments.forEach(comment => {
                const li = document.createElement('li');
                li.innerHTML = `
                        <p class="font-semibold"> User:</p>
                        <p>${comment.komentar}</p>
                    `;
                commentList.appendChild(li);
            });
        } else {
            const li = document.createElement('li');
            li.textContent = 'Tidak ada komentar.';
            commentList.appendChild(li);
        }
    }

    showModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id_berita = button.getAttribute('data-value');
            showModal(id_berita);
        });
    });

    closeModalButton.addEventListener('click', () => {
        hideModal();
    });

    commentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const id_berita = modalIdBerita.value;
        const commentText = commentInput.value.trim();
        if (commentText !== '') {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_comment.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            getComments(id_berita);
                            commentInput.value = '';
                        } else {
                            console.error('Error: ' + response.message);
                        }
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };
            const params = 'id_berita=' + id_berita + '&komentar=' + encodeURIComponent(commentText);
            xhr.send(params);
        }
    });

    commentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const id_berita = modalIdBerita.value;
        const commentText = commentInput.value.trim();
        if (commentText !== '') {
            $.ajax({
                url: 'save_comment.php',
                method: 'POST',
                data: {
                    id_berita: id_berita,
                    komentar: commentText
                },
                success: function(response) {
                    if (response.success) {
                        // Komentar berhasil disimpan, lakukan sesuatu (misalnya memperbarui daftar komentar)
                        getComments(id_berita);
                        commentInput.value = '';
                    } else {
                        console.error('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }
    });
    </script>

</body>

</html>