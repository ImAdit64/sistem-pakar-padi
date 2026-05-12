@extends('layouts.admin')
@section('title', 'Riwayat Diagnosa')
@section('content')

<div class="mb-6">
    <h1 class="text-headline-lg font-headline-lg text-on-surface mb-1">Riwayat Diagnosa</h1>
    <p class="text-body-md font-body-md text-on-surface-variant">Daftar semua sesi diagnosa yang dilakukan oleh pengguna.</p>
</div>

<div class="bg-surface-container-lowest rounded-xl shadow border border-outline-variant/30 overflow-hidden">
    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-outline-variant/30">
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant">Kode Sesi</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant">Nama Pengguna</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant">Tanggal</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant">Hasil Teratas</th>
                    <th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant text-center w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20 text-body-md font-body-md">
                @forelse($sesi as $s)
                <tr class="hover:bg-surface-container-low transition-colors group">
                    <td class="px-6 py-4 font-mono text-xs text-on-surface-variant">{{ $s->kode_sesi }}</td>
                    <td class="px-6 py-4 font-medium text-on-surface">{{ $s->nama_pengguna }}</td>
                    <td class="px-6 py-4 text-on-surface-variant">
                        {{ \Carbon\Carbon::parse($s->tanggal)->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($s->hasilDiagnosa->first())
                        <div class="flex items-center gap-2">
                            <span class="text-on-surface font-medium">{{ $s->hasilDiagnosa->first()->penyakit->nama }}</span>
                            <span class="bg-secondary-container text-on-secondary-container text-label-sm font-label-sm px-2 py-0.5 rounded-full">
                                {{ $s->hasilDiagnosa->first()->persentase }}%
                            </span>
                        </div>
                        @else
                        <span class="text-outline italic text-sm">Tidak terdeteksi</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.laporan.cetak', $s->id) }}" target="_blank"
                               class="p-1.5 text-secondary hover:bg-secondary-container rounded-md transition-colors" title="Cetak">
                                <span class="material-symbols-outlined text-[20px]">print</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] block mb-2 text-outline-variant">history</span>
                        <p class="text-body-md font-body-md">Belum ada riwayat diagnosa.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-outline-variant/30 bg-surface-container-low flex justify-between items-center">
        <span class="text-label-sm font-label-sm text-on-surface-variant">{{ $sesi->count() }} sesi diagnosa</span>
    </div>
</div>

@endsection