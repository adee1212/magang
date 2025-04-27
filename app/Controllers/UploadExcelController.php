<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Models\UserModel;
use App\Models\MahasiswaModel;

class UploadExcelController extends BaseController
{
    public function index()
    {
        return view('upload_excel');
    }

    public function upload()
    {
        $file = $this->request->getFile('excel_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $spreadsheet = (new Xlsx())->load($file->getTempName());
            $dataSheet = $spreadsheet->getActiveSheet()->toArray();

            $userModel = new UserModel();
            $mahasiswaModel = new MahasiswaModel();

            // Lewati baris pertama (header)
            for ($i = 1; $i < count($dataSheet); $i++) {
                $row = $dataSheet[$i];

                $nim = trim($row[1]);
                $nama = trim($row[0]);

                // Insert ke tabel users
                $userModel->insert([
                    'nim' => $nim,
                    'password' => password_hash($nim, PASSWORD_DEFAULT),
                    'role' => 'mahasiswa',
                ]);

                $userId = $userModel->getInsertID();

                // Insert ke tabel mahasiswa
                $mahasiswaModel->insert([
                    'mahasiswa_id' => $userId,
                    'nama_lengkap' => $nama,
                    'program_studi' => $row[2],
                    'kelas' => $row[3],
                    'no_hp' => $row[4],
                    'perusahaan' => $row[5],
                    'devisi' => $row[6],
                    'durasi_magang' => $row[7],
                    'mulai_magang' => date('Y-m-d', strtotime($row[8])),
                    'selesai_magang' => date('Y-m-d', strtotime($row[9])),
                    'nama_pembimbing_industri' => $row[10],
                    'no_hp_pembimbing' => $row[11],
                    'email_pembimbing' => $row[12],
                ]);
            }

            return redirect()->back()->with('message', 'Data mahasiswa berhasil diimpor.');
        }

        return redirect()->back()->with('message', 'Gagal mengupload file.');
    }
}
