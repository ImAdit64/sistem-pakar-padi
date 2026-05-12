@extends('layouts.admin')
@section('title', 'Edit Relasi')
@section('content')

<div class="max-w-2xl bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Edit Relasi</h2>
    <form method="POST" action="{{ route('admin.relasi.update', $relasi->id) }}">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Penyakit</label>
            <select name="penyakit_id" class="w-full border rounded px-3 py-2" required>
                @foreach($penyakit as $p)
                    <option value="{{ $p->id }}" {{ $relasi->penyakit_id == $p->id ? 'selected' : '' }}>
                        {{ $p->kode }} — {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Gejala</label>
            <select name="gejala_id" class="w-full border rounded px-3 py-2" required>
                @foreach($gejala as $g)
                    <option value="{{ $g->id }}" {{ $relasi->gejala_id == $g->id ? 'selected' : '' }}>
                        {{ $g->kode }} — {{ $g->nama_gejala }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">MB (Measure of Belief)</label>
            <input type="number" name="mb" step="0.01" min="0" max="1"
                value="{{ $relasi->mb }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">MD (Measure of Disbelief)</label>
            <input type="number" name="md" step="0.01" min="0" max="1"
                value="{{ $relasi->md }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update</button>
            <a href="{{ route('admin.relasi.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Batal</a>
        </div>
    </form>
</div>

@endsection