<?php

namespace App\Controllers;

use App\Models\DosenPembimbingModel; // Memanggil model dosen pembimbing

class DosenPembimbingController extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenPembimbingModel(); // Membuat instance dari model
        $userId = session()->get('user_id'); // Mengambil user_id dari session

        // Mencari dosen berdasarkan user_id
        $dosen = $dosenModel->where('dosen_id', $userId)->first();

        // Memastikan data dosen ditemukan
        if (!$dosen) {
            return redirect()->to('/login')->with('error', 'Data dosen tidak ditemukan.'); // Redirect jika tidak ditemukan
        }

        // Mengembalikan view dashboard dengan data dosen
        return view('dosen/dashboard', ['dosen' => $dosen]);
    }
}
