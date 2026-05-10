<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '2IBSN – Institut International Baye Barhamou')</title>
    <meta name="description" content="@yield('meta_description', 'Institut International Baye Barhamou – Éducation d\'excellence franco-islamique à Dakar, Sénégal.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --color-primary: {{ App\Models\Setting::get('primary_color', '#1a4d2e') }};
            --color-secondary: {{ App\Models\Setting::get('secondary_color', '#d4af37') }};
        }
    </style>
</head>

<body class="bg-[#f7f5f0] font-sans antialiased text-gray-800">

    {{-- ════════════════════ HEADER ════════════════════ --}}
    {{-- ════════════════════ HEADER ════════════════════ --}}
    <header id="main-header" class="main-header fixed w-full top-0 z-[1000] transition-all duration-500">
        
        {{-- TOP BAR --}}
        <div class="top-bar">
            <div class="container flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <a href="tel:+221773750724" class="text-[11px] font-medium flex items-center gap-2 hover:text-secondary transition-colors">
                        <i class="fas fa-phone text-secondary text-[10px]"></i>
                        <span>+221 77 375 07 24</span>
                    </a>
                    <a href="mailto:contact@2ibsn.edu.sn" class="text-[11px] font-medium flex items-center gap-2 hover:text-secondary transition-colors">
                        <i class="fas fa-envelope text-secondary text-[10px]"></i>
                        <span>contact@2ibsn.edu.sn</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest mr-2">Suivez-nous</span>
                    <a href="#" class="text-[11px] hover:text-secondary transition-colors"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-[11px] hover:text-secondary transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/221773750724" target="_blank" class="text-[11px] hover:text-secondary transition-colors"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

        <div class="nav-inner transition-all duration-500">
            <div class="container">
                <div id="nav-container" class="flex items-center justify-between h-16 lg:h-20 transition-all duration-300">

                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                        <div class="relative">
                            @php
                                $logoPath = App\Models\Setting::get('logo_image');
                                $logoSrc = $logoPath ? asset('storage/' . $logoPath) : asset('Images/logo.png');
                            @endphp
                            <img src="{{ $logoSrc }}" alt="2IBSN Logo" class="logo-img h-14 w-auto object-contain transition-transform duration-500 group-hover:scale-110" loading="eager">
                            <div class="absolute -inset-2 bg-secondary/10 rounded-full blur-xl scale-0 group-hover:scale-100 transition-transform duration-500"></div>
                        </div>
                        <div class="hidden sm:flex flex-col leading-none">
                            <span id="logo-name" class="font-serif text-xl font-bold tracking-tight transition-colors duration-300">{{ App\Models\Setting::get('institute_name', '2IBSN') }}</span>
                            <span id="logo-sub" class="hidden sm:block text-[9px] uppercase tracking-[3px] mt-1 transition-colors duration-300 opacity-80">Institut Baye Barhamou</span>
                        </div>
                    </a>

                    {{-- Desktop Nav --}}
                    <nav class="hidden lg:flex items-center gap-1">
                        @foreach([
                            ['home',       'Accueil'],
                            ['about',      'À propos'],
                            ['programs',   'Programmes'],
                            ['admissions', 'Admissions'],
                        ] as [$route, $label])
                        <a href="{{ route($route) }}"
                           class="nav-pill px-5 py-2.5 rounded-full text-[13px] font-semibold tracking-wide transition-all duration-300
                                  {{ request()->routeIs($route) ? 'active shadow-sm' : '' }}">
                            {{ $label }}
                        </a>
                        @endforeach

                        <div class="h-6 w-px bg-gray-200 mx-4 opacity-50"></div>

                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-[12px] font-bold
                                  bg-secondary text-primary-dark uppercase tracking-widest
                                  transition-all duration-300 hover:bg-secondary-light hover:-translate-y-1
                                  hover:shadow-[0_10px_25px_rgba(212,175,55,0.4)] active:scale-95">
                            <i class="fas fa-paper-plane text-[10px]"></i> Contact
                        </a>
                    </nav>

                    {{-- Hamburger --}}
                    <button id="hamburger"
                            class="lg:hidden relative w-12 h-12 rounded-2xl flex flex-col items-center justify-center gap-[6px] cursor-pointer border border-black/5 bg-black/5 hover:bg-black/10 transition-all duration-300 active:scale-95"
                            aria-label="Menu">
                        <span class="hamburger-line block h-[2px] w-6 rounded-full transition-all duration-300 origin-center"></span>
                        <span class="hamburger-line block h-[2px] w-6 rounded-full transition-all duration-300"></span>
                        <span class="hamburger-line block h-[2px] w-4 rounded-full transition-all duration-300 origin-center self-end mr-3"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    {{-- ════════════ MOBILE NAV ════════════ --}}
    <div id="mobile-nav" class="fixed top-0 right-0 h-screen w-full max-w-[340px] z-[1100] flex flex-col lg:hidden overflow-hidden shadow-2xl"
         style="background: linear-gradient(165deg, #1a4d2e 0%, #0a2416 100%);">

        {{-- Decorative background elements --}}
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full opacity-10 pointer-events-none"
             style="background: radial-gradient(circle, #d4af37 0%, transparent 70%);"></div>
        <div class="absolute bottom-20 -left-20 w-64 h-64 rounded-full opacity-5 pointer-events-none"
             style="background: radial-gradient(circle, #ffffff 0%, transparent 70%);"></div>

        {{-- Header --}}
        <div class="relative flex items-center justify-between px-8 h-24 border-b border-white/5 z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-secondary/20 flex items-center justify-center border border-secondary/20">
                    <i class="fas fa-graduation-cap text-secondary text-sm"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-white font-bold text-xl leading-none">2IBSN</span>
                    <span class="text-[8px] text-white/50 uppercase tracking-widest mt-1">Dakar, Sénégal</span>
                </div>
            </div>
            <button id="mobile-close"
                    class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-all active:scale-90"
                    aria-label="Fermer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        {{-- Nav links --}}
        <nav class="flex flex-col px-6 py-10 gap-2 flex-1 relative z-10 overflow-y-auto">
            @foreach([
                ['home',       'Accueil',     'fas fa-home'],
                ['about',      'À propos',    'fas fa-university'],
                ['programs',   'Programmes',  'fas fa-book-open'],
                ['admissions', 'Admissions',  'fas fa-file-signature'],
                ['contact',    'Contact',     'fas fa-envelope'],
            ] as $i => [$route, $label, $icon])
            @php $isActive = request()->routeIs($route); @endphp
            <a href="{{ route($route) }}"
               class="nav-item group flex items-center gap-5 px-5 py-4 rounded-2xl transition-all duration-300"
               style="transition-delay: {{ 100 + ($i * 70) }}ms">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-sm shrink-0 transition-all duration-500
                            {{ $isActive ? 'bg-secondary text-primary-dark shadow-[0_8px_20px_rgba(212,175,55,0.3)]' : 'bg-white/5 text-white/70 group-hover:bg-white/10 group-hover:text-white' }}">
                    <i class="{{ $icon }}"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold tracking-wide {{ $isActive ? 'text-white' : 'text-white/80 group-hover:text-white' }}">{{ $label }}</span>
                    @if($isActive)
                        <span class="text-[10px] text-secondary font-medium uppercase tracking-widest mt-0.5">Page actuelle</span>
                    @endif
                </div>
                @if($isActive)
                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_10px_#d4af37]"></div>
                @else
                <i class="fas fa-chevron-right text-[10px] ml-auto opacity-0 -translate-x-2 group-hover:opacity-30 group-hover:translate-x-0 transition-all"></i>
                @endif
            </a>
            @endforeach
        </nav>

        {{-- Footer info --}}
        <div class="relative z-10 px-8 py-8 border-t border-white/5 space-y-4 bg-black/10">
            <p class="text-[10px] text-white/30 uppercase tracking-[2px] mb-2 font-bold">Contact Rapide</p>
            <a href="tel:+221773750724" class="flex items-center gap-4 text-white/60 hover:text-secondary transition-colors text-sm group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-secondary/10">
                    <i class="fas fa-phone text-xs group-hover:text-secondary"></i>
                </div>
                +221 77 375 07 24
            </a>
            <a href="https://wa.me/221773750724" target="_blank"
               class="flex items-center gap-4 text-white/60 hover:text-green-400 transition-colors text-sm group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-green-500/10">
                    <i class="fab fa-whatsapp text-xs group-hover:text-green-400"></i>
                </div>
                WhatsApp direct
            </a>
        </div>
    </div>
    {{-- Overlay --}}
    <div id="mobile-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-md z-[1050] hidden lg:hidden opacity-0 transition-opacity duration-500" aria-hidden="true"></div>

    {{-- ════════════════════ MAIN ════════════════════ --}}
    <main class="pt-20 lg:pt-32">
        @yield('content')
    </main>

    {{-- ════════════════════ FOOTER ════════════════════ --}}
    <footer class="relative bg-[#0b1f10] text-white overflow-hidden">

        {{-- Decorative bg --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/30 rounded-full blur-[120px] translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-secondary/5 rounded-full blur-[80px] -translate-x-1/4 translate-y-1/3"></div>
        </div>

        <div class="container relative z-10 pt-20 pb-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16 pb-16 border-b border-white/10">

                {{-- Brand --}}
                <div class="lg:col-span-1 flex flex-col items-center sm:items-start text-center sm:text-left">
                    <div class="flex items-center justify-center sm:justify-start mb-6">
                        @php
                            $footerLogoPath = App\Models\Setting::get('logo_image');
                            $footerLogoSrc = $footerLogoPath ? asset('storage/' . $footerLogoPath) : asset('Images/logo2.png');
                        @endphp
                        <img src="{{ $footerLogoSrc }}" alt="2IBSN" class="h-20 w-auto" loading="lazy">
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-8">
                        Un établissement d'excellence alliant savoir universel et valeurs islamiques pour former les leaders de demain.
                    </p>
                    <div class="flex gap-3 justify-center sm:justify-start">
                        @foreach(['facebook-f' => '#', 'instagram' => '#', 'whatsapp' => 'https://wa.me/221773750724', 'youtube' => '#'] as $icon => $href)
                        <a href="{{ $href }}" target="{{ Str::startsWith($href, 'http') ? '_blank' : '_self' }}"
                           class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/60 text-sm
                                  transition-all duration-300 hover:bg-secondary hover:text-primary-dark hover:border-secondary hover:-translate-y-1">
                            <i class="fab fa-{{ $icon }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Liens --}}
                <div>
                    <h4 class="font-semibold text-white text-sm uppercase tracking-[2px] mb-6">Navigation</h4>
                    <ul class="space-y-3">
                        @foreach([
                            ['home',       'Accueil'],
                            ['about',      'À propos'],
                            ['programs',   'Nos Programmes'],
                            ['admissions', 'Admissions & Tarifs'],
                            ['contact',    'Contact'],
                        ] as [$route, $label])
                        <li>
                            <a href="{{ route($route) }}" class="text-white/55 text-sm flex items-center gap-2 group transition-colors hover:text-secondary">
                                <span class="w-1 h-1 rounded-full bg-secondary/40 group-hover:bg-secondary transition-colors"></span>
                                {{ $label }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Niveaux --}}
                <div>
                    <h4 class="font-semibold text-white text-sm uppercase tracking-[2px] mb-6">Niveaux</h4>
                    <ul class="space-y-3">
                        @foreach(['Daara (Coranique)', 'Préscolaire', 'Élémentaire', 'Collège (Moyen)'] as $level)
                        <li class="text-white/55 text-sm flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-secondary/40"></span>
                            {{ $level }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-semibold text-white text-sm uppercase tracking-[2px] mb-6">Contact</h4>
                    <div class="space-y-5">
                        <div class="flex gap-3 text-white/60 text-sm">
                            <div class="w-7 h-7 rounded-lg bg-secondary/10 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fas fa-map-marker-alt text-secondary text-xs"></i>
                            </div>
                            <p class="leading-relaxed">Dakar, Sénégal<br>Quartier Liberté 6</p>
                        </div>
                        <div class="flex gap-3 items-center text-white/60 text-sm">
                            <div class="w-7 h-7 rounded-lg bg-secondary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-phone text-secondary text-xs"></i>
                            </div>
                            <a href="tel:+221773750724" class="hover:text-secondary transition-colors">+221 77 375 07 24</a>
                        </div>
                        <div class="flex gap-3 items-center text-white/60 text-sm">
                            <div class="w-7 h-7 rounded-lg bg-secondary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-envelope text-secondary text-xs"></i>
                            </div>
                            <a href="mailto:contact@2ibsn.edu.sn" class="hover:text-secondary transition-colors break-all">contact@2ibsn.edu.sn</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer bottom --}}
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-white/35 text-xs">
                <p>&copy; {{ date('Y') }} {{ App\Models\Setting::get('institute_name', '2IBSN') }}. Tous droits réservés.</p>
                <div class="flex gap-6 flex-wrap justify-center">
                    <a href="#" class="hover:text-white transition-colors">Politique de confidentialité</a>
                    <a href="#" class="hover:text-white transition-colors">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- ════════════ JS ════════════ --}}
    <script>
    (function () {
        const header  = document.getElementById('main-header');
        // Solid header updates
        function updateHeader() {
            const scrolled = window.scrollY > 60;
            header.classList.toggle('scrolled', scrolled);
        }
        updateHeader();
        window.addEventListener('scroll', updateHeader, { passive: true });

        // Mobile menu
        const hamburger   = document.getElementById('hamburger');
        const mobileNav   = document.getElementById('mobile-nav');
        const overlay     = document.getElementById('mobile-overlay');
        const mobileClose = document.getElementById('mobile-close');

        function openMenu() {
            mobileNav.classList.add('open');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
            hamburger.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeMenu() {
            mobileNav.classList.remove('open');
            overlay.classList.remove('opacity-100');
            hamburger.classList.remove('open');
            setTimeout(() => overlay.classList.add('hidden'), 500);
            document.body.style.overflow = '';
        }
        hamburger?.addEventListener('click', openMenu);
        mobileClose?.addEventListener('click', closeMenu);
        overlay?.addEventListener('click', closeMenu);

        // Close on nav link click (mobile)
        document.querySelectorAll('#mobile-nav a').forEach(a => a.addEventListener('click', closeMenu));

        // Scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('animated');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

        document.querySelectorAll('[data-animate]').forEach(el => {
            const siblings = [...el.parentElement.querySelectorAll('[data-animate]')];
            const idx = siblings.indexOf(el);
            if (idx > 0) el.style.transitionDelay = (idx * 90) + 'ms';
            observer.observe(el);
        });

        // Carousel
        const slides     = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        let current = 0, timer;

        function goTo(n) {
            slides[current]?.classList.remove('active');
            indicators[current]?.classList.remove('!bg-secondary', '!w-6');
            current = (n + slides.length) % slides.length;
            slides[current]?.classList.add('active');
            indicators[current]?.classList.add('!bg-secondary', '!w-6');
        }
        function startCarousel() { timer = setInterval(() => goTo(current + 1), 5000); }
        function resetCarousel() { clearInterval(timer); startCarousel(); }

        indicators.forEach((dot, i) => dot.addEventListener('click', () => { goTo(i); resetCarousel(); }));
        if (slides.length > 1) startCarousel();

        // Animated counters
        document.querySelectorAll('[data-count]').forEach(el => {
            const target = parseInt(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            const obs = new IntersectionObserver(([e]) => {
                if (!e.isIntersecting) return;
                let val = 0;
                const step = target / 55;
                const tick = () => {
                    val = Math.min(val + step, target);
                    el.textContent = Math.floor(val) + suffix;
                    if (val < target) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
                obs.disconnect();
            }, { threshold: 0.5 });
            obs.observe(el);
        });
    })();
    </script>

</body>
</html>