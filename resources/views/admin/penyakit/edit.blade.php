@extends('layouts.admin')
@section('title', 'Edit Penyakit')
@section('content')

<div class="max-w-2xl bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Edit Penyakit</h2>
    <form method="POST" action="{{ route('admin.penyakit.update', $penyakit->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kode</label>
            <input type="text" name="kode" value="{{ $penyakit->kode }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Penyakit</label>
            <input type="text" name="nama" value="{{ $penyakit->nama }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2">{{ $penyakit->deskripsi }}</textarea>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Gambar Baru (opsional)</label>
            <input type="file" name="gambar" class="w-full border rounded px-3 py-2" accept="image/*">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update</button>
            <a href="{{ route('admin.penyakit.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Batal</a>
        </div>
    </form>
</div>

@endsection