<?php

namespace App\Controllers;

use App\Models\Bimbingan;
use App\Models\LogbookBimbingan;
use App\Models\DosenPembimbingModel;
use App\Models\MahasiswaModel;

class BimbinganController extends BaseController
{
    public function index()
    {
        $dosenId = session()->get('user_id');
        $bimbinganModel = new Bimbingan();
        $mahasiswaModel = new MahasiswaModel();

        // Ambil semua mahasiswa yang dibimbing oleh dosen ini
        $bimbingan = $bimbinganModel->where('dosen_id', $dosenId)->findAll();

        $mahasiswaList = [];

        foreach ($bimbingan as $item) {
            $mahasiswa = $mahasiswaModel->find($item['mahasiswa_id']);
            if ($mahasiswa) {
                $mahasiswaList[] = $mahasiswa;
            }
        }

        return view('dosen/list_mahasiswa_bimbingan', ['mahasiswaList' => $mahasiswaList]);
    }

    public function detail($mahasiswaId)
    {
        $logbookModel = new LogbookBimbingan();
        $mahasiswaModel = new MahasiswaModel();
        $bimbinganModel = new Bimbingan();

        $mahasiswa = $mahasiswaModel->find($mahasiswaId);
        $logbooks = $logbookModel->where('mahasiswa_id', $mahasiswaId)->findAll();

        $disetujuiCount = $logbookModel->where('mahasiswa_id', $mahasiswaId)
            ->where('status_validasi', 'disetujui')
            ->countAllResults();
        $totalCount = $logbookModel->where('mahasiswa_id', $mahasiswaId)->countAllResults();

        // Ambil bimbingan_id berdasarkan mahasiswa dan dosen yang login
        $dosenId = session()->get('user_id');
        $bimbingan = $bimbinganModel->where([
            'mahasiswa_id' => $mahasiswaId,
            'dosen_id' => $dosenId
        ])->first();

        $bimbingan_id = $bimbingan['bimbingan_id'] ?? null;


        return view('dosen/bimbingan_logbook', [
            'mahasiswa' => $mahasiswa,
            'logbooks' => $logbooks,
            'disetujuiCount' => $disetujuiCount,
            'totalCount' => $totalCount,
            'bimbingan_id' => $bimbingan_id // ✅ Kirim ke view
        ]);
    }



    // Menentukan relasi bimbingan mahasiswa-dosen
    public function tentukanBimbingan()
    {
        $bimbinganModel = new Bimbingan();

        $mahasiswaId = $this->request->getPost('mahasiswa_id');
        $dosenId = $this->request->getPost('dosen_id');

        // Cek apakah relasi sudah ada
        $existing = $bimbinganModel->where([
            'mahasiswa_id' => $mahasiswaId,
            'dosen_id' => $dosenId
        ])->first();

        if (!$existing) {
            $bimbinganModel->insert([
                'mahasiswa_id' => $mahasiswaId,
                'dosen_id' => $dosenId
            ]);
            return redirect()->back()->with('success', 'Bimbingan berhasil ditentukan.');
        }

        return redirect()->back()->with('error', 'Bimbingan sudah ada.');
    }
    public function setujui($logbookId)
    {
        $logbookModel = new LogbookBimbingan();

        // Tambahkan pengecekan data
        $logbook = $logbookModel->find($logbookId);
        if (!$logbook) {
            return redirect()->back()->with('error', 'Logbook tidak ditemukan.');
        }

        $logbookModel->update($logbookId, ['status_validasi' => 'disetujui']);
        return redirect()->back()->with('success', 'Logbook disetujui.');
    }

    public function tolak($logbookId)
    {
        $logbookModel = new LogbookBimbingan();

        $logbook = $logbookModel->find($logbookId);
        if (!$logbook) {
            return redirect()->back()->with('error', 'Logbook tidak ditemukan.');
        }

        $logbookModel->update($logbookId, ['status_validasi' => 'ditolak']);
        return redirect()->back()->with('success', 'Logbook ditolak.');
    }
}
