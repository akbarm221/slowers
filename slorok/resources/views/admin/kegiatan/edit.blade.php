@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Edit Kegiatan</h1>

    <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul:</label>
            <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3" value="{{ old('judul', $kegiatan->judul) }}" required>
        </div>
        <div class="mb-4">
            <label for="isi" class="block text-gray-700 text-sm font-bold mb-2">Isi:</label>
            <textarea name="isi" id="isi" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3" required>{{ old('isi', $kegiatan->isi) }}</textarea>
        </div>
        <div class="mb-6">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Baru (Opsional)</label>
            <img src="{{ $kegiatan->gambar }}" alt="{{ $kegiatan->judul }}" class="w-48 h-32 object-cover rounded mt-2 mb-2">
            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3">
            <p class="text-gray-600 text-xs italic mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
            @error('gambar') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            <a href="{{ route('admin.kegiatan.index') }}" class="text-blue-500 hover:text-blue-800">Batal</a>
        </div>
    </form>
</div>
@endsection