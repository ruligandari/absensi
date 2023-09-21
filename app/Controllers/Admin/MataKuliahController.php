<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\KontrakModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use App\Models\DosenModel;

class MataKuliahController extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenModel();
        $mkModel = new MataKuliahModel();
        $data = [
            'title' => 'Data Mata Kuliah',
            'mk' => $mkModel->innerTable()
        ];

        return view('Admin/matakuliah/index', $data);
    }
    public function form_edit($id){
        $mkModel = new MataKuliahModel();
        $id = $mkModel->join('dosen','mata_kuliah.id_dosen = dosen.id_dosen')->find($id);
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Update Data Mata Kuliah',
            'mk' => $id,
            'dosen' => $dosenModel->findAll()
        ];
        return view('Admin/matakuliah/update', $data);
    }
    public function update($id){
        $mkModel = new MataKuliahModel();
        $data = [
            'id_mk' => $this->request->getVar('id_mk'),
            'nama_mk' => $this->request->getVar('nama_mk'),
            'id_dosen' => $this->request->getVar('id_dosen')
        ];
        $mkModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/data-matakuliah'));
    }
    public function kontrak($id){
        $mkModel = new MataKuliahModel();
        $mahasiswa = new MahasiswaModel();
        $kelas = new KelasModel();
        $data = [
            'title' => 'Kontrak Mata Kuliah',
            'matakuliah' => $mkModel->getbyId($id),
            'mahasiswa' => $mahasiswa->join('kelas','mahasiswa.id_kelas = kelas.id_kelas')->findAll(),
            'kelas' => $kelas->findAll(),
        ];
        return view('Admin/matakuliah/kontrak', $data);
    }
    public function create(){

        $dosenMK = new DosenModel();
        $dosen = $dosenMK->findAll();
        $mkModel = new MataKuliahModel();
        $mk = $mkModel->getLastID();
        if($mk == null){
            $incrementIdMK = 1;
        }else{
            $slicedMK = substr($mk, 3);
            $incrementIdMK = $slicedMK + 1;
        }
        $data = [
            'title' => 'create',
            'dosen' => $dosen,
            'id_mk' => 'MK'. sprintf('%04s', $incrementIdMK),
        ];
        return view('Admin/matakuliah/create',$data);
    }
    public function filter()
    {
        $request = $this->request->getVar();
        $kontrakModel = new KontrakModel();
        $mahasiswaModel = new MahasiswaModel();
    
        if ($request['id_kelas'] === '#') {
            $mahasiswa = $mahasiswaModel->join('kelas', 'mahasiswa.id_kelas = kelas.id_kelas')->findAll();
        } else {
            $mahasiswa = $mahasiswaModel->byKelas($request['id_kelas']);
        }
        $response = [
            'mahasiswa' => $mahasiswa
        ];
        return $this->response->setJSON($response);
    }
    public function delete($id){
        $mkModel = new MataKuliahModel();
        $mkModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/data-matakuliah'));
    }
    public function save(){

        $mkModel = new MataKuliahModel();

        $id_mk = $this->request->getPost('id_mk');
        $nama_mk = $this->request->getPost('nama_mk');
        $id_dosen = $this->request->getPost('id_dosen');

        $data = [
            'id_mk' => $id_mk,
            'nama_mk' => $nama_mk,
            'id_dosen' => $id_dosen,
        ];
        
        $mkModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/data-matakuliah'));
    }
    public function check(){
        $kontrakModel = new KontrakModel();
        $nim = $this->request->getPost('nim');
        $id_mk = $this->request->getPost('id_mk');
    
        $exist = $kontrakModel->checkKontrakExists($nim, $id_mk);
        return $this->response->setJSON(['exists' => $exist]);
    }
    public function save_kontrak()
{
    $selectedNim = $this->request->getPost('selectedNim');
    $id_mk = $this->request->getPost('id_mk');

    $kontrakModel = new KontrakModel();
    $data = [];

    for ($i = 0; $i < count($selectedNim); $i++) {
        $nim = $selectedNim[$i];

        // Cek keberadaan data dengan nim dan id_mk
        if (!$kontrakModel->checkKontrakExists($nim, $id_mk)) {
            $data[] = [
                'id_mk' => $id_mk,
                'nim' => $nim,
            ];
        }
    }

    // Jika terdapat data yang akan disimpan
    if (!empty($data)) {
        $kontrakModel->insertBatch($data);
        $response = [
            'status' => 'success'
        ];
    } else {
        $response = [
            'status' => 'exists'
        ];
    }

    return $this->response->setJSON($response);
}
}