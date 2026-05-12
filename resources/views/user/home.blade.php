@extends('layouts.app')
@section('title', 'Beranda — AgriScan Rice')
@section('content')

<main class="flex-grow w-full relative flex items-center justify-center min-h-[calc(100vh-160px)]">
    {{-- Hero Background --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1600&q=80"
             alt="Sawah Padi" class="w-full h-full object-cover object-center"/>
        <div class="absolute inset-0 bg-[#2e312c]/50 backdrop-blur-sm z-0"></div>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-10 flex flex-col items-center justify-center text-center px-4 md:px-10 max-w-[800px] mx-auto pt-10 pb-20">
        <div class="bg-surface/90 backdrop-blur-md px-6 py-3 rounded-full mb-8 inline-flex items-center gap-2 border border-outline-variant/50 shadow-sm">
            <span class="material-symbols-outlined text-secondary icon-filled" style="font-size:18px">psychiatry</span>
            <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Teknologi Analisis Penyakit</span>
        </div>

        <h1 class="text-4xl md:text-[48px] leading-tight font-bold font-headline-lg text-white mb-6 drop-shadow-md">
            SISTEM PAKAR DIAGNOSA <br/>
            <span class="text-[#bcf0ae]">PENYAKIT PADA TANAMAN PADI</span>
        </h1>

        <p class="text-body-lg font-body-lg text-[#f0f1ea] mb-12 max-w-[600px] font-medium drop-shadow-sm">
            Deteksi dini masalah pertanian dengan presisi tinggi. Analisis gejala lapangan menggunakan
            metode Forward Chaining dan Certainty Factor.
        </p>

        <a href="{{ route('diagnosa') }}"
           class="bg-primary text-on-primary hover:bg-surface-tint px-10 py-5 rounded-full text-headline-md font-headline-md flex items-center gap-3 transition-transform hover:scale-105 shadow-lg border-2 border-[#bcf0ae]/20 group">
            <span class="material-symbols-outlined icon-filled text-[32px] group-hover:rotate-12 transition-transform">document_scanner</span>
            MULAI DIAGNOSA
        </a>

        {{-- Stats --}}
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl opacity-90">
            <div class="bg-surface/80 backdrop-blur-md rounded-xl p-4 flex items-center gap-4 border border-outline-variant/30">
                <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined">speed</span>
                </div>
                <div class="text-left">
                    <div class="text-label-sm font-label-sm text-on-surface">Hasil Cepat</div>
                    <div class="text-body-md font-body-md text-on-surface-variant text-sm">Analisis &lt; 3 Detik</div>
                </div>
            </div>
            <div class="bg-surface/80 backdrop-blur-md rounded-xl p-4 flex items-center gap-4 border border-outline-variant/30">
                <div class="w-12 h-12 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined">target</span>
                </div>
                <div class="text-left">
                    <div class="text-label-sm font-label-sm text-on-surface">Akurasi Tinggi</div>
                    <div class="text-body-md font-body-md text-on-surface-variant text-sm">Berbasis Data Pakar</div>
                </div>
            </div>
            <div class="bg-surface/80 backdrop-blur-md rounded-xl p-4 flex items-center gap-4 border border-outline-variant/30">
                <div class="w-12 h-12 rounded-full bg-tertiary-container text-on-tertiary-container flex items-center justify-center">
                    <span class="material-symbols-outlined">library_books</span>
                </div>
                <div class="text-left">
                    <div class="text-label-sm font-label-sm text-on-surface">{{ $penyakit->count() }} Penyakit</div>
                    <div class="text-body-md font-body-md text-on-surface-variant text-sm">Terdeteksi Sistem</div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection