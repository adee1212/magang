<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\DosenPembimbingModel;
use App\Models\Kps; // Tambahkan model KPS
use App\Models\Panitia;
use App\Models\PembimbingIndustri;

class AuthController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $nomorInduk = $this->request->getPost('nomor_induk');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByNomorInduk($nomorInduk); // Cari pengguna berdasarkan nomor induk

        if ($user && password_verify($password, $user['password'])) {
            // Set session umum
            session()->set([
                'user_id'   => $user['user_id'],
                'nama'      => $user['nama'],
                'email'     => $user['email'],
                'role'      => $user['role'],
                'logged_in' => true,
            ]);

            // Redirect sesuai role
            switch ($user['role']) {
                case 'mahasiswa':
                    return redirect()->to('/mahasiswa/dashboard');

                case 'pembimbing_dosen':
                    return redirect()->to('/dosen/dashboard');

                case 'admin':
                    return redirect()->to('/admin');

                case 'kps':
                    $kpsModel = new Kps();
                    $kpsData = $kpsModel->where('nip', $nomorInduk)->first();
                    if (is_array($kpsData)) {
                        session()->set('kps_id', $kpsData['kps_id']);
                        return redirect()->to('/kps/dashboard');
                    }
                    return redirect()->back()->with('error', 'Data KPS tidak ditemukan.');

                case 'panitia':
                    $panitiaModel = new Panitia();
                    $panitiaData = $panitiaModel->where('nip', $nomorInduk)->first();
                    if (is_array($panitiaData)) {
                        session()->set('panitia_id', $panitiaData['panitia_id']);
                        return redirect()->to('/panitia/dashboard');
                    }
                    return redirect()->back()->with('error', 'Data Panitia tidak ditemukan.');

                case 'pembimbing_industri':
                    $industriModel = new PembimbingIndustri();
                    $industriData = $industriModel->where('nip', $nomorInduk)->first();
                    if (is_array($industriData)) {
                        session()->set('pembimbing_id', $industriData['pembimbing_id']);
                        return redirect()->to('/industri/dashboard');
                    }
                    return redirect()->back()->with('error', 'Data Pembimbing Industri tidak ditemukan.');

                default:
                    return redirect()->back()->with('error', 'Role tidak dikenali.');
            }
        }

        // ⚠️ Ini penting biar gak blank kalau login gagal
        return redirect()->back()->with('error', 'Login gagal. Cek kembali Nomor Induk dan Password.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('register');
    }

    public function create()
    {
        $userModel = new UserModel();
        $mahasiswaModel = new MahasiswaModel();
        $dosenModel = new DosenPembimbingModel();
        $kpsModel = new \App\Models\Kps();
        $panitiaModel = new \App\Models\Panitia();

        $nomorInduk = $this->request->getPost('nomor_induk');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $role = $this->request->getPost('role');

        $data = [
            'nomor_induk' => $nomorInduk,
            'password' => $password,
            'nama' => $nama,
            'email' => $email,
            'role' => $role
        ];

        if ($userModel->insert($data)) {
            $userId = $userModel->insertID();

            switch ($role) {
                case 'mahasiswa':
                    $mahasiswaData = [
                        'mahasiswa_id' => $userId,
                        'nama_lengkap' => $nama,
                        'nim' => $nomorInduk,
                        'program_studi' => 'Sistem Informasi',
                        'email' => $email,
                        'kelas' => $this->request->getPost('kelas'),
                        'no_hp' => $this->request->getPost('no_hp'),
                        'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                        'divisi' => $this->request->getPost('divisi'),
                        'durasi_magang' => 0,
                        'tanggal_mulai' => null,
                        'tanggal_selesai' => null,
                        'nama_pembimbing_perusahaan' => $this->request->getPost('nama_pembimbing_perusahaan'),
                        'no_hp_pembimbing_perusahaan' => $this->request->getPost('no_hp_pembimbing_perusahaan'),
                        'email_pembimbing_perusahaan' => $this->request->getPost('email_pembimbing_perusahaan'),
                    ];
                    if (!$mahasiswaModel->insert($mahasiswaData)) {
                        log_message('error', 'Gagal insert mahasiswa: ' . json_encode($mahasiswaModel->errors()));
                    }
                    break;

                case 'dosen_pembimbing':
                    $existingDosen = $dosenModel->where('nip', $nomorInduk)->first();
                    if ($existingDosen) {
                        return redirect()->back()->with('error', 'Dosen dengan NIP ini sudah terdaftar.');
                    }
                    $dosenData = [
                        'dosen_id' => $userId,
                        'nama_lengkap' => $nama,
                        'nip' => $nomorInduk,
                        'no_telepon' => $this->request->getPost('no_telepon'),
                        'email' => $email,
                        'link_whatsapp' => 'N/A'
                    ];
                    if (!$dosenModel->insert($dosenData)) {
                        log_message('error', 'Gagal insert dosen: ' . json_encode($dosenModel->errors()));
                    }
                    break;

                case 'kps':
                    $userId = $userModel->insertID(); // ambil user_id yang barusan diinsert

                    $kpsData = [
                        'kps_id' => $userId, // ini yang Wajib, karena foreign key
                        'nip' => $nomorInduk,
                        'email' => $email,
                        'no_telepon' => $this->request->getPost('no_telepon') ?: '',
                    ];



                    if (!$kpsModel->insert($kpsData)) {
                        log_message('error', 'Gagal insert kps: ' . json_encode($kpsModel->errors()));
                        return redirect()->back()->with('error', 'register akun berhasil ' . implode(', ', $kpsModel->errors()));
                    }

                    break;


                case 'panitia':
                    $userId = $userModel->insertID(); // ambil user_id yang barusan diinsert
                    $panitiaData = [
                        'panitia_id' => $userId,
                        'nip' => $nomorInduk,
                        'email' => $email,
                        'no_telepon' => $this->request->getPost('no_telepon') ?: '',
                        // tambahkan field lain jika diperlukan sesuai allowedFields model Panitia
                    ];
                    if (!$panitiaModel->insert($panitiaData)) {
                        log_message('error', 'Gagal insert panitia: ' . json_encode($panitiaModel->errors()));
                    }
                    break;

                case 'pembimbing_industri':
                    $userId = $userModel->insertID(); // ambil user_id yang barusan diinsert

                    $pembimbingModel = new PembimbingIndustri();
                    $pembimbingData = [
                        'pembimbing_id' => $userId, // foreign key ke tabel user
                        'nip' => $nomorInduk,
                        'email' => $email,
                        'no_telepon' => $this->request->getPost('no_telepon') ?: '',
                        'nama' => $this->request->getPost('nama'),

                        // tambahkan field lain sesuai allowedFields di model
                    ];

                    if (!$pembimbingModel->insert($pembimbingData)) {
                        log_message('error', 'Gagal insert pembimbing industri: ' . json_encode($pembimbingModel->errors()));
                    }
                    break;
            }

            session()->setFlashdata('success', 'Akun berhasil dibuat. Silakan login.');
            return redirect()->to('/login');
        }

        log_message('error', 'Gagal insert user: ' . json_encode($userModel->errors()));
        return redirect()->back()->with('error', 'Gagal membuat akun. Silakan coba lagi.');
    }
}
