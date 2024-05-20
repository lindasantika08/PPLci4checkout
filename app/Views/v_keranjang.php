<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary px-4">
        <div class="container-fluid justify-content-left">
            <a class="navbar-brand" href="<?= base_url('/') ?>">Toko Online</a>
            <a class="navbar-item" href="#">
                <i class="fa fa-shopping-cart"></i>
            </a>
            
        </div>
    </nav>

    <!-- Mulai penambahan container -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Keranjang Belanja</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($keranjang) && is_array($keranjang)) : ?>
                        <?php foreach ($keranjang as $index => $item) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $item['nama_barang']; ?></td>
                                <td><?php echo $item['harga_barang']; ?></td>
                                <td><?php echo $item['qty']; ?></td>
                                <td><?php echo $item['qty'] * $item['harga_barang']; ?></td>
                                <td>
                                <form action="<?= base_url('Keranjang/delete/'.$item['id_barang']) ?>" method="get">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No items in the cart.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- Tambahkan subtotal dan tombol Checkout hanya jika keranjang tidak kosong -->
                <?php if (!empty($keranjang)) : ?>
                    <!-- Hitung subtotal -->
                    <?php
                    $subtotal = 0;
                    foreach ($keranjang as $item) {
                        $subtotal += $item['qty'] * $item['harga_barang'];
                    }
                    ?>
                    <p class="text-start">Subtotal: Rp <?= number_format($subtotal, 0, ',', '.'); ?></p>

                    <div class="text-center">
                        <a href="<?= base_url('Keranjang/checkout') ?>" class="btn btn-primary">Checkout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Akhir penambahan container -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
