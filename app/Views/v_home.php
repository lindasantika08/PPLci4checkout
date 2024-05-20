<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-img-top {
            width: 100%;
            height: 15rem;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary px-4">
        <div class="container-fluid justify-content-left">
            <a class="navbar-brand" href="#">Toko Online</a>
            <!-- Perubahan dilakukan di sini -->
            <a class="navbar-item" href="/keranjang">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </div>
    </nav>

    <!-- Mulai penambahan container -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Kolom pertama -->
            <?php foreach ($barang as $row) : ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                    <img src="/assets/macbook.jpg" class="card-img-top" alt="macbook.jpg">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nama_barang']; ?></h5>
                            <p class="card-text">Harga: Rp<?php echo $row['harga_barang']; ?><br>Stok: <?php echo $row['stok_barang']; ?></p>
                            <form action="<?= base_url('tambahKeKeranjang/'.$row['id_barang']) ?>" method="post">
                                <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Akhir penambahan container -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>

<!-- JavaScript di dalam halaman Anda -->
<script>
    // Fungsi untuk menangani klik tombol "Tambahkan ke Keranjang"
    function tambahkanKeKeranjang(idBarang) {
        fetch('/tambahKeKeranjang/' + idBarang, { // Perubahan URL akses
            method: 'POST'
        })
        .then(response => {
            if (response.ok) {
                return response.json(); // Ubah respons ke JSON
            } else {
                throw new Error('Gagal menambahkan barang ke keranjang.'); // Tangani kesalahan jika respons tidak OK
            }
        })
        .then(data => {
            // Tampilkan pesan sukses
            console.log(data.message);

            // Refresh halaman untuk memperbarui keranjang
            window.location.reload();
        })
        .catch(error => {
            // Tangani kesalahan jika ada
            console.error('Error:', error);
        });
    }
</script>

