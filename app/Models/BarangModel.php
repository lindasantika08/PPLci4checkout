<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['nama_barang', 'deskripsi_barang', 'harga_barang', 'stok_barang', 'gambar', 'created_at', 'updated_at'];

    public function deleteBarang($id_barang) {
        // Panggil fungsi untuk menghapus barang dari keranjang sesi
        return $this->delete($id_barang);
    }
}


