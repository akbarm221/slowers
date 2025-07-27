<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// Tidak perlu 'use' statement untuk Firestore atau package lain di sini

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman daftar berita.
     * Datanya akan diambil dan ditampilkan oleh JavaScript.
     */
    public function index()
    {
        return view('admin.berita.index');
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menampilkan form untuk mengedit berita.
     * Kita hanya mengirimkan ID berita ke view agar JavaScript bisa mengambil datanya.
     */
    public function edit($id)
    {
        return view('admin.berita.edit', ['beritaId' => $id]);
    }
}