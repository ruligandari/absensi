<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data =
            [
                'title' => 'Dashboard'
            ];
        return view('Dosen/dashboard/index', $data);
    }
}
