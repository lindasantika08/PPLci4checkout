<?php

namespace App\Controllers;

use App\Models\BarangModel;

class BarangController extends BaseController
{
    public function index()
    {
        $model = new BarangModel();
        $data['barang'] = $model->findAll();
        return view('barang/index', $data);
    }

    public function create()
    {
        // Tampilkan formulir untuk menambahkan barang
        return view('barang/create');
    }

    public function store()
    {
        // Validasi data barang yang diunggah
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_barang' => 'required',
            'deskripsi_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'stok_barang' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]'
        ]);

        if ($validation->withRequest($this->request)->run() === false) {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan kesalahan
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses unggah gambar
        $gambar = $this->request->getFile('gambar');
        $newName = $gambar->getRandomName();
        $gambar->move(ROOTPATH . 'public/uploads', $newName);

        // Simpan data barang ke dalam basis data
        $model = new BarangModel();
        $model->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'deskripsi_barang' => $this->request->getVar('deskripsi_barang'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'stok_barang' => $this->request->getVar('stok_barang'),
            'gambar' => $newName // Simpan nama file gambar ke dalam basis data
        ]);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->to('/barang')->with('success', 'Barang berhasil ditambahkan');
    }
}
