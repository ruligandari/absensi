<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PresensiTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 11
            ],
            'nip'=> [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'jam_masuk' => [
                'type' => 'DATETIME',
                
            ],
            'jam_keluar' => [
                'type' => 'DATETIME',
                
            ],
            'tanggal' => [
                'type' => 'DATE',
                
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('daftar_presensi', true);
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('nip', 'dosen', 'nip', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('presensi');
    }
}
