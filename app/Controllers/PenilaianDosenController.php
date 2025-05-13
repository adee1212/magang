<?php

namespace App\Controllers;

use App\Models\PenilaianDosenModel;
use App\Models\Bimbingan;
use App\Models\MahasiswaModel;

class PenilaianDosenController extends BaseController
{
    public function index()
    {
        $dosen_id = session()->get('user_id');
        $bimbinganModel = new Bimbingan();
        $mahasiswaModel = new MahasiswaModel();

        // Ambil semua mahasiswa yang dibimbing oleh dosen ini
        $bimbingan = $bimbinganModel->where('dosen_id', $dosen_id)->findAll();

        $mahasiswaList = [];

        foreach ($bimbingan as $item) {
            $mahasiswa = $mahasiswaModel->find($item['mahasiswa_id']);
            if ($mahasiswa) {
                $mahasiswaList[] = $mahasiswa;
            }
        }

        return view('penilaian/index', ['mahasiswaList' => $mahasiswaList]);
    }

    // Form penilaian untuk mahasiswa berdasarkan ID
    public function showForm($bimbingan_id)
    {
        $dosen_id = session()->get('user_id');
        $bimbinganModel = new Bimbingan();
        $mahasiswaModel = new MahasiswaModel();

        // Ambil data bimbingan berdasarkan ID
        $bimbingan = $bimbinganModel->find($bimbingan_id);

        if (!$bimbingan) {
            return redirect()->to('/penilaian-dosen')->with('error', 'Bimbingan tidak ditemukan.');
        }

        // Pastikan mahasiswa tersebut dibimbing oleh dosen yang sedang login
        if ($bimbingan['dosen_id'] != $dosen_id) {
            return redirect()->to('/penilaian-dosen')->with('error', 'Anda tidak berhak menilai mahasiswa ini.');
        }

        // Ambil data mahasiswa
        $mahasiswa = $mahasiswaModel->find($bimbingan['mahasiswa_id']);

        return view('dosen/form', ['mahasiswa' => $mahasiswa, 'bimbingan_id' => $bimbingan_id]);
    }
    private function hitungTotal()
    {
        // Ambil nilai-nilai
        $nilai1 = [
            $this->request->getPost('nilai_1_1'),
            $this->request->getPost('nilai_1_2'),
            $this->request->getPost('nilai_1_3'),
        ];

        $nilai2 = [
            $this->request->getPost('nilai_2_1'),
            $this->request->getPost('nilai_2_2'),
            $this->request->getPost('nilai_2_3'),
            $this->request->getPost('nilai_2_4'),
        ];

        $nilai3 = [
            $this->request->getPost('nilai_3_1'),
            $this->request->getPost('nilai_3_2'),
        ];

        // Hitung rata-rata masing-masing bagian
        $rata1 = $this->rataNilai($nilai1);
        $rata2 = $this->rataNilai($nilai2);
        $rata3 = $this->rataNilai($nilai3);

        // Hitung total berbobot
        $total = ($rata1 * 0.3) + ($rata2 * 0.4) + ($rata3 * 0.3);

        return round($total, 2); // dibulatkan ke 2 angka di belakang koma
    }

    private function rataNilai($nilaiArray)
    {
        $total = 0;
        $count = 0;
        foreach ($nilaiArray as $nilai) {
            if (is_numeric($nilai)) {
                $total += floatval($nilai);
                $count++;
            }
        }
        return $count > 0 ? $total / $count : 0;
    }

    // Menyimpan penilaian dosen
    public function save()
    {
        $penilaianModel = new PenilaianDosenModel();
        $data = [
            'bimbingan_id' => $this->request->getPost('bimbingan_id'),
            'nilai_1_1'    => $this->request->getPost('nilai_1_1'),
            'nilai_1_2'    => $this->request->getPost('nilai_1_2'),
            'nilai_1_3'    => $this->request->getPost('nilai_1_3'),
            'nilai_2_1'    => $this->request->getPost('nilai_2_1'),
            'nilai_2_2'    => $this->request->getPost('nilai_2_2'),
            'nilai_2_3'    => $this->request->getPost('nilai_2_3'),
            'nilai_2_4'    => $this->request->getPost('nilai_2_4'),
            'nilai_3_1'    => $this->request->getPost('nilai_3_1'),
            'nilai_3_2'    => $this->request->getPost('nilai_3_2'),
            'total_nilai'  => $this->hitungTotal(), // kalau kamu ada fungsi hitung nilai total
        ];

        $penilaianModel->insert($data);

        // ⬇️ Ini bagian pentingnya
        return redirect()->to(site_url('dosen/bimbingan_logbook'))->with('success', 'Penilaian berhasil disimpan.');
    }
}
