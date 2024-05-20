<?php

namespace App\Controllers;

use App\Models\BarangModel;

class HomeController extends BaseController
{
    // Di dalam controller Anda
    public function index()
    {
        // Load model BarangModel
        $barangModel = new BarangModel();

        // Ambil data barang dari model
        $data['barang'] = $barangModel->findAll();

        // Tampilkan view 'v_home.php' dengan data barang
        return view('v_home', $data);
    }

    public function tambahKeKeranjang($id_barang)
{
    // Ambil data barang dari model berdasarkan ID
    $barangModel = new BarangModel();
    $barang = $barangModel->find($id_barang);

    // Mulai sesi jika belum dimulai
    if (!session()->has('keranjang')) {
        session()->set('keranjang', []);
    }

    // Ambil data keranjang dari sesi
    $keranjang = session()->get('keranjang');

    // Tambahkan barang ke dalam sesi keranjang
    $keranjang[] = $barang;

    // Simpan kembali data keranjang ke dalam sesi
    session()->set('keranjang', $keranjang);

    // Setelah proses selesai, Anda dapat memberikan respons kepada pengguna
    return $this->response->setJSON(['status' => 'success', 'message' => 'Barang berhasil ditambahkan ke keranjang.']);
}

}
