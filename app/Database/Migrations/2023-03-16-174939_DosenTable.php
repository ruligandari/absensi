<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DosenTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'nama' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50
                ],
                'nip' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50
                ],
            ]
            );
            $this->forge->addKey('id', true);
            $this->forge->createTable('dosen', true);
    }

    public function down()
    {
        $this->forge->dropTable('dosen');
    }
}
