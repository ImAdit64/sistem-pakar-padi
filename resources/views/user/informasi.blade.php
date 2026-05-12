@extends('layouts.app')
@section('title', 'Informasi Penyakit — AgriScan Rice')
@section('content')

<main class="flex-grow w-full max-w-[1280px] mx-auto px-4 md:px-10 py-12">
    {{-- Header --}}
    <div class="mb-10">
        <div class="inline-flex items-center gap-2 bg-secondary-container/30 text-primary px-4 py-1.5 rounded-full mb-4">
            <span class="material-symbols-outlined text-[18px]">eco</span>
            <span class="text-label-sm font-label-sm uppercase tracking-wider">Database Penyakit</span>
        </div>
        <h1 class="text-headline-lg font-headline-lg text-on-surface mb-3">Informasi Penyakit Tanaman Padi</h1>
        <p class="text-body-lg font-body-lg text-on-surface-variant max-w-2xl">
            Kenali berbagai jenis hama dan penyakit yang umum menyerang tanaman padi di Indonesia beserta cara penanganannya.
        </p>
    </div>

    {{-- Grid Penyakit --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($penyakit as $p)
        <article class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden hover:border-secondary hover:shadow-md transition-all duration-300 group flex flex-col h-full">
            <div class="h-48 relative overflow-hidden bg-surface-container">
                @if($p->gambar)
                    <img src="{{ asset('storage/' . $p->gambar) }}"
                         alt="{{ $p->nama }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-[64px] text-on-surface-variant opacity-20">eco</span>
                    </div>
                @endif
                <div class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-label-sm font-label-sm flex items-center gap-1 shadow-sm">
                    {{ $p->kode }}
                </div>
            </div>

            <div class="p-6 flex flex-col flex-grow">
                <h2 class="text-headline-md font-headline-md text-primary mb-2 border-b border-surface-container-high pb-2">{{ $p->nama }}</h2>
                <p class="text-body-md font-body-md text-on-surface-variant mb-4 flex-grow line-clamp-3">
                    {{ $p->deskripsi }}
                </p>

                @if($p->penanganan->count())
                <div class="mt-4 space-y-3 border-t border-surface-container-high pt-4">
                    @if($p->penanganan->where('jenis', 'pencegahan')->count())
                    <div>
                        <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">Pencegahan</p>
                        <ul class="space-y-1">
                            @foreach($p->penanganan->where('jenis', 'pencegahan')->take(2) as $item)
                            <li class="flex items-start gap-2 text-body-md font-body-md text-on-surface-variant">
                                <span class="material-symbols-outlined text-secondary text-[16px] mt-0.5 flex-shrink-0">check_circle</span>
                                {{ Str::limit($item->deskripsi, 80) }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if($p->penanganan->where('jenis', 'pengendalian')->count())
                    <div>
                        <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">Pengendalian</p>
                        <ul class="space-y-1">
                            @foreach($p->penanganan->where('jenis', 'pengendalian')->take(2) as $item)
                            <li class="flex items-start gap-2 text-body-md font-body-md text-on-surface-variant">
                                <span class="material-symbols-outlined text-primary text-[16px] mt-0.5 flex-shrink-0">arrow_right</span>
                                {{ Str::limit($item->deskripsi, 80) }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </article>
        @endforeach
    </div>
</main>

@endsection