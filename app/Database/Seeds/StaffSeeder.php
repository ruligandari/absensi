<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id_staff' => '1',
            'nama_staff' => 'Staff TU 1',
            'email' => 'stafftu1@gmail.com',
            'password' => password_hash('stafftu1', PASSWORD_DEFAULT),
        ];

        $this->db->table('staff')->insert($data);
    }
}
