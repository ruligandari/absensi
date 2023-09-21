<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StaffTabel extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_staff' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unique' => true,
                ],
                'nama_staff' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
            ]
            );
        $this->forge->addKey('id_staff', true);
        $this->forge->createTable('staff', true);
    }

    public function down()
    {
        $this->forge->dropTable('staff');
    }
}
