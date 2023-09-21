<?php

namespace App\Controllers;
use App\Models\MahasiswaModel;
class Home extends BaseController
{
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        $getAllData = $mahasiswaModel->findAll();
        $data = [
            'title' => 'Presensi Mahasiswa',
            'mahasiswa' => $getAllData
        ];


        return view('presensi', $data);
    }

    public function getModel()
    {
        $mahasiswaModel = new MahasiswaModel();
$mahasiswaModel->select('nama, data_wajah, nim');
$getData = $mahasiswaModel->findAll();

$formattedData = [
    'labels' => [],
    'descriptors' => []
];
foreach ($getData as $data) {
    $descriptorsArray = explode(',', $data['data_wajah']);
    $descriptorsFloat32 = array_map('floatval', $descriptorsArray);
    $label = $data['nim'].' - '.$data['nama'];
    $formattedData['labels'][] = $label;

    // Cek jika deskripsi tidak kosong (tidak sama dengan 0)
    if ($descriptorsFloat32 !== 0) {
        $formattedData['descriptors'][] = $descriptorsFloat32;
    }
}

return $this->response->setJSON($formattedData);


    }
}
