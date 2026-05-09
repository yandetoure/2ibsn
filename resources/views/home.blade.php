@extends('layouts.app')

@section('title', '2IBSN – Institut International Baye Barhamou')
@section('meta_description', 'Découvrez l\'Institut 2IBSN : une éducation franco-islamique d\'excellence à Dakar. Daara, Préscolaire, Élémentaire et Collège.')

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO BANNER
══════════════════════════════════════════════════════════ --}}
<section class="relative h-screen min-h-[640px] max-h-[900px] flex items-center justify-center overflow-hidden">

    {{-- Carousel slides --}}
    <div class="carousel-container absolute inset-0 z-0">
        @if($banner = App\Models\Setting::get('banner_image'))
            <div class="carousel-slide active" style="background-image:url('{{ asset('storage/'.$banner) }}')"></div>
            <div class="carousel-slide" style="background-image:url('{{ asset('Images/Header.jpeg') }}')"></div>
        @else
            <div class="carousel-slide active" style="background-image:url('{{ asset('Images/Header.jpeg') }}')"></div>
        @endif
        <div class="carousel-slide" style="background-image:url('{{ asset('Images/header2.jpeg') }}')"></div>
        <div class="carousel-slide" style="background-image:url('{{ asset('Images/header3.jpeg') }}')"></div>
        <div class="carousel-slide" style="background-image:url('{{ asset('Images/header4.jpeg') }}')"></div>
    </div>

    {{-- Gradient overlay --}}
    <div class="absolute inset-0 z-[1]"
         style="background: linear-gradient(160deg, rgba(10,30,15,0.85) 0%, rgba(26,77,46,0.72) 50%, rgba(10,30,15,0.80) 100%);">
    </div>

    {{-- Decorative gold arc --}}
    <div class="absolute right-0 top-0 w-[600px] h-[600px] z-[2] pointer-events-none opacity-20"
         style="background: radial-gradient(circle at top right, #d4af37 0%, transparent 60%);">
    </div>

    {{-- Content --}}
    <div class="relative z-[3] container text-white">
        <div class="max-w-3xl mx-auto text-center">

            {{-- Label --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm text-white/90 text-xs font-semibold uppercase tracking-[3px] mb-8"
                 data-animate="fade-down">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                Fondé en 2016 · Dakar, Sénégal
            </div>

            {{-- Headline --}}
            <h1 class="font-serif font-bold leading-[1.1] mb-6" data-animate="fade-up">
                <span class="block text-2xl sm:text-3xl lg:text-5xl text-white">Éducation d'Excellence</span>
                <span class="block text-2xl sm:text-3xl lg:text-5xl mt-1"
                      style="background:linear-gradient(135deg,#d4af37,#f3cf55,#d4af37);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    &amp; Valeurs Islamiques
                </span>
            </h1>

            {{-- Sub --}}
            <p class="text-[13px] sm:text-sm text-white/75 leading-relaxed max-w-xl mx-auto mb-10" data-animate="fade-up">
                L'Institut International Baye Barhamou forme les leaders de demain à travers un cursus franco-islamique unique, de la maternelle au collège.
            </p>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4" data-animate="fade-up">
                <a href="{{ route('admissions') }}" class="btn-primary w-full sm:w-auto justify-center text-sm sm:text-base">
                    <i class="fas fa-pen-to-square"></i> S'inscrire maintenant
                </a>
                <a href="{{ route('programs') }}" class="btn-outline w-full sm:w-auto justify-center text-sm sm:text-base">
                    <i class="fas fa-book-open"></i> Nos programmes
                </a>
            </div>

            {{-- Stats strip --}}
            <div class="mt-14 grid grid-cols-3 gap-4 max-w-lg mx-auto" data-animate="fade-up">
                @foreach([['8+','Ans d\'expérience'],['500+','Élèves diplômés'],['100%','Taux de réussite']] as [$val, $lab])
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold font-serif" style="-webkit-text-fill-color:#d4af37">{{ $val }}</div>
                    <div class="text-[10px] sm:text-xs text-white/55 uppercase tracking-wider mt-1">{{ $lab }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Carousel indicators --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-[10] flex gap-2">
        @for($i=0;$i<4;$i++)
        <button class="carousel-indicator h-1 rounded-full bg-white/30 transition-all duration-500 {{ $i===0 ? '!bg-secondary !w-6' : 'w-4' }}"
                aria-label="Slide {{ $i+1 }}"></button>
        @endfor
    </div>

    {{-- Scroll cue --}}
    <div class="absolute bottom-8 right-8 z-[10] hidden lg:flex flex-col items-center gap-2">
        <span class="text-white/40 text-[9px] uppercase tracking-[3px] rotate-90 origin-center mb-4">Scroll</span>
        <div class="w-px h-12 bg-gradient-to-b from-white/40 to-transparent"></div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     ATOUTS / WHY US
══════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-16" data-animate="fade-up">
            <span class="section-label">Notre différence</span>
            <h2 class="section-title">Pourquoi choisir <span class="text-secondary">2IBSN</span> ?</h2>
            <div class="section-divider mx-auto"></div>
            <p class="mt-4 text-gray-500 max-w-xl mx-auto leading-relaxed">
                Un modèle éducatif unique qui conjugue rigueur académique et formation spirituelle pour épanouir chaque élève.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach([
                ['📚', 'Double Cursus',         'Programme officiel sénégalais enrichi d\'un enseignement islamique approfondi pour former des citoyens complets.',         'bg-emerald-50',   'text-emerald-700'],
                ['🕌', 'Éducation Coranique',   'Mémorisation du Coran, Tajwid et sciences islamiques dispensés par des maîtres qualifiés dans un cadre bienveillant.', 'bg-amber-50',     'text-amber-700'],
                ['🌟', 'Excellence Académique', 'Suivi personnalisé, classes à effectifs réduits et méthodes pédagogiques innovantes pour garantir la réussite.',        'bg-blue-50',      'text-blue-700'],
                ['🤝', 'Internat & Externat',   'Options d\'hébergement flexibles avec encadrement continu pour les élèves internes, dans un environnement sécurisé.',   'bg-purple-50',    'text-purple-700'],
                ['🏆', 'Taux de Réussite 100%', 'Nos élèves brillent aux examens d\'État grâce à un encadrement rigoureux et des révisions intensives.',                  'bg-rose-50',      'text-rose-700'],
                ['🌍', 'Ouverture au Monde',    'Enseignement bilingue Français-Arabe pour préparer nos élèves aux défis d\'un monde interconnecté.',                    'bg-teal-50',      'text-teal-700'],
            ] as $i => [$emoji, $title, $desc, $bg, $color])
            <div class="card p-8 group" data-animate="fade-up">
                <div class="w-14 h-14 rounded-2xl {{ $bg }} flex items-center justify-center text-2xl mb-6 transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                    {{ $emoji }}
                </div>
                <h3 class="font-serif font-bold text-xl text-gray-900 mb-3">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                <div class="mt-6 flex items-center gap-2 text-[10px] font-semibold {{ $color }} opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span>En savoir plus</span>
                    <i class="fas fa-arrow-right text-[9px]"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     STATS BAND
══════════════════════════════════════════════════════════ --}}
<section class="relative py-20 overflow-hidden"
         style="background: linear-gradient(135deg, #1a4d2e 0%, #0f3320 100%);">

    {{-- Decorative elements --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/4 w-64 h-64 rounded-full bg-secondary/5 blur-3xl -translate-y-1/2"></div>
        <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-white/3 blur-[80px]"></div>
    </div>
    {{-- Grid pattern --}}
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <div class="container relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            @foreach([
                ['8',  '+', 'Années d\'expérience', 'fas fa-history'],
                ['500','+', 'Élèves diplômés',      'fas fa-user-graduate'],
                ['25', '+', 'Enseignants qualifiés', 'fas fa-chalkboard-teacher'],
                ['100','%', 'Taux de réussite',      'fas fa-trophy'],
            ] as [$num, $suffix, $label, $icon])
            <div class="text-center" data-animate="zoom-in">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-secondary/10 border border-secondary/20 mb-4">
                    <i class="{{ $icon }} text-secondary text-base"></i>
                </div>
                <div class="font-serif font-bold text-4xl sm:text-4xl text-secondary mb-2">
                    <span data-count="{{ $num }}" data-suffix="{{ $suffix }}">0{{ $suffix }}</span>
                </div>
                <p class="text-white/55 text-[10px] uppercase tracking-[2px]">{{ $label }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     ABOUT PREVIEW
══════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#f7f5f0]">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image column --}}
            <div class="relative order-1 lg:order-1" data-animate="fade-right">
                {{-- Main image --}}
                <div class="relative rounded-3xl overflow-hidden shadow-[0_32px_64px_rgba(0,0,0,0.15)] aspect-[4/5] sm:aspect-[4/3]">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.14.jpeg') }}"
                         alt="Élèves de 2IBSN"
                         class="w-full h-full object-cover"
                         loading="lazy">
                    {{-- Overlay tint --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                </div>

                {{-- Floating badge --}}
                <div class="absolute -bottom-6 -right-4 sm:-right-8 bg-white rounded-2xl shadow-[0_16px_48px_rgba(0,0,0,0.12)] px-5 py-4 float-anim">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-secondary/15 flex items-center justify-center">
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-xs">Fondé en 2016</div>
                            <div class="text-gray-400 text-[10px]">8 ans d'excellence</div>
                        </div>
                    </div>
                </div>

                {{-- Decorative square --}}
                <div class="absolute -top-5 -left-5 w-24 h-24 rounded-2xl border-2 border-secondary/20 -z-10"></div>
            </div>

            {{-- Text column --}}
            <div class="order-2 lg:order-2" data-animate="fade-left">
                <span class="section-label">Notre histoire</span>
                <h2 class="section-title mb-4">
                    Former les leaders<br>
                    <span class="text-secondary italic">de demain</span>
                </h2>
                <div class="section-divider"></div>

                <p class="text-gray-600 leading-relaxed mb-4">
                    Fondé le 05 Septembre 2016, l'Institut International Baye Barhamou (2IBSN) est un établissement d'enseignement privé, internat et externat, situé à Dakar.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    La principale préoccupation de notre direction est d'ouvrir nos élèves tant aux fondamentaux du savoir universel qu'à la pratique éclairée de l'Islam, pour en faire des citoyens accomplis.
                </p>

                {{-- Checkpoints --}}
                <div class="space-y-3 mb-10">
                    @foreach(['Curriculum officiel du Sénégal + formation islamique', 'Encadrement par des enseignants diplômés et expérimentés', 'Internat sécurisé avec suivi 24h/24'] as $point)
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-secondary/15 flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fas fa-check text-secondary text-[8px]"></i>
                        </div>
                        <p class="text-gray-600 text-xs leading-relaxed">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('about') }}" class="btn-primary text-sm">
                    Découvrir l'institut <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     PROGRAMMES CARDS
══════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="container">

        <div class="text-center mb-16" data-animate="fade-up">
            <span class="section-label">Nos cursus</span>
            <h2 class="section-title">Des programmes pour <span class="text-secondary">chaque âge</span></h2>
            <div class="section-divider mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
            @foreach([
                ['Daara', 'Enseignement Coranique', '📖', 'Mémorisation du Coran et sciences islamiques.', 'bg-amber-500',    'text-amber-600', 'bg-amber-50'],
                ['Préscolaire','PS · MS · GS',      '🌱', 'Éveil, socialisation et initiation à la lecture.', 'bg-green-500',  'text-green-700', 'bg-green-50'],
                ['Élémentaire','CI · CP · CE1 · CE2 · CM1 · CM2','📐','Programme officiel + Arabe renforcé.','bg-blue-500','text-blue-700','bg-blue-50'],
                ['Collège',   '6ème → 3ème',        '🎓', 'Préparation au BFEM avec suivi personnalisé.', 'bg-purple-500',    'text-purple-700', 'bg-purple-50'],
            ] as [$title, $sub, $emoji, $desc, $accentBg, $accentText, $lightBg])
            <div class="group relative bg-white border border-gray-100 rounded-3xl overflow-hidden
                        shadow-[0_4px_24px_rgba(0,0,0,0.05)] transition-all duration-500
                        hover:-translate-y-3 hover:shadow-[0_24px_60px_rgba(0,0,0,0.12)]
                        hover:border-transparent" data-animate="fade-up">
                {{-- Top accent --}}
                <div class="h-1.5 {{ $accentBg }} transition-all duration-500 group-hover:h-2"></div>

                <div class="p-7">
                    {{-- Icon --}}
                    <div class="w-12 h-12 rounded-2xl {{ $lightBg }} flex items-center justify-center text-xl mb-6
                                transition-transform duration-300 group-hover:scale-110">
                        {{ $emoji }}
                    </div>

                    <h3 class="font-serif font-bold text-xl mb-1 text-gray-900">{{ $title }}</h3>
                    <p class="text-xs font-semibold {{ $accentText }} uppercase tracking-wider mb-4">{{ $sub }}</p>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>

                    <a href="{{ route('programs') }}" class="mt-6 inline-flex items-center gap-2 text-[10px] font-semibold {{ $accentText }} opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Voir le détail <i class="fas fa-arrow-right text-[8px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('admissions') }}" class="btn-primary">
                Voir les tarifs & inscriptions <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     GALLERY
══════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#f7f5f0]">
    <div class="container">

        <div class="text-center mb-16" data-animate="fade-up">
            <span class="section-label">Galerie</span>
            <h2 class="section-title">La vie à <span class="text-secondary">l'Institut</span></h2>
            <div class="section-divider mx-auto"></div>
        </div>

        @php
        $galleryImages = [
            'WhatsApp Image 2025-12-05 at 21.16.11.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.12.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.13.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.15.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.16.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.17.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.18.jpeg',
            'WhatsApp Image 2025-12-05 at 21.16.19.jpeg',
        ];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($galleryImages as $i => $img)
            <div class="group relative overflow-hidden rounded-2xl aspect-square shadow-sm cursor-pointer"
                 data-animate="zoom-in"
                 style="transition-delay:{{ $i * 60 }}ms">
                <img src="{{ asset('Images/'.$img) }}"
                     loading="lazy"
                     alt="2IBSN vie scolaire"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/50 transition-all duration-500 flex items-center justify-center">
                    <div class="text-white text-3xl scale-0 group-hover:scale-100 transition-transform duration-300 delay-75">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     CTA BANNER
══════════════════════════════════════════════════════════ --}}
<section class="relative py-20 overflow-hidden"
         style="background: linear-gradient(135deg, #d4af37 0%, #e8c84a 50%, #b8962e 100%);">

    <div class="absolute inset-0 pointer-events-none opacity-10"
         style="background-image:url('{{ asset('Images/Header.jpeg') }}'); background-size:cover; background-position:center; mix-blend-mode:overlay;">
    </div>

    <div class="container relative z-10 text-center" data-animate="fade-up">
        <h2 class="font-serif font-bold text-3xl sm:text-4xl lg:text-5xl text-primary-dark mb-4">
            Rejoignez la famille 2IBSN
        </h2>
        <p class="text-primary/80 text-base sm:text-lg mb-10 max-w-xl mx-auto leading-relaxed">
            Les inscriptions pour l'année scolaire sont ouvertes. Contactez-nous dès maintenant pour plus d'informations.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('admissions') }}"
               class="inline-flex items-center gap-2 px-8 py-4 bg-primary-dark text-white font-semibold rounded-full text-sm uppercase tracking-wider
                      transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl w-full sm:w-auto justify-center">
                <i class="fas fa-file-alt"></i> Voir les inscriptions
            </a>
            <a href="https://wa.me/221773750724" target="_blank"
               class="inline-flex items-center gap-2 px-8 py-4 bg-white/90 text-primary-dark font-semibold rounded-full text-sm uppercase tracking-wider
                      transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:bg-white w-full sm:w-auto justify-center">
                <i class="fab fa-whatsapp text-green-600"></i> WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection