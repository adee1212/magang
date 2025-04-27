<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\LogbookBimbingan;

class AdminLogbookController extends BaseController
{
    // Monitoring semua mahasiswa
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->getMahasiswaWithStatus(); // method ini yang kita buat tadi
        return view('/logbook_mahasiswa', $data);
    }
    
    // Detail logbook mahasiswa
    public function detail($id)
    {
        $logbookModel = new LogbookBimbingan();
        $data['logbook'] = $logbookModel->where('mahasiswa_id', $id)->findAll();
        return view('/detail_logbook', $data);
    }
    
}
