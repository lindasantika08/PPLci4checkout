<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\Controller;

class Keranjang extends Controller
{
    public function index()
{
    $keranjang = $this->getBarangDariKeranjang();
    
    // Calculate total price and update each item in the cart
    foreach ($keranjang as &$item) {
        // Ensure that each item has a 'qty' key
        $item['qty'] = isset($item['qty']) ? $item['qty'] : 0;
        // Calculate total price for each item
        $item['total'] = $item['qty'] * $item['harga_barang'];
    }
    
    return view('v_keranjang', ['keranjang' => $keranjang]);
}


    
public function tambahKeKeranjang($id_barang)
{
    $barangModel = new BarangModel();
    $barang = $barangModel->find($id_barang);

    if (is_array($barang)) {
        $session = session();
        $keranjang = $session->get('keranjang');

        // Periksa apakah barang sudah ada dalam keranjang
        if (isset($keranjang[$id_barang])) {
            // Jika sudah ada, tambahkan 1 ke kuantitas
            if (isset($keranjang[$id_barang]['qty'])) {
                $keranjang[$id_barang]['qty']++;
            } else {
                // If qty key is not set, initialize it to 1
                $keranjang[$id_barang]['qty'] = 1;
            }
        } else {
            // Jika belum ada, tambahkan barang ke keranjang dengan kuantitas 1
            $barang['qty'] = 1;
            $keranjang[$id_barang] = $barang;
        }

        $session->set('keranjang', $keranjang);

        $this->response->setJSON(['status' => 'success', 'message' => 'Barang berhasil ditambahkan ke keranjang.']);
        return redirect()->to('/');
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Barang tidak ditemukan.']);
    }
}



    public function getBarangDariKeranjang()
    {
        $session = session();
        $keranjang = $session->get('keranjang');
        return $keranjang ? $keranjang : [];
    }

    public function delete($id_barang)
    {
        $keranjang = session()->get('keranjang');
        
        if (array_key_exists($id_barang, $keranjang)) {
            unset($keranjang[$id_barang]); // Remove item from cart
            session()->set('keranjang', $keranjang); // Update session with modified cart
        }
        
        return view('keranjang')->with('message', 'Item removed successfully.');
    }


    public function checkout()
    {
        // Dapatkan data keranjang dari sesi
        $keranjang = session()->get('keranjang');

        // Hitung total harga pembelian
        $total_harga = 0;
        foreach ($keranjang as $item) {
            $total_harga += $item['qty'] * $item['harga_barang'];
        }

        // Hapus keranjang dari sesi
        session()->remove('keranjang');

        // Tampilkan halaman checkout dengan total harga pembelian
        return view('v_checkout', ['total_harga' => $total_harga]);
    }

}

