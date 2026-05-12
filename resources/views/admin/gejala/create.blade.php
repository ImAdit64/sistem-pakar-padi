@extends('layouts.admin')
@section('title', 'Tambah Gejala')
@section('content')

<div class="max-w-2xl bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Tambah Gejala Baru</h2>
    <form method="POST" action="{{ route('admin.gejala.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kode</label>
            <input type="text" name="kode" class="w-full border rounded px-3 py-2" placeholder="G23" required>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Nama Gejala</label>
            <input type="text" name="nama_gejala" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
            <a href="{{ route('admin.gejala.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Batal</a>
        </div>
    </form>
</div>

@endsection