@extends('layouts.app')
@section('title', 'Diagnosa Penyakit — AgriScan Rice')
@section('content')

<main class="flex-grow flex flex-col items-center justify-center px-4 md:px-10 py-12 max-w-[1280px] mx-auto w-full">

    <form method="POST" action="{{ route('diagnosa.proses') }}" id="form-diagnosa">
        @csrf

        {{-- Nama Pengguna --}}
        <div id="step-nama" class="w-full max-w-4xl">
            <div class="bg-surface-container-lowest rounded-xl shadow border border-outline-variant/30 overflow-hidden">
                <div class="bg-surface-container-low px-6 py-4 flex items-center justify-between border-b border-outline-variant/30">
                    <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Diagnosa Penyakit Tanaman Padi</span>
                    <div class="flex items-center gap-2">
                        <div class="w-24 h-2 bg-outline-variant/30 rounded-full overflow-hidden">
                            <div class="w-0 h-full bg-secondary rounded-full" id="progress-bar" style="transition: width 0.4s ease"></div>
                        </div>
                        <span class="text-label-sm font-label-sm text-secondary" id="progress-label">Mulai</span>
                    </div>
                </div>
                <div class="p-8 flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-primary-container flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[48px] text-on-primary-container icon-filled">person</span>
                    </div>
                    <h2 class="text-headline-md font-headline-md text-on-surface text-center max-w-xl mb-8">
                        Siapa nama Anda?
                    </h2>
                    <input type="text" name="nama_pengguna" required
                        placeholder="Masukkan nama Anda"
                        class="w-full max-w-md border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-surface-bright"/>
                    <div class="mt-8 flex gap-4">
                        <button type="button" onclick="nextStep()"
                            class="bg-primary text-on-primary px-8 py-3 rounded-full text-label-sm font-label-sm hover:bg-surface-tint transition-all flex items-center gap-2">
                            Mulai Diagnosa
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pertanyaan Gejala Satu per Satu --}}
        @foreach($gejala as $index => $g)
        <div id="step-{{ $index + 1 }}" class="w-full max-w-4xl hidden">
            <div class="bg-surface-container-lowest rounded-xl shadow border border-outline-variant/30 overflow-hidden">
                <div class="bg-surface-container-low px-6 py-4 flex items-center justify-between border-b border-outline-variant/30">
                    <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Gejala {{ $g->kode }}</span>
                    <div class="flex items-center gap-2">
                        <div class="w-24 h-2 bg-outline-variant/30 rounded-full overflow-hidden">
                            <div class="h-full bg-secondary rounded-full" style="width: {{ round(($index + 1) / $gejala->count() * 100) }}%"></div>
                        </div>
                        <span class="text-label-sm font-label-sm text-secondary">{{ $index + 1 }}/{{ $gejala->count() }}</span>
                    </div>
                </div>

                <div class="p-8 flex flex-col items-center">
                    {{-- Foto Gejala --}}
                    <div class="w-full max-w-2xl aspect-video bg-surface-container rounded-lg border border-outline-variant/50 flex items-center justify-center overflow-hidden mb-8 relative group">
                        @if($g->foto)
                            <img src="{{ asset('storage/' . $g->foto) }}"
                                 alt="{{ $g->nama_gejala }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        @else
                            <div class="flex flex-col items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[64px] opacity-20">image</span>
                                <span class="text-label-sm font-label-sm opacity-40">Belum ada foto gejala</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 border-2 border-secondary border-dashed m-8 rounded-lg pointer-events-none opacity-50"></div>
                    </div>

                    {{-- Pertanyaan --}}
                    <h2 class="text-headline-md font-headline-md text-on-surface text-center max-w-xl mb-10">
                        Apakah tanaman Anda menunjukkan gejala: <span class="text-primary">{{ $g->nama_gejala }}</span>?
                    </h2>

                    {{-- Hidden input untuk gejala yang dipilih --}}
                    <input type="hidden" name="cf_user[{{ $g->id }}]" id="cf-{{ $g->id }}" value="">

                    {{-- Tombol Jawaban --}}
                    <div class="flex flex-col sm:flex-row gap-4 w-full max-w-xl justify-center">
                        <button type="button"
                            onclick="pilihJawaban({{ $g->id }}, 1.0, {{ $index + 1 }}, {{ $gejala->count() }}, true)"
                            class="flex-1 bg-surface-container-lowest border-2 border-outline-variant text-on-surface hover:border-secondary hover:text-secondary hover:bg-secondary-container/10 transition-all rounded-lg py-4 px-6 text-label-sm font-label-sm flex flex-col items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-[28px]">check_circle</span>
                            YA
                        </button>
                        <button type="button"
                            onclick="pilihJawaban({{ $g->id }}, 0.4, {{ $index + 1 }}, {{ $gejala->count() }}, true)"
                            class="flex-1 bg-surface-container-lowest border-2 border-outline-variant text-on-surface hover:border-secondary hover:text-secondary hover:bg-secondary-container/10 transition-all rounded-lg py-4 px-6 text-label-sm font-label-sm flex flex-col items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-[28px]">help</span>
                            KURANG YAKIN
                        </button>
                        <button type="button"
                            onclick="pilihJawaban({{ $g->id }}, 0.0, {{ $index + 1 }}, {{ $gejala->count() }}, false)"
                            class="flex-1 bg-surface-container-lowest border-2 border-outline-variant text-on-surface hover:border-error hover:text-error hover:bg-error-container/20 transition-all rounded-lg py-4 px-6 text-label-sm font-label-sm flex flex-col items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-[28px]">cancel</span>
                            TIDAK
                        </button>
                    </div>
                </div>

                <div class="bg-surface-container-low px-8 py-4 flex justify-between items-center border-t border-outline-variant/30">
                    <button type="button" onclick="prevStep({{ $index + 1 }})"
                        class="text-primary font-label-sm text-label-sm hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Kembali
                    </button>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Step Konfirmasi & Submit --}}
        <div id="step-submit" class="w-full max-w-4xl hidden">
            <div class="bg-surface-container-lowest rounded-xl shadow border border-outline-variant/30 overflow-hidden">
                <div class="p-8 flex flex-col items-center text-center">
                    <div class="w-24 h-24 rounded-full bg-secondary-container flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[48px] text-on-secondary-container icon-filled">task_alt</span>
                    </div>
                    <h2 class="text-headline-md font-headline-md text-on-surface mb-4">Diagnosa Siap Diproses</h2>
                    <p class="text-body-md font-body-md text-on-surface-variant mb-8">
                        Semua gejala telah diinput. Klik tombol di bawah untuk memproses diagnosis.
                    </p>
                    <div class="flex gap-4">
                        <button type="submit"
                            class="bg-primary text-on-primary px-10 py-4 rounded-full text-headline-md font-headline-md flex items-center gap-3 hover:bg-surface-tint transition-all shadow-lg">
                            <span class="material-symbols-outlined icon-filled">document_scanner</span>
                            PROSES DIAGNOSA
                        </button>
                        <button type="button" onclick="prevStep('submit')"
                            class="border-2 border-outline-variant text-on-surface px-6 py-4 rounded-full text-label-sm font-label-sm hover:border-secondary hover:text-secondary transition-all">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script>
