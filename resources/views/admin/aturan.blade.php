@extends('layouts.admin')
@section('title', 'Aturan Forward Chaining')
@section('content')

<div class="mb-6">
    <h1 class="text-headline-lg font-headline-lg text-on-surface mb-1">Aturan Forward Chaining</h1>
    <p class="text-body-md font-body-md text-on-surface-variant">
        Aturan IF-THEN yang dihasilkan otomatis dari data relasi. Untuk mengubah aturan, kelola melalui halaman
        <a href="{{ route('admin.relasi.index') }}" class="text-primary underline hover:text-secondary">Relasi</a>.
    </p>
</div>

<div class="bg-surface-container-lowest rounded-xl shadow border border-outline-variant/30 overflow-hidden">
    {{-- Info banner --}}
    <div class="px-6 py-4 border-b border-outline-variant/30 bg-primary-fixed/30 flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-[20px]">info</span>
        <span class="text-body-md font-body-md text-on-surface">
            Halaman ini bersifat <strong>read-only</strong>. Aturan dihasilkan otomatis berdasarkan data relasi.
        </span>
    </div>

    {{-- Tabel Aturan --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-outline-variant/30">
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant w-12 text-center">No</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant">Logika Aturan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse($penyakit as $i => $p)
                @if($p->relasi->count())
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="px-6 py-6 text-body-md font-body-md text-center text-on-surface-variant align-top">{{ $i + 1 }}</td>
                    <td class="px-6 py-6 align-top">
                        <div class="flex flex-col gap-3">
                            {{-- Gejala (JIKA / DAN) --}}
                            @foreach($p->relasi as $index => $relasi)
                            <div class="flex items-start gap-4">
                                <span class="text-label-sm font-label-sm px-3 py-1 rounded-full w-16 text-center flex-shrink-0
                                    {{ $index === 0
                                        ? 'bg-primary-fixed text-on-primary-fixed'
                                        : 'bg-surface-variant text-on-surface-variant' }}">
                                    {{ $index === 0 ? 'JIKA' : 'DAN' }}
                                </span>
                                <div class="bg-surface-container px-4 py-2 rounded-lg border border-outline-variant flex-1 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-on-surface-variant text-[18px]">psychiatry</span>
                                    <span class="text-on-surface text-body-md font-body-md">
                                        {{ $relasi->gejala->nama_gejala }}
                                        <span class="text-outline ml-1">({{ $relasi->gejala->kode }})</span>
                                    </span>
                                </div>
                            </div>
                            @endforeach

                            {{-- Kesimpulan (MAKA) --}}
                            <div class="flex items-start gap-4 mt-1">
                                <span class="text-label-sm font-label-sm text-on-primary bg-primary px-3 py-1 rounded-full w-16 text-center flex-shrink-0">
                                    MAKA
                                </span>
                                <div class="bg-secondary-container px-4 py-2 rounded-lg border border-secondary-fixed flex-1 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-on-secondary-container text-[18px]">coronavirus</span>
                                    <span class="text-on-secondary-container font-semibold text-body-md font-body-md">
                                        {{ $p->nama }} ({{ $p->kode }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="2" class="px-6 py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] block mb-2 text-outline-variant">rule</span>
                        <p class="text-body-md font-body-md">Belum ada aturan. Tambahkan data relasi terlebih dahulu.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-outline-variant/30 bg-surface-container-low flex justify-between items-center">
        <span class="text-label-sm font-label-sm text-on-surface-variant">{{ $penyakit->count() }} aturan</span>
        <a href="{{ route('admin.relasi.index') }}"
           class="text-label-sm font-label-sm text-primary hover:text-secondary flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-[16px]">edit</span>
            Kelola Relasi
        </a>
    </div>
</div>

@endsection