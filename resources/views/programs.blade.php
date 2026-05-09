@extends('layouts.app')

@section('title', 'Nos Programmes – 2IBSN')
@section('meta_description', 'Découvrez les programmes scolaires de l\'Institut 2IBSN : Daara, Préscolaire, Élémentaire et Collège.')

@section('content')

{{-- Page Hero --}}
<div class="page-hero py-20 sm:py-28">
    <div class="container relative z-10 text-center">
        <span class="section-label" data-animate="fade-down">Cursus scolaires</span>
        <h1 class="font-serif font-bold text-2xl sm:text-3xl lg:text-4xl text-white mt-2 mb-4" data-animate="fade-up">
            Nos Programmes
        </h1>
        <p class="text-white/65 text-base sm:text-lg uppercase tracking-widest font-light" data-animate="fade-up">
            Un cursus complet de la maternelle au collège
        </p>
    </div>
</div>

{{-- Programs --}}
<section class="py-24 bg-white">
    <div class="container">

        <div class="text-center mb-16" data-animate="fade-up">
            <span class="section-label">Niveaux d'enseignement</span>
            <h2 class="section-title">Un parcours pour <span class="text-secondary">chaque élève</span></h2>
            <div class="section-divider mx-auto"></div>
            <p class="mt-4 text-gray-500 max-w-xl mx-auto text-sm leading-relaxed">
                Du Daara à la classe de 3ème, nous accompagnons chaque enfant dans sa croissance académique et spirituelle.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach([
                [
                    'icon'  => '📖',
                    'title' => 'Daara',
                    'sub'   => 'Enseignement Coranique',
                    'color' => 'amber',
                    'desc'  => 'Un Daara dédié à l\'enseignement coranique pour aider les enfants à mémoriser le Saint Coran en un temps record, dans le respect des règles du Tajwid.',
                    'items' => ['Mémorisation du Coran (Hifz)', 'Tajwid – règles de lecture', 'Sciences islamiques de base', 'Éthique et morale islamique'],
                    'badge' => 'Tous âges',
                ],
                [
                    'icon'  => '🌱',
                    'title' => 'Préscolaire',
                    'sub'   => 'Petite · Moyenne · Grande Section',
                    'color' => 'green',
                    'desc'  => 'L\'éveil et la socialisation dans un cadre bienveillant et stimulant. Nous préparons les enfants à la lecture, au calcul et à la vie en communauté.',
                    'items' => ['Apprentissage ludique et créatif', 'Initiation à la lecture et aux chiffres', 'Éveil religieux et spirituel', 'Développement de la motricité'],
                    'badge' => '3 – 6 ans',
                ],
                [
                    'icon'  => '📐',
                    'title' => 'Élémentaire',
                    'sub'   => 'CI · CP · CE1 · CE2 · CM1 · CM2',
                    'color' => 'blue',
                    'desc'  => 'Du CI au CM2, un programme rigoureux et complet conforme au curriculum officiel du Sénégal, enrichi d\'un enseignement renforcé de la langue arabe.',
                    'items' => ['Français, Mathématiques, Sciences', 'Histoire & Géographie du Sénégal', 'Arabe renforcé et Coran', 'Activités parascolaires'],
                    'badge' => '6 – 12 ans',
                ],
                [
                    'icon'  => '🎓',
                    'title' => 'Collège (Moyen)',
                    'sub'   => '6ème · 5ème · 4ème · 3ème',
                    'color' => 'purple',
                    'desc'  => 'Préparation intensive au Brevet de Fin d\'Études Moyennes (BFEM) avec un suivi personnalisé et des cours de soutien réguliers.',
                    'items' => ['Enseignement général complet', 'Préparation aux examens d\'État', 'Soutien scolaire individuel', 'Formation morale continue'],
                    'badge' => '12 – 16 ans',
                ],
            ] as $prog)
            @php
            $colors = [
                'amber'  => ['ring' => 'ring-amber-200',  'bg' => 'bg-amber-50',   'badge' => 'bg-amber-100 text-amber-700', 'bar' => 'bg-amber-400', 'check' => 'text-amber-500'],
                'green'  => ['ring' => 'ring-green-200',  'bg' => 'bg-green-50',   'badge' => 'bg-green-100 text-green-700', 'bar' => 'bg-green-500', 'check' => 'text-green-500'],
                'blue'   => ['ring' => 'ring-blue-200',   'bg' => 'bg-blue-50',    'badge' => 'bg-blue-100 text-blue-700',   'bar' => 'bg-blue-500',  'check' => 'text-blue-500'],
                'purple' => ['ring' => 'ring-purple-200', 'bg' => 'bg-purple-50',  'badge' => 'bg-purple-100 text-purple-700','bar'=> 'bg-purple-500','check' => 'text-purple-500'],
            ][$prog['color']];
            @endphp
            <div class="group bg-white rounded-3xl overflow-hidden border border-gray-100
                        shadow-[0_4px_24px_rgba(0,0,0,0.05)] transition-all duration-500
                        hover:-translate-y-2 hover:shadow-[0_24px_60px_rgba(0,0,0,0.10)]
                        hover:{{ $colors['ring'] }} hover:ring-2" data-animate="fade-up">
                {{-- Top bar --}}
                <div class="h-1.5 {{ $colors['bar'] }}"></div>

                <div class="p-8 sm:p-10">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl {{ $colors['bg'] }} flex items-center justify-center text-3xl
                                        transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                {{ $prog['icon'] }}
                            </div>
                            <div>
                                <h3 class="font-serif font-bold text-lg text-gray-900">{{ $prog['title'] }}</h3>
                                <p class="text-[10px] text-gray-400 font-medium mt-0.5">{{ $prog['sub'] }}</p>
                            </div>
                        </div>
                        <span class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold {{ $colors['badge'] }}">{{ $prog['badge'] }}</span>
                    </div>

                    <p class="text-gray-500 text-xs leading-relaxed mb-6">{{ $prog['desc'] }}</p>

                    <div class="space-y-2.5">
                        @foreach($prog['items'] as $item)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle {{ $colors['check'] }} text-sm shrink-0"></i>
                            <span class="text-gray-600 text-xs">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="mt-16 text-center bg-primary rounded-3xl p-12 sm:p-16 relative overflow-hidden" data-animate="fade-up">
            <div class="absolute inset-0 opacity-10"
                 style="background: radial-gradient(circle at top right, #d4af37 0%, transparent 60%);"></div>
            <div class="relative z-10">
                <h3 class="font-serif font-bold text-xl sm:text-2xl text-white mb-4">Intéressé par nos programmes ?</h3>
                <p class="text-white/65 text-sm leading-relaxed mb-8 max-w-lg mx-auto">
                    Consultez notre grille tarifaire et les modalités d'inscription pour l'année scolaire en cours.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('admissions') }}" class="btn-primary justify-center">
                        <i class="fas fa-file-alt"></i> Voir les tarifs
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline justify-center">
                        <i class="fas fa-envelope"></i> Nous contacter
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection