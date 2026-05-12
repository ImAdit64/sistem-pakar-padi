@extends('layouts.app')
@section('title', 'Hasil Diagnosa — AgriScan Rice')
@section('content')

<main class="flex-grow w-full max-w-[1280px] mx-auto px-4 md:px-10 py-8 md:py-12">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-headline-lg font-headline-lg text-primary mb-2">Hasil Diagnosa</h1>
            <p class="text-body-md font-body-md text-on-surface-variant">
                Kode Sesi: <strong>{{ $sesi->kode_sesi }}</strong> |
                {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d/m/Y H:i') }}
            </p>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <a href="{{ route('diagnosa.cetak', $sesi->kode_sesi) }}" target="_blank"
               class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-3 border border-secondary text-primary rounded-lg text-label-sm font-label-sm hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined">print</span>
                Cetak Hasil
            </a>
            <a href="{{ route('diagnosa') }}"
               class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-lg text-label-sm font-label-sm hover:bg-secondary transition-colors">
                <span class="material-symbols-outlined">check</span>
                Diagnosa Lagi
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Kiri: Diagnosis Utama & Kemungkinan Lain --}}
        <div class="lg:col-span-5 flex flex-col gap-6">
            {{-- Gambar Penyakit Teratas --}}
            @if($sesi->hasilDiagnosa->first())
            <div class="bg-surface-container-lowest rounded-xl p-4 shadow border border-surface-container flex flex-col">
                <div class="relative w-full aspect-square rounded-lg overflow-hidden bg-surface-container mb-4">
                    @if($sesi->hasilDiagnosa->first()->penyakit->gambar)
                        <img src="{{ asset('storage/' . $sesi->hasilDiagnosa->first()->penyakit->gambar) }}"
                             alt="{{ $sesi->hasilDiagnosa->first()->penyakit->nama }}"
                             class="w-full h-full object-cover"/>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-[64px] text-on-surface-variant opacity-20">eco</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 border-2 border-dashed border-secondary/30 m-4 rounded-lg pointer-events-none"></div>
                </div>
                <div class="flex items-center justify-between px-2">
                    <span class="text-label-sm font-label-sm text-outline">Penyakit Terdeteksi</span>
                    <div class="flex items-center gap-1 text-secondary">
                        <span class="material-symbols-outlined icon-filled text-[18px]">verified</span>
                        <span class="text-label-sm font-label-sm">Akurasi Tertinggi</span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Kemungkinan Lainnya --}}
            @if($sesi->hasilDiagnosa->count() > 1)
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow border border-surface-container">
                <h3 class="text-body-lg font-body-lg text-primary mb-4 pb-2 border-b border-surface-container-high">Kemungkinan Lainnya</h3>
                <div class="flex flex-col gap-4">
                    @foreach($sesi->hasilDiagnosa->skip(1) as $lain)
                    <div class="flex justify-between items-center">
                        <span class="text-body-md font-body-md text-on-surface-variant">{{ $lain->penyakit->nama }}</span>
                        <span class="text-label-sm font-label-sm bg-surface-container px-3 py-1 rounded-full text-on-surface">{{ $lain->persentase }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Gejala yang Dipilih --}}
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow border border-surface-container">
                <h3 class="text-body-lg font-body-lg text-primary mb-4 pb-2 border-b border-surface-container-high">Gejala yang Dilaporkan</h3>
                <ul class="space-y-2">
                    @foreach($sesi->detailGejala as $detail)
                    <li class="flex items-center gap-2 text-body-md font-body-md text-on-surface-variant">
                        <span class="material-symbols-outlined text-secondary text-[18px]">check_circle</span>
                        {{ $detail->gejala->nama_gejala }}
                        <span class="ml-auto text-label-sm font-label-sm bg-secondary-container text-on-secondary-container px-2 py-0.5 rounded-full">{{ $detail->bobot_keyakinan }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Kanan: Detail Diagnosis --}}
        <div class="lg:col-span-7 flex flex-col gap-6">
            @if($sesi->hasilDiagnosa->first())
            @php $utama = $sesi->hasilDiagnosa->first(); @endphp

            {{-- Diagnosis Utama --}}
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow border border-secondary/30">
                <div class="inline-flex items-center gap-2 bg-primary-container/20 text-primary px-4 py-1.5 rounded-full mb-6">
                    <span class="material-symbols-outlined text-[18px]">warning</span>
                    <span class="text-label-sm font-label-sm">Terdeteksi</span>
                </div>
                <h2 class="text-display-lg font-display-lg text-primary leading-tight mb-2">{{ $utama->penyakit->nama }}</h2>
                <div class="flex items-baseline gap-2 mb-6">
                    <span class="text-display-lg font-display-lg text-secondary">{{ $utama->persentase }}%</span>
                    <span class="text-body-md font-body-md text-outline">Tingkat Kecocokan</span>
                </div>
                {{-- Progress bar --}}
                <div class="w-full bg-outline-variant/30 rounded-full h-2 mb-6">
                    <div class="bg-secondary h-2 rounded-full transition-all duration-700"
                         style="width: {{ $utama->persentase }}%"></div>
                </div>
                <p class="text-body-md font-body-md text-on-surface-variant leading-relaxed">
                    {{ $utama->penyakit->deskripsi }}
                </p>
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-full
                    {{ $utama->persentase >= 80 ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container text-on-surface' }}">
                    <span class="material-symbols-outlined text-[16px]">info</span>
                    <span class="text-label-sm font-label-sm">{{ $utama->interpretasi }}</span>
                </div>
            </div>

            {{-- Penanganan --}}
            @if($utama->penyakit->penanganan->count())
            <div class="bg-primary-container/5 rounded-xl p-8 border border-primary-container/20">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-secondary">vaccines</span>
                    <h3 class="text-headline-md font-headline-md text-primary">Rekomendasi Penanganan</h3>
                </div>

                @if($utama->penyakit->penanganan->where('jenis', 'pencegahan')->count())
                <div class="mb-4">
                    <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-3">Pencegahan</p>
                    <div class="flex flex-col gap-3">
                        @foreach($utama->penyakit->penanganan->where('jenis', 'pencegahan') as $i => $p)
                        <div class="flex gap-3 items-start text-body-md font-body-md text-on-surface-variant">
                            <span class="material-symbols-outlined text-primary mt-0.5 text-[20px] flex-shrink-0">filter_{{ $i + 1 }}</span>
                            <p>{{ $p->deskripsi }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($utama->penyakit->penanganan->where('jenis', 'pengendalian')->count())
                <div>
                    <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-3">Pengendalian</p>
                    <div class="flex flex-col gap-3">
                        @foreach($utama->penyakit->penanganan->where('jenis', 'pengendalian') as $i => $p)
                        <div class="flex gap-3 items-start text-body-md font-body-md text-on-surface-variant">
                            <span class="material-symbols-outlined text-secondary mt-0.5 text-[20px] flex-shrink-0">filter_{{ $i + 1 }}</span>
                            <p>{{ $p->deskripsi }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

            @else
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow border border-surface-container text-center">
                <span class="material-symbols-outlined text-[48px] text-on-surface-variant opacity-30">search_off</span>
                <p class="text-body-lg font-body-lg text-on-surface-variant mt-4">Tidak ada penyakit yang terdeteksi berdasarkan gejala yang dipilih.</p>
            </div>
            @endif
        </div>
    </div>
</main>

@endsection