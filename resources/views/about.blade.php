@extends('layouts.app')

@section('title', 'À Propos – 2IBSN')
@section('meta_description', 'Découvrez l\'histoire, la mission et les valeurs de l\'Institut International Baye Barhamou (2IBSN) à Dakar.')

@section('content')

{{-- Page Hero --}}
<div class="page-hero py-20 sm:py-28">
    <div class="container relative z-10 text-center">
        <span class="section-label" data-animate="fade-down">Institut 2IBSN</span>
        <h1 class="font-serif font-bold text-3xl sm:text-4xl lg:text-5xl text-white mt-2 mb-4" data-animate="fade-up">
            À Propos de l'Institut
        </h1>
        <p class="text-white/65 text-base sm:text-lg uppercase tracking-widest font-light" data-animate="fade-up">
            Histoire · Mission · Vision
        </p>
    </div>
</div>

{{-- History --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center mb-24">

            {{-- Text --}}
            <div data-animate="fade-right">
                <span class="section-label">Depuis 2016</span>
                <h2 class="section-title mb-4">Notre <span class="text-secondary">Histoire</span></h2>
                <div class="section-divider"></div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Fondé le 05 Septembre 2016, l'Institut International Baye Barhamou (2IBSN) est un établissement d'enseignement privé, internat et externat, implanté à Dakar.
                </p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Depuis sa création, l'école s'est engagée à fournir un environnement d'apprentissage stimulant et bienveillant, où chaque élève est encouragé à atteindre son plein potentiel académique et personnel.
                </p>
            </div>

            {{-- Image --}}
            <div class="relative" data-animate="fade-left">
                <div class="absolute -top-4 -left-4 w-full h-full rounded-3xl border-2 border-secondary/20 -z-10"></div>
                <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.14 (1).jpeg') }}"
                     alt="Institut 2IBSN"
                     class="w-full rounded-3xl shadow-[0_24px_60px_rgba(0,0,0,0.12)] object-cover aspect-[16/10]"
                     loading="lazy">
            </div>
        </div>

        {{-- Mission / Vision / Valeurs --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['🎯', 'Notre Mission',   'bg-primary', 'text-white',
                 'Offrir une éducation complète alliant l\'enseignement officiel du Sénégal et une solide formation islamique, pour former des citoyens responsables et éclairés.'],
                ['👁️', 'Notre Vision',    'bg-secondary', 'text-primary-dark',
                 'Devenir un modèle d\'excellence éducative en Afrique de l\'Ouest, reconnu pour la qualité de son enseignement bilingue Français-Arabe et ses valeurs éthiques.'],
                ['🤝', 'Nos Valeurs',     'bg-gray-900', 'text-white',
                 'Excellence, Intégrité, Respect et Solidarité sont les piliers de notre communauté éducative, guidant chacune de nos actions au quotidien.'],
            ] as [$emoji, $title, $bg, $text, $desc])
            <div class="group {{ $bg }} rounded-3xl p-8 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_24px_60px_rgba(0,0,0,0.15)]" data-animate="fade-up">
                <div class="text-4xl mb-6">{{ $emoji }}</div>
                <h3 class="font-serif font-bold text-lg {{ $text }} mb-4">{{ $title }}</h3>
                <p class="{{ $bg === 'bg-secondary' ? 'text-primary/80' : 'text-white/70' }} text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Director --}}
<section class="py-24 bg-[#f7f5f0]">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-[2rem] shadow-[0_16px_48px_rgba(0,0,0,0.07)] overflow-hidden" data-animate="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-[260px_1fr]">

                    {{-- Photo panel --}}
                    <div class="relative bg-primary flex flex-col items-center justify-center py-12 px-8">
                        <div class="absolute inset-0 opacity-10"
                             style="background: radial-gradient(circle at top right, #d4af37 0%, transparent 60%);"></div>
                        <div class="relative w-36 h-36 rounded-full border-4 border-secondary/30 overflow-hidden shadow-xl mb-6">
                            <img src="{{ asset('Images/avatar.png') }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Madiara+Ndiaye&background=d4af37&color=1a4d2e&size=200'"
                                 alt="Directeur"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="text-center text-white">
                            <p class="font-bold text-lg font-serif">Madiara Ndiaye</p>
                            <p class="text-secondary text-xs uppercase tracking-[2px] mt-1">Directeur de l'Institut</p>
                        </div>
                    </div>

                    {{-- Quote --}}
                    <div class="p-10 sm:p-14 flex flex-col justify-center">
                        <div class="text-6xl text-secondary/20 font-serif leading-none mb-4">"</div>
                        <h3 class="font-serif font-bold text-lg text-primary mb-6">Le Mot du Directeur</h3>
                        <blockquote class="text-gray-600 leading-[1.8] text-sm italic font-serif">
                            La principale préoccupation du dirigeant de 2IBSN est d'ouvrir ses élèves tant aux fondamentaux du savoir universel qu'à la pratique éclairée de l'Islam, pour en faire des êtres vertueux, compétents et utiles à leur société.
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection