<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dosen';
    protected $primaryKey       = 'id_dosen';
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
    $builder = $this->db->table('dosen');
    $builder->select('id_dosen');
    $builder->orderBy('id_dosen', 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    if ($query->getNumRows() > 0) {
        $row = $query->getRow();
        return $row->id_dosen;
    } else{
        return null;
    }
    }
}
