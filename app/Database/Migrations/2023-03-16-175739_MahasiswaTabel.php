<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MahasiswaTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 11
            ],
            'nama'=> [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 1
            ],
            'ttl' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            ]
        );

        $this->forge->addKey('nim', true);
        $this->forge->createTable('mahasiswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
