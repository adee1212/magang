<?php

namespace App\Controllers;

use App\Models\LogbookBimbingan; // Pastikan untuk menggunakan model logbook

class LogbookController extends BaseController
{
    // Menampilkan logbook
    public function index()
    {
        $logbookModel = new LogbookBimbingan();
        $mahasiswaId = session()->get('user_id'); // Mengambil user_id mahasiswa dari session

        // Mengambil logbook mahasiswa dari database
        $logbook = $logbookModel->where('mahasiswa_id', $mahasiswaId)->findAll();

        // Mengembalikan view logbook dengan data
        return view('mahasiswa/LogbookBimbingan', ['logbook' => $logbook]);
    }

    // Method untuk menambah logbook baru
    public function create()
    {
        $logbookModel = new LogbookBimbingan();
        $mahasiswaId = session()->get('user_id'); // Mengambil user_id mahasiswa dari session

        // Mengambil data dari form
        $data = [
            'mahasiswa_id' => $mahasiswaId, // Setting mahasiswa_id
            'tanggal'      => $this->request->getPost('tanggal'),
            'aktivitas'    => $this->request->getPost('aktivitas'),
            'catatan_dosen' => $this->request->getPost('catatan_dosen'),
        ];

        // Menyimpan logbook
        if ($logbookModel->insert($data)) {
            return redirect()->to('/mahasiswa/logbook')->with('success', 'Logbook berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan logbook.');
        }
    }
}
