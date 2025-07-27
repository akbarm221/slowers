@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Tambah Kegiatan Baru</h1>

    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul:</label>
            <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('judul') }}" required>
            @error('judul') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label for="isi" class="block text-gray-700 text-sm font-bold mb-2">Isi:</label>
            <textarea name="isi" id="isi" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('isi') }}</textarea>
            @error('isi') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3" required>
            @error('gambar') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Simpan</button>
            <a href="{{ route('admin.kegiatan.index') }}" class="text-blue-500 hover:text-blue-800">Batal</a>
        </div>
    </form>
</div>
@endsection