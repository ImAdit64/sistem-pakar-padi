@extends('layouts.app')
@section('title', 'Tentang — AgriScan Rice')
@section('content')

<main class="flex-grow w-full max-w-[1280px] mx-auto px-4 md:px-10 py-12 md:py-20 flex flex-col gap-16 md:gap-24">

    {{-- Hero --}}
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
        <div class="lg:col-span-6 flex flex-col gap-6 pr-0 md:pr-12">
            <div class="inline-flex items-center gap-2 bg-secondary-fixed-dim/20 text-primary px-4 py-1.5 rounded-full w-max">
                <span class="material-symbols-outlined text-[18px]">science</span>
                <span class="text-label-sm font-label-sm tracking-widest uppercase">Misi Kami</span>
            </div>
            <h1 class="text-display-lg font-display-lg text-on-surface tracking-tight">
                Teknologi Presisi untuk <span class="text-primary">Pertanian Restoratif</span>.
            </h1>
            <p class="text-body-lg font-body-lg text-on-surface-variant leading-relaxed">
                AgriScan Rice adalah sistem pakar cerdas yang dirancang untuk menjembatani kesenjangan antara
                analisis ilmiah yang ketat dan aksesibilitas di tingkat lapangan. Kami memberdayakan petani
                dengan alat diagnostik mutakhir untuk mengidentifikasi dan menangani stres pada tanaman padi
                secara instan menggunakan metode Forward Chaining dan Certainty Factor.
            </p>
        </div>
        <div class="lg:col-span-6 relative rounded-xl overflow-hidden shadow-sm h-[400px] md:h-[500px]">
            <img alt="Sawah Padi"
                 class="w-full h-full object-cover"
                 src="https://images.unsplash.com/photo-1536657464919-892534f60d6e?w=1200&q=80"/>
        </div>
    </section>

    {{-- Masalah & Solusi --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-surface-container-low rounded-xl p-8 md:p-12 flex flex-col justify-center border border-surface-container">
            <div class="mb-6 h-12 w-12 rounded-full bg-error-container text-on-error-container flex items-center justify-center">
                <span class="material-symbols-outlined">pest_control</span>
            </div>
            <h2 class="text-headline-md font-headline-md text-on-surface mb-4">Tantangan di Lapangan</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">
                Penyakit dan hama tanaman padi seringkali sulit diidentifikasi pada tahap awal. Keterlambatan diagnosis
                berujung pada penurunan hasil panen, penggunaan pestisida berlebihan, dan kerugian ekonomi yang besar bagi petani.
            </p>
        </div>
        <div class="bg-primary rounded-xl p-8 md:p-12 flex flex-col justify-center text-on-primary shadow-sm relative overflow-hidden">
            <div class="mb-6 h-12 w-12 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center relative z-10">
                <span class="material-symbols-outlined">psychiatry</span>
            </div>
            <h2 class="text-headline-md font-headline-md mb-4 relative z-10">Solusi Berbasis Data</h2>
            <p class="text-body-md font-body-md text-surface-container-high relative z-10">
                Sistem pakar kami menggunakan metode Forward Chaining untuk penalaran berbasis gejala dan
                Certainty Factor untuk menghitung tingkat kepastian diagnosis, memberikan hasil yang akurat dan dapat dipertanggungjawabkan.
            </p>
        </div>
    </section>

    {{-- Keunggulan --}}
    <section class="flex flex-col gap-10">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-headline-lg font-headline-lg text-on-surface mb-4">Nilai Tambah bagi Petani</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Fokus kami adalah memberikan kepastian di tengah ketidakpastian diagnosis penyakit tanaman.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-surface-container hover:border-secondary transition-all duration-300 flex flex-col">
                <span class="material-symbols-outlined text-[32px] text-primary mb-6">speed</span>
                <h3 class="text-headline-md font-headline-md text-on-surface mb-3 border-b border-surface-container-highest pb-3">Deteksi Dini</h3>
                <p class="text-body-md font-body-md text-on-surface-variant flex-grow">
                    Identifikasi gejala pada fase paling awal sebelum kerusakan meluas, memungkinkan tindakan preventif yang lebih efektif.
                </p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-surface-container hover:border-secondary transition-all duration-300 flex flex-col">
                <span class="material-symbols-outlined text-[32px] text-primary mb-6">eco</span>
                <h3 class="text-headline-md font-headline-md text-on-surface mb-3 border-b border-surface-container-highest pb-3">Penanganan Tepat Guna</h3>
                <p class="text-body-md font-body-md text-on-surface-variant flex-grow">
                    Rekomendasi tindakan yang spesifik untuk setiap jenis penyakit, mengurangi penggunaan bahan kimia yang tidak perlu.
                </p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-surface-container hover:border-secondary transition-all duration-300 flex flex-col">
                <span class="material-symbols-outlined text-[32px] text-primary mb-6">query_stats</span>
                <h3 class="text-headline-md font-headline-md text-on-surface mb-3 border-b border-surface-container-highest pb-3">Peningkatan Hasil</h3>
                <p class="text-body-md font-body-md text-on-surface-variant flex-grow">
                    Dengan meminimalisir gagal panen akibat serangan penyakit, produktivitas lahan dapat dimaksimalkan secara konsisten.
                </p>
            </div>
        </div>
    </section>

    {{-- Info Pengembang --}}
    <section class="bg-surface-container-lowest rounded-xl p-8 md:p-12 border border-surface-container shadow-sm">
        <h2 class="text-headline-md font-headline-md text-primary mb-6">Tentang Pengembang</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-body-md font-body-md text-on-surface-variant">
            <div class="space-y-2">
                <div class="flex gap-3"><span class="text-on-surface font-semibold min-w-[140px]">Nama</span><span>Aditya Firsyananda</span></div>
                <div class="flex gap-3"><span class="text-on-surface font-semibold min-w-[140px]">NIM</span><span>2210114002-43</span></div>
                <div class="flex gap-3"><span class="text-on-surface font-semibold min-w-[140px]">Program Studi</span><span>Teknik Informatika</span></div>
                <div class="flex gap-3"><span class="text-on-surface font-semibold min-w-[140px]">Universitas</span><span>Universitas Pamulang</span></div>
                <div class="flex gap-3"><span class="text-on-surface font-semibold min-w-[140px]">Tahun</span><span>2025</span></div>
            </div>
        </div>
    </section>

</main>

@endsection