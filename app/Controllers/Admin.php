<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Admin extends BaseController
{
    public function createUser($role)
    {
        $userModel = new \App\Models\UserModel();
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nomorinduk' => $this->request->getPost('nomorinduk'),
            'password' => $this->request->getPost('password'),
            'role' => $role
        ];
    
        $userModel->insert($data);
        return $this->response->setJSON(['success' => true, 'message' => "Akun $role berhasil dibuat"]);
    }
    public function formTambahAkun()
    {
        return view('html/tambah-akun'); // tanpa .html
    }

   

public function importAkun()
{
    $file = $this->request->getFile('file');
    if ($file && $file->isValid()) {
        $spreadsheet = IOFactory::load($file->getTempName());
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        $userModel = new \App\Models\UserModel();
        $inserted = 0;

        foreach ($sheet as $index => $row) {
            if ($index === 0) continue; // skip header

            $userData = [
                'nama' => $row[0],
                'nomor_induk' => $row[1],
                'password' => $row[2],
                'role' => $row[3],
            ];

            $userModel->insert($userData);
            $inserted++;
        }

        return $this->response->setJSON(['message' => "$inserted akun berhasil diimport."]);
    }

    return $this->response->setStatusCode(400)->setJSON(['message' => 'File tidak valid']);
}

    
}
