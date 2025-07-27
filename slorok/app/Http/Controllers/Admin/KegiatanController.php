<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    // Method index, create, dan edit tidak perlu diubah.
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // --- GANTI METHOD INI ---
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $publicUrl = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = 'kegiatan/' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])->withBody(
                    file_get_contents($file->getRealPath()),
                    $file->getMimeType()
                )->post(config('services.supabase.url') . '/storage/v1/object/' . config('services.supabase.bucket') . '/' . $fileName);

            if ($response->successful()) {
                $publicUrl = config('services.supabase.url') . '/storage/v1/object/public/' . config('services.supabase.bucket') . '/' . $fileName;
            } else {
                return back()->withInput()->withErrors(['gambar' => 'Gagal mengunggah gambar.']);
            }
        }

        // --- BAGIAN YANG DIUBAH ADA DI SINI ---
        try {
            Kegiatan::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'gambar' => $publicUrl,
            ]);
        } catch (\Exception $e) {
            // Hentikan eksekusi dan tampilkan pesan error yang sebenarnya
            dd($e->getMessage());
        }
        // ------------------------------------

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }
    // --- GANTI METHOD INI JUGA ---
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $publicUrl = $kegiatan->gambar;

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar) {
                $oldFilePath = str_replace(config('services.supabase.url') . '/storage/v1/object/public/' . config('services.supabase.bucket') . '/', '', $kegiatan->gambar);
                Http::withHeaders(['Authorization' => 'Bearer ' . config('services.supabase.key')])
                    ->delete(config('services.supabase.url') . '/storage/v1/object/' . config('services.supabase.bucket') . '/' . $oldFilePath);
            }

            $file = $request->file('gambar');
            $fileName = 'kegiatan/' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // KODE YANG DIPERBAIKI: Gunakan withBody() juga di sini
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])->withBody(
                    file_get_contents($file->getRealPath()),
                    $file->getMimeType()
                )->post(config('services.supabase.url') . '/storage/v1/object/' . config('services.supabase.bucket') . '/' . $fileName);

            if ($response->successful()) {
                $publicUrl = config('services.supabase.url') . '/storage/v1/object/public/' . config('services.supabase.bucket') . '/' . $fileName;
            } else {
                return back()->withInput()->withErrors(['gambar' => 'Gagal mengunggah gambar baru.']);
            }
        }

        $kegiatan->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $publicUrl,
        ]);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // Method destroy sudah benar, tidak perlu diubah.
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar) {
            $filePath = str_replace(config('services.supabase.url') . '/storage/v1/object/public/' . config('services.supabase.bucket') . '/', '', $kegiatan->gambar);
            Http::withHeaders(['Authorization' => 'Bearer ' . config('services.supabase.key')])
                ->delete(config('services.supabase.url') . '/storage/v1/object/' . config('services.supabase.bucket') . '/' . $filePath);
        }

        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}