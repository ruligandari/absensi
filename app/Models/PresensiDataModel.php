<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiDataModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'presensi';
    protected $primaryKey       = 'id_presensi';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getLastID(){
    // get last id_supplier
    $builder = $this->db->table('presensi');
    $builder->select('id_presensi');
    $builder->orderBy('id_presensi', 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    if ($query->getNumRows() > 0) {
        $row = $query->getRow();
        return $row->id_presensi;
    } else{
        return null;
    }
    }
    public function joinTable(){
        $builder = $this->db->table('daftar_presensi');
        $builder->join('mata_kuliah','daftar_presensi.id_mk = mata_kuliah.id_mk');
        $builder->join('dosen','daftar_presensi.id_dosen = dosen.id_dosen');
        $builder->join('kelas','daftar_presensi.id_kelas = kelas.id_kelas');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getByDosen(){
        $builder = $this->db->table('daftar_presensi');
        $builder->join('mata_kuliah','daftar_presensi.id_mk = mata_kuliah.id_mk');
        $builder->join('dosen','daftar_presensi.id_dosen = dosen.id_dosen');
        $builder->join('kelas','daftar_presensi.id_kelas = kelas.id_kelas');
        $builder->where('daftar_presensi.id_dosen', session()->get('id_dosen'));
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function cariData($id){
        $builder = $this->db->table('daftar_presensi');
        $builder->join('mata_kuliah','daftar_presensi.id_mk = mata_kuliah.id_mk');
        $builder->join('dosen','daftar_presensi.id_dosen = dosen.id_dosen');
        $builder->join('kelas','daftar_presensi.id_kelas = kelas.id_kelas');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function byKelas($kelas){
        $builder = $this->db->table('presensi');
        $builder->join('mata_kuliah','presensi.id_mk = mata_kuliah.id_mk');
        $builder->join('mahasiswa','presensi.nim = mahasiswa.nim');
        $builder->join('kelas','presensi.id_kelas = kelas.id_kelas');
        $builder->join('daftar_presensi','presensi.id = daftar_presensi.id');
        $builder->where('daftar_presensi.id', $kelas);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function byDosen(){
        $builder = $this->db->table('presensi');
        $builder->join('mata_kuliah','presensi.id_mk = mata_kuliah.id_mk');
        $builder->join('mahasiswa','presensi.nim = mahasiswa.nim');
        $builder->join('kelas','presensi.id_kelas = kelas.id_kelas');
        $builder->join('daftar_presensi','presensi.id = daftar_presensi.id');
        $builder->where('daftar_presensi.id_dosen', session()->get('id_dosen'));
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function byNama($nim){
        $builder = $this->db->table('presensi');
        $builder->join('mata_kuliah','presensi.id_mk = mata_kuliah.id_mk');
        $builder->join('mahasiswa','presensi.nim = mahasiswa.nim');
        $builder->join('kelas','presensi.id_kelas = kelas.id_kelas');
        $builder->join('daftar_presensi','presensi.id = daftar_presensi.id');
        $builder->where('mahasiswa.nim', $nim);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updateStatusByIdWaktuPresensi($id, $nim)
    {
        $builder = $this->db->table('presensi');
        // $builder->join('mata_kuliah','presensi.id_mk = mata_kuliah.id_mk');
        // $builder->join('mahasiswa','presensi.nim = mahasiswa.nim');
        // $builder->join('kelas','presensi.id_kelas = kelas.id_kelas');
        // $builder->join('daftar_presensi','presensi.id = daftar_presensi.id');
        $builder->where('id', $id);
        $builder->where('nim', $nim);
        $builder->update(['status' => 'hadir']);
    }
}
