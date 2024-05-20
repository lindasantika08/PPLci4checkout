<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJualTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penjualan' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'id_barang' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'jumlah_jual' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'harga_jual' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey(['id_penjualan', 'id_barang'], true);
        $this->forge->addForeignKey('id_penjualan', 'penjualan', 'id_penjualan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jual');
    }

    public function down()
    {
        $this->forge->dropTable('jual');
    }
}
