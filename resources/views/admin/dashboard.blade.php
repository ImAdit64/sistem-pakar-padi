@extends('layouts.admin')
@section('title', 'Dashboard — AgriScan Rice')
@section('content')

{{-- Hero --}}
<div class="relative rounded-2xl overflow-hidden mb-10">
    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1600&q=80"
         alt="Sawah" class="w-full h-64 object-cover object-center"/>
    <div class="absolute inset-0 bg-surface/90 backdrop-blur-sm"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center gap-3 px-4">
        <h1 class="text-display-lg font-display-lg text-primary">Selamat Datang, Admin</h1>
        <p class="text-body-lg font-body-lg text-on-surface-variant max-w-2xl">
            Sistem Pakar Diagnosa Penyakit Padi beroperasi secara normal.
        </p>
        <div class="inline-flex items-center gap-2 bg-secondary-container text-on-secondary-container px-4 py-2 rounded-full shadow-sm">
            <span class="material-symbols-outlined icon-filled text-[18px]">check_circle</span>
            <span class="text-label-sm font-label-sm">Sistem Aktif</span>
        </div>
    </div>
</div>

{{-- Stats + Aksi Cepat --}}
<div class="bg-surface-container-lowest rounded-2xl shadow border border-outline-variant/30 overflow-hidden">
    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 border-b border-outline-variant/30 divide-x divide-y md:divide-y-0 divide-outline-variant/30">
        @php
            $stats = [
                ['icon' => 'bug_report',    'value' => $totalPenyakit,  'label' => 'Total Penyakit'],
                ['icon' => 'list_alt',      'value' => $totalGejala,    'label' => 'Total Gejala'],
                ['icon' => 'account_tree',  'value' => $totalRelasi,    'label' => 'Total Relasi'],
                ['icon' => 'history',       'value' => $totalDiagnosa,  'label' => 'Riwayat Diagnosa'],
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="p-6 text-center flex flex-col items-center hover:bg-surface-container-low transition-colors">
            <div class="w-10 h-10 rounded-full bg-primary-fixed text-on-primary-fixed flex items-center justify-center mb-3">
                <span class="material-symbols-outlined text-[20px]">{{ $stat['icon'] }}</span>
            </div>
            <div class="text-headline-lg font-headline-lg text-primary mb-1">{{ $stat['value'] }}</div>
            <div class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Aksi Cepat --}}
    <div class="p-8 bg-surface/50">
        <h2 class="text-headline-md font-headline-md text-on-surface mb-6 text-center">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php
                $actions = [
                    ['route' => 'admin.penyakit.create', 'icon' => 'add_circle',  'title' => 'Tambah Penyakit Baru',  'desc' => 'Update basis data penyakit'],
                    ['route' => 'admin.gejala.create',   'icon' => 'post_add',    'title' => 'Tambah Gejala Baru',    'desc' => 'Input parameter gejala baru'],
                    ['route' => 'admin.relasi.create',   'icon' => 'schema',      'title' => 'Tambah Relasi Baru',    'desc' => 'Atur bobot dan hubungan'],
                    ['route' => 'admin.laporan',         'icon' => 'monitoring',  'title' => 'Lihat Riwayat Diagnosa','desc' => 'Analisa tren diagnosa user'],
                ];
            @endphp
            @foreach($actions as $action)
            <a href="{{ route($action['route']) }}"
               class="group flex items-center p-4 border border-outline-variant/50 rounded-xl hover:border-primary hover:shadow-md transition-all bg-surface-container-lowest">
                <div class="w-12 h-12 rounded-full bg-surface-container-high group-hover:bg-primary-fixed transition-colors flex items-center justify-center mr-4 flex-shrink-0">
                    <span class="material-symbols-outlined text-primary group-hover:text-on-primary-fixed">{{ $action['icon'] }}</span>
                </div>
                <div>
                    <div class="text-body-lg font-body-lg text-on-surface group-hover:text-primary font-semibold">{{ $action['title'] }}</div>
                    <div class="text-body-md font-body-md text-on-surface-variant text-sm">{{ $action['desc'] }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection