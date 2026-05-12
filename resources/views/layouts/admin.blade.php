<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin — AgriScan Rice')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Manrope:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .icon-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    "surface-dim":"#d9dbd3","surface-container-high":"#e7e9e1","surface-bright":"#f9faf2",
                    "secondary-fixed":"#94f990","on-surface-variant":"#42493e","on-primary":"#ffffff",
                    "primary-fixed":"#bcf0ae","outline":"#72796e","inverse-surface":"#2e312c",
                    "surface-container-highest":"#e2e3dc","inverse-on-surface":"#f0f1ea",
                    "surface-tint":"#3b6934","surface-container":"#edefe7","surface-variant":"#e2e3dc",
                    "secondary-fixed-dim":"#78dc77","background":"#f9faf2","tertiary-container":"#7c3a55",
                    "on-background":"#191c18","inverse-primary":"#a1d494","on-tertiary":"#ffffff",
                    "surface-container-low":"#f3f4ed","error":"#ba1a1a","tertiary-fixed":"#ffd9e4",
                    "on-surface":"#191c18","primary-fixed-dim":"#a1d494","on-error-container":"#93000a",
                    "on-primary-container":"#9dd090","surface":"#f9faf2","outline-variant":"#c2c9bb",
                    "primary-container":"#2d5a27","secondary-container":"#91f78e","error-container":"#ffdad6",
                    "secondary":"#006e1c","on-error":"#ffffff","primary":"#154212",
                    "on-secondary-container":"#00731e","surface-container-lowest":"#ffffff",
                    "on-tertiary-container":"#ffaac8","tertiary":"#60233e",
                    "on-secondary-fixed-variant":"#005313","on-primary-fixed-variant":"#23501e",
                    "on-secondary-fixed":"#002204","on-tertiary-fixed":"#3b0520",
                    "on-primary-fixed":"#002201","tertiary-fixed-dim":"#ffb0cc",
                    "on-tertiary-fixed-variant":"#71314c","on-secondary":"#ffffff",
                },
                borderRadius: { "DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px" },
                spacing: { "container-max":"1280px","margin-desktop":"40px","margin-mobile":"16px","base":"8px","gutter":"24px" },
                fontFamily: { "headline-lg":["Manrope"],"headline-md":["Manrope"],"display-lg":["Manrope"],"headline-lg-mobile":["Manrope"],"body-md":["Inter"],"body-lg":["Inter"],"label-sm":["Inter"] },
                fontSize: {
                    "label-sm":["12px",{"lineHeight":"16px","letterSpacing":"0.05em","fontWeight":"600"}],
                    "body-md":["16px",{"lineHeight":"24px","fontWeight":"400"}],
                    "body-lg":["18px",{"lineHeight":"28px","fontWeight":"400"}],
                    "headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],
                    "headline-lg":["32px",{"lineHeight":"40px","fontWeight":"600"}],
                    "display-lg":["48px",{"lineHeight":"56px","letterSpacing":"-0.02em","fontWeight":"700"}],
                    "headline-lg-mobile":["24px",{"lineHeight":"32px","fontWeight":"600"}],
                }
            }}
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md text-body-md antialiased min-h-screen flex flex-col">

{{-- Navbar Admin --}}
<header class="bg-surface border-b border-outline-variant shadow-sm sticky top-0 z-50">
    <div class="flex justify-between items-center w-full px-4 md:px-10 py-4 max-w-[1280px] mx-auto">
        {{-- Brand --}}
        <div class="flex items-center gap-8">
            <a href="{{ route('admin.dashboard') }}"
               class="text-headline-md font-headline-md font-bold text-primary tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined icon-filled">eco</span>
                AgriScan Rice
            </a>
            {{-- Nav Links --}}
            <nav class="hidden md:flex items-center gap-6">
                @php
                    $navLinks = [
                        ['route' => 'admin.dashboard',      'label' => 'Dashboard'],
                        ['route' => 'admin.penyakit.index', 'label' => 'Penyakit'],
                        ['route' => 'admin.gejala.index',   'label' => 'Gejala'],
                        ['route' => 'admin.relasi.index',   'label' => 'Relasi'],
                        ['route' => 'admin.aturan',         'label' => 'Aturan'],
                        ['route' => 'admin.laporan',        'label' => 'Riwayat Diagnosa'],
                    ];
                @endphp
                @foreach($navLinks as $nav)
                <a href="{{ route($nav['route']) }}"
                   class="text-label-sm font-label-sm transition-colors
                   {{ request()->routeIs($nav['route']) || request()->routeIs($nav['route'].'*')
                        ? 'text-primary font-bold border-b-2 border-primary pb-1'
                        : 'text-on-surface-variant font-medium hover:text-secondary' }}">
                    {{ $nav['label'] }}
                </a>
                @endforeach
            </nav>
        </div>
        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-error text-label-sm font-label-sm font-bold uppercase tracking-wider hover:bg-error-container px-4 py-2 rounded-lg border border-transparent hover:border-error-container transition-colors">
                Logout
            </button>
        </form>
    </div>
</header>

{{-- Konten --}}
<main class="flex-grow w-full max-w-[1280px] mx-auto px-4 md:px-10 py-8 md:py-12">
    @if(session('success'))
    <div class="mb-6 bg-secondary-container text-on-secondary-container px-4 py-3 rounded-lg flex items-center gap-2 text-body-md font-body-md">
        <span class="material-symbols-outlined icon-filled text-[20px]">check_circle</span>
        {{ session('success') }}
    </div>
    @endif
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-surface-container border-t border-outline-variant mt-auto">
    <div class="flex flex-col md:flex-row justify-between items-center px-4 md:px-10 py-8 w-full max-w-[1280px] mx-auto gap-4">
        <div class="text-center md:text-left">
            <span class="text-headline-md font-headline-md font-bold text-primary flex items-center gap-2 justify-center md:justify-start">
                <span class="material-symbols-outlined icon-filled">eco</span>
                AgriScan Rice
            </span>
            <p class="text-body-md font-body-md text-on-surface-variant mt-1">© 2025 AgriScan Rice — Universitas Pamulang</p>
        </div>
        <div class="flex gap-6">
            <a href="#" class="text-label-sm font-label-sm text-on-surface-variant hover:text-secondary underline transition-all opacity-80 hover:opacity-100">Panduan Admin</a>
            <a href="#" class="text-label-sm font-label-sm text-on-surface-variant hover:text-secondary underline transition-all opacity-80 hover:opacity-100">Kebijakan Privasi</a>
        </div>
    </div>
</footer>

</body>
</html>