<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $data =  [
            [

                'nama' => 'Dosen 1',
                'nip' => '12345678',
                'email' => 'dosen1@gmail.com',
                'password' => password_hash('DosenPembimbing', PASSWORD_DEFAULT),
            ],
            [

                'nama' => 'Dosen 2',
                'nip' => '1234567',
                'email' => 'dosen2@gmail.com',
                'password' => password_hash('DosenPembimbing', PASSWORD_DEFAULT),
            ],
            
        ];

        $this->db->table('dosen')->insertBatch($data);
    }
}
