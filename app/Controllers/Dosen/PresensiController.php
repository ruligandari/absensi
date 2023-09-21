<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\PresensiDataModel;

class PresensiController extends BaseController
{
    public function index()
    {
        $presensiModel = new PresensiDataModel();
        $data = [
            'title' => 'Data Presensi',
            'presensi' => $presensiModel->byDosen()
        ];
        return view('Dosen/presensi/index', $data);
    }
}
