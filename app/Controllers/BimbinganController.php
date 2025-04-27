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

        $mahasiswa = $mahasiswaModel->find($mahasiswaId);
        $logbooks = $logbookModel->where('mahasiswa_id', $mahasiswaId)->findAll();

        return view('dosen/bimbingan_logbook', [
            'mahasiswa' => $mahasiswa,
            'logbooks' => $logbooks
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
        $logbookModel->update($logbookId, ['status' => 'disetujui']);
        return redirect()->back()->with('success', 'Logbook disetujui.');
    }

    public function tolak($logbookId)
    {
        $logbookModel = new LogbookBimbingan();
        $logbookModel->update($logbookId, ['status' => 'ditolak']);
        return redirect()->back()->with('success', 'Logbook ditolak.');
    }

    public function hapus($logbookId)
    {
        $logbookModel = new LogbookBimbingan();
        $logbookModel->delete($logbookId);
        return redirect()->back()->with('success', 'Logbook dihapus.');
    }
}