let currentStep = 'nama';
let totalGejala = {{ $gejala->count() }};
let gejalaTerpilih = {};

function nextStep() {
    if (currentStep === 'nama') {
        const nama = document.querySelector('[name="nama_pengguna"]').value.trim();
        if (!nama) { alert('Mohon masukkan nama Anda terlebih dahulu.'); return; }
        showStep(1);
        currentStep = 1;
    }
}

function showStep(step) {
    document.querySelectorAll('[id^="step-"]').forEach(el => el.classList.add('hidden'));
    if (step === 'submit') {
        document.getElementById('step-submit').classList.remove('hidden');
    } else if (step === 'nama') {
        document.getElementById('step-nama').classList.remove('hidden');
    } else {
        document.getElementById('step-' + step).classList.remove('hidden');
    }
}

function pilihJawaban(gejalaId, cfValue, stepIndex, total, dipilih) {
    if (dipilih && cfValue > 0) {
        gejalaTerpilih[gejalaId] = cfValue;
        // Tambah hidden input untuk gejala yang dipilih
        let existing = document.querySelector(`input[name="gejala[]"][value="${gejalaId}"]`);
        if (!existing) {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'gejala[]';
            input.value = gejalaId;
            document.getElementById('form-diagnosa').appendChild(input);
        }
    } else {
        // Hapus jika sebelumnya dipilih
        delete gejalaTerpilih[gejalaId];
        let existing = document.querySelector(`input[name="gejala[]"][value="${gejalaId}"]`);
        if (existing) existing.remove();
    }

    // Set nilai CF
    document.getElementById('cf-' + gejalaId).value = cfValue;

    // Pindah ke step berikutnya
    if (stepIndex >= total) {
        currentStep = 'submit';
        showStep('submit');
    } else {
        currentStep = stepIndex + 1;
        showStep(stepIndex + 1);
    }
}

function prevStep(currentIndex) {
    if (currentIndex === 1 || currentIndex === 'submit') {
        if (currentIndex === 'submit') {
            showStep(totalGejala);
            currentStep = totalGejala;
        } else {
            showStep('nama');
            currentStep = 'nama';
        }
    } else {
        showStep(currentIndex - 1);
        currentStep = currentIndex - 1;
    }
}
</script>

@endsection