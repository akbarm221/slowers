<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data sementara untuk pengujian
        $dummyData = [
            'site' => ['title' => 'Desa Slorok'],
            'infoCards' => [ // Menambahkan data dummy agar tidak kosong
                ['icon' => 'fas fa-users', 'number' => '2,500', 'label' => 'Jumlah Penduduk'],
                ['icon' => 'fas fa-home', 'number' => '650', 'label' => 'Kepala Keluarga'],
                ['icon' => 'fas fa-map', 'number' => '6,26 km²', 'label' => 'Luas Wilayah'],
                ['icon' => 'fas fa-seedling', 'number' => '3', 'label' => 'Dusun'],
            ],
            'contact' => [ // PASTIKAN BAGIAN INI LENGKAP
                'address' => 'Alamat desa akan ditampilkan di sini...',
                'phone' => '(000) 1234-5678',
                'email' => 'info@slorok.desa.id',
                'workingHours' => [
                    'weekdays' => 'Senin - Jumat: 08:00 - 16:00',
                    'saturday' => 'Sabtu: 08:00 - 12:00',
                    'sunday' => 'Minggu: Tutup',
                ],
                'socialMedia' => []
            ],
            'news' => []
        ];

        return view('pages.home', $dummyData);
    }
}