<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\UserModel;
use App\Models\MahasiswaModel; // Memanggil model mahasiswa
use App\Models\DosenPembimbingModel; // Memanggil model dosen

class UploadUserController extends BaseController
{
    public function index()
    {
        return view('upload_user_excel');
    }

    public function upload()
    {
        $file = $this->request->getFile('excel_file');

        if (!$file->isValid()) {
            return redirect()->back()->with('message', 'File tidak valid.');
        }

        $spreadsheet = IOFactory::load($file->getTempName());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $userModel = new UserModel();
        $mahasiswaModel = new MahasiswaModel(); // Instance model mahasiswa
        $dosenModel = new DosenPembimbingModel(); // Instance model dosen

        $errors = [];
        $successCount = 0;

        foreach ($sheetData as $index => $row) {
            if ($index === 0) continue; // skip header

            [$nama, $email, $password, $role, $nomor_induk] = $row; // Pastikan kolom sesuai dengan struktur Excel

            if (!$nama || !$nomor_induk || !$password || !$role || !$email) {
                $errors[] = "Baris " . ($index + 1) . " tidak lengkap.";
                continue;
            }

            // Cek apakah email sudah ada
            if ($userModel->where('email', $email)->first()) {
                $errors[] = "Baris " . ($index + 1) . ": Email $email sudah terdaftar.";
                continue;
            }

            // Simpan user
            $userModel->insert([
                'nama'        => $nama,
                'email'       => $email,
                'password'    => password_hash($password, PASSWORD_DEFAULT),
                'role'        => strtolower($role),
                'nomor_induk' => $nomor_induk
            ]);

            // Mendapatkan user_id dari insert terakhir
            $userId = $userModel->insertID();

            // Menyimpan data ke tabel mahasiswa jika role adalah 'mahasiswa'
            if (strtolower($role) === 'mahasiswa') {
                $mahasiswaModel->insert([
                    'mahasiswa_id' => $userId, // Store user_id as foreign key
                    'nim'          => $nomor_induk, // Simpan NIM
                    'nama_lengkap' => $nama,
                    'email'        => $email,
                    'program_studi' => 'Sistem Informasi', // Contoh default
                    'kelas'        => 'A', // Contoh default
                    'no_hp'        => 'N/A', // Default value
                    // Tambahkan field lain sesuai alur data mahasiswa
                ]);
            }

            // Menyimpan data ke tabel dosen pembimbing jika role adalah 'dosen_pembimbing'
            if (strtolower($role) === 'dosen_pembimbing') {
                $dosenModel->insert([
                    'dosen_id'      => $userId, // Store user_id as foreign key
                    'nama_lengkap'  => $nama,
                    'nip'           => $nomor_induk, // Simpan NIP
                    'no_telepon'    => $this->request->getPost('no_telepon'), // Pastikan ini diambil dari input
                    'email'         => $email,
                    'link_whatsapp' => 'N/A' // Default value
                ]);
            }

            $successCount++;
        }

        $message = "$successCount akun berhasil diimport.";
        if (!empty($errors)) {
            $message .= "<br>Beberapa baris gagal:<br>" . implode("<br>", $errors);
        }
        return redirect()->back()->with('message', $message);
    }
}
