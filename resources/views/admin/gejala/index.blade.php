@extends('layouts.admin')
@section('title', 'Manajemen Gejala')
@section('content')

<div class="mb-6">
    <h1 class="text-headline-lg font-headline-lg text-on-surface mb-1">Gejala</h1>
    <p class="text-body-md font-body-md text-on-surface-variant">Manajemen master data gejala penyakit pada tanaman padi.</p>
</div>

<div class="bg-surface-container-lowest rounded-xl shadow border border-outline-variant/30 overflow-hidden">
    {{-- Toolbar --}}
    <div class="p-5 border-b border-outline-variant/30 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <a href="{{ route('admin.gejala.create') }}"
           class="bg-primary text-on-primary text-label-sm font-label-sm px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-surface-tint transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add</span>
            TAMBAH DATA
        </a>
        <div class="relative w-full sm:w-72">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
            <input type="text" placeholder="Cari gejala..."
                class="w-full pl-10 pr-3 py-2 border border-outline-variant rounded-lg bg-surface-bright text-body-md font-body-md focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-outline transition-colors"/>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-outline-variant/30">
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant w-20">Kode</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant">Nama Gejala</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant text-center w-24">Foto</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant text-center w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20 text-body-md font-body-md">
                @forelse($gejala as $g)
                <tr class="hover:bg-surface-container-low transition-colors group">
                    <td class="px-6 py-4 font-semibold text-primary">{{ $g->kode }}</td>
                    <td class="px-6 py-4 text-on-surface">{{ $g->nama_gejala }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($g->foto)
                            <img src="{{ asset('storage/' . $g->foto) }}"
                                 alt="{{ $g->nama_gejala }}"
                                 class="w-12 h-12 object-cover rounded-lg mx-auto border border-outline-variant"/>
                        @else
                            <span class="text-label-sm font-label-sm text-outline italic">Belum ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.gejala.edit', $g->id) }}"
                               class="p-1.5 text-secondary hover:bg-secondary-container rounded-md transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form method="POST" action="{{ route('admin.gejala.destroy', $g->id) }}"
                                onsubmit="return confirm('Hapus gejala ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-1.5 text-error hover:bg-error-container rounded-md transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] block mb-2 text-outline-variant">folder_open</span>
                        <p class="text-body-md font-body-md">Belum ada data gejala.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-outline-variant/30 bg-surface-container-low flex justify-between items-center">
        <span class="text-label-sm font-label-sm text-on-surface-variant">{{ $gejala->count() }} data</span>
    </div>
</div>

@endsection