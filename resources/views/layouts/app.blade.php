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
    <header id="main-header" class="main-header fixed w-full top-0 z-[1000] transition-all duration-500 bg-white/95 backdrop-blur-xl border-b border-black/[0.04]">
        <div class="container">
            <div id="nav-container" class="nav-container flex items-center justify-between h-20 transition-all duration-300">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                    @if($logo = App\Models\Setting::get('logo_image'))
                        <img src="{{ asset('storage/' . $logo) }}" alt="2IBSN Logo" class="h-12 w-auto object-contain" loading="eager">
                    @else
                        <img src="{{ asset('Images/logo.png') }}" alt="2IBSN Logo" class="h-12 w-auto object-contain" loading="eager">
                    @endif
                    <div class="flex flex-col leading-none">
                        <span class="font-serif text-xl font-bold text-primary tracking-tight">{{ App\Models\Setting::get('institute_name', '2IBSN') }}</span>
                        <span class="hidden sm:block text-[9px] text-gray-400 uppercase tracking-[2px] mt-0.5">Institut International Baye Barhamou</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>
                    <a href="{{ route('programs') }}" class="nav-link {{ request()->routeIs('programs') ? 'active' : '' }}">Programmes</a>
                    <a href="{{ route('admissions') }}" class="nav-link {{ request()->routeIs('admissions') ? 'active' : '' }}">Admissions</a>
                    <a href="{{ route('contact') }}" class="btn-primary">Nous contacter</a>
                </nav>

                {{-- Hamburger --}}
                <button id="hamburger" class="lg:hidden flex flex-col justify-center gap-[6px] w-8 h-8 cursor-pointer bg-transparent border-0 p-0" aria-label="Menu">
                    <span class="block h-0.5 w-6 bg-primary rounded-full transition-all duration-300 origin-center"></span>
                    <span class="block h-0.5 w-6 bg-primary rounded-full transition-all duration-300"></span>
                    <span class="block h-0.5 w-6 bg-primary rounded-full transition-all duration-300 origin-center"></span>
                </button>
            </div>
        </div>
    </header>

    {{-- ════════════ MOBILE NAV ════════════ --}}
    <div id="mobile-nav" class="fixed top-0 right-0 h-screen w-full max-w-sm bg-primary z-[999] flex flex-col lg:hidden shadow-2xl">
        {{-- Close bar --}}
        <div class="flex items-center justify-between px-6 h-20 border-b border-white/10">
            <span class="font-serif text-xl font-bold text-white">Menu</span>
            <button id="mobile-close" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white" aria-label="Fermer">
                <i class="fas fa-times"></i>
            </button>
        </div>
        {{-- Links --}}
        <nav class="flex flex-col px-6 py-8 gap-2 flex-1">
            @foreach([
                ['home',       'Accueil',    'fas fa-home'],
                ['about',      'À propos',   'fas fa-university'],
                ['programs',   'Programmes', 'fas fa-book-open'],
                ['admissions', 'Admissions', 'fas fa-file-alt'],
                ['contact',    'Contact',    'fas fa-envelope'],
            ] as [$route, $label, $icon])
            <a href="{{ route($route) }}"
               class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-medium transition-all duration-200
                       {{ request()->routeIs($route) ? 'bg-secondary text-primary-dark' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <i class="{{ $icon }} w-5 text-center"></i>
                {{ $label }}
            </a>
            @endforeach
        </nav>
        {{-- Contact quick --}}
        <div class="px-6 pb-8 space-y-3">
            <div class="flex items-center gap-3 text-white/60 text-sm">
                <i class="fas fa-phone text-secondary"></i>
                <span>+221 77 375 07 24</span>
            </div>
            <div class="flex items-center gap-3 text-white/60 text-sm">
                <i class="fas fa-envelope text-secondary"></i>
                <span>contact@2ibsn.edu.sn</span>
            </div>
        </div>
    </div>
    {{-- Mobile overlay --}}
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-[998] hidden lg:hidden" aria-hidden="true"></div>

    {{-- ════════════════════ MAIN ════════════════════ --}}
    <main class="pt-20">
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
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('Images/logo2.png') }}" alt="2IBSN" class="h-14 w-auto brightness-0 invert opacity-90" loading="lazy">
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-8">
                        Un établissement d'excellence alliant savoir universel et valeurs islamiques pour former les leaders de demain.
                    </p>
                    <div class="flex gap-3">
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
        // Header scroll
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 50);
        }, { passive: true });

        // Mobile menu
        const hamburger   = document.getElementById('hamburger');
        const mobileNav   = document.getElementById('mobile-nav');
        const overlay     = document.getElementById('mobile-overlay');
        const mobileClose = document.getElementById('mobile-close');

        function openMenu() {
            mobileNav.classList.add('open');
            overlay.classList.remove('hidden');
            hamburger.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeMenu() {
            mobileNav.classList.remove('open');
            overlay.classList.add('hidden');
            hamburger.classList.remove('open');
            document.body.style.overflow = '';
        }
        hamburger?.addEventListener('click', openMenu);
        mobileClose?.addEventListener('click', closeMenu);
        overlay?.addEventListener('click', closeMenu);

        // Scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('animated');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('[data-animate]').forEach((el, i) => {
            // Stagger children in the same parent
            const siblings = [...el.parentElement.querySelectorAll('[data-animate]')];
            const idx = siblings.indexOf(el);
            if (idx > 0) el.style.transitionDelay = (idx * 100) + 'ms';
            observer.observe(el);
        });

        // Carousel
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        let current = 0, timer;

        function goTo(n) {
            slides[current]?.classList.remove('active');
            indicators[current]?.classList.remove('!bg-secondary', '!w-6');
            current = (n + slides.length) % slides.length;
            slides[current]?.classList.add('active');
            indicators[current]?.classList.add('!bg-secondary', '!w-6');
        }
        function start() { timer = setInterval(() => goTo(current + 1), 5000); }
        function reset()  { clearInterval(timer); start(); }

        indicators.forEach((dot, i) => dot.addEventListener('click', () => { goTo(i); reset(); }));
        if (slides.length > 1) start();

        // Animated counters
        document.querySelectorAll('[data-count]').forEach(el => {
            const target = parseInt(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            const obs = new IntersectionObserver(([e]) => {
                if (!e.isIntersecting) return;
                let start = 0;
                const step = target / 60;
                const tick = () => {
                    start = Math.min(start + step, target);
                    el.textContent = Math.floor(start) + suffix;
                    if (start < target) requestAnimationFrame(tick);
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