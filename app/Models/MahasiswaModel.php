<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'mahasiswa_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'mahasiswa_id',
        'nama_lengkap',
        'nim',
        'program_studi',
        'kelas',
        'no_hp',
        'email',
        'nama_perusahaan',
        'divisi',
        'durasi_magang',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_pembimbing_perusahaan',
        'no_hp_pembimbing_perusahaan',
        'email_pembimbing_perusahaan'
    ];
    // Metode untuk mengambil semua mahasiswa
    public function getAllMahasiswa()
    {
        return $this->findAll(); // Mengambil semua data mahasiswa
    }
    public function getMahasiswaWithStatus()
    {
        $db = \Config\Database::connect();

        // Subquery: ambil logbook terakhir (created_at terbaru) per mahasiswa
        $latestLogbookSubquery = $db->table('logbook_bimbingan')
            ->select('mahasiswa_id, MAX(created_at) AS latest_created_at')
            ->groupBy('mahasiswa_id');

        // Join ke logbook_bimbingan untuk ambil status_validasi-nya
        $logbookJoin = $db->table('logbook_bimbingan lb')
            ->select('lb.mahasiswa_id, lb.status_validasi')
            ->join('(' . $latestLogbookSubquery->getCompiledSelect() . ') AS latest', 'lb.mahasiswa_id = latest.mahasiswa_id AND lb.created_at = latest.latest_created_at', 'inner');

        // Final join ke mahasiswa
        $builder = $db->table('mahasiswa');
        $builder->select('mahasiswa.*, logbook.status_validasi AS status');
        $builder->join('(' . $logbookJoin->getCompiledSelect() . ') AS logbook', 'logbook.mahasiswa_id = mahasiswa.mahasiswa_id', 'left');

        return $builder->get()->getResultArray();
    }

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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
}
