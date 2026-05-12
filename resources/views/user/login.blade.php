@extends('layouts.app')
@section('title', 'Login Admin — AgriScan Rice')
@section('content')

<main class="flex-grow flex flex-col md:flex-row w-full">
    {{-- Kiri: Form --}}
    <div class="w-full md:w-1/2 lg:w-5/12 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-surface z-10">
        <div class="w-full max-w-md">
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-headline-lg font-headline-lg text-on-surface mb-2">Selamat Datang</h1>
                <p class="text-body-md font-body-md text-on-surface-variant">Silakan masuk ke akun admin untuk melanjutkan.</p>
            </div>

            @if($errors->any())
            <div class="mb-6 bg-error-container text-on-error-container px-4 py-3 rounded-lg text-body-md font-body-md">
                {{ $errors->first() }}
            </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('login.proses') }}">
                @csrf
                <div>
                    <label class="block text-label-sm font-label-sm text-on-surface mb-2" for="username">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </div>
                        <input class="w-full pl-10 pr-4 py-3 bg-surface-bright border border-outline-variant rounded-lg text-body-md font-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-outline/70"
                               id="username" name="username" value="{{ old('username') }}"
                               placeholder="Masukkan username Anda" type="text" required/>
                    </div>
                </div>

                <div>
                    <label class="block text-label-sm font-label-sm text-on-surface mb-2" for="password">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                        </div>
                        <input class="w-full pl-10 pr-4 py-3 bg-surface-bright border border-outline-variant rounded-lg text-body-md font-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-outline/70"
                               id="password" name="password" placeholder="••••••••" type="password" required/>
                    </div>
                </div>

                <div class="pt-4">
                    <button class="w-full bg-primary hover:bg-surface-tint text-on-primary text-label-sm font-label-sm py-3.5 rounded-lg shadow-sm active:scale-[0.98] transition-all duration-200 flex justify-center items-center gap-2" type="submit">
                        <span>MASUK</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Kanan: Gambar --}}
    <div class="hidden md:block md:w-1/2 lg:w-7/12 relative bg-surface-container-high overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-tr from-primary/80 to-transparent z-10 mix-blend-multiply"></div>
        <img alt="Sawah Padi"
             class="absolute inset-0 w-full h-full object-cover z-0"
             src="https://images.unsplash.com/photo-1536657464919-892534f60d6e?w=1200&q=80"/>
        <div class="absolute bottom-16 right-16 z-20 max-w-sm text-right">
            <h2 class="text-headline-md font-headline-md text-white mb-2 drop-shadow-md">Teknologi Restoratif</h2>
            <p class="text-body-md font-body-md text-[#f9faf2]/90 drop-shadow-sm">Analisis presisi untuk pertanian berkelanjutan dan ketahanan pangan masa depan.</p>
        </div>
    </div>
</main>

@endsection