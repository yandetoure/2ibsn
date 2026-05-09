@extends('layouts.app')

@section('title', 'Admissions & Tarifs – 2IBSN')
@section('meta_description', 'Consultez les frais de scolarité et les modalités d\'inscription à l\'Institut 2IBSN pour l\'année scolaire.')

@section('content')

{{-- Page Hero --}}
<div class="page-hero py-20 sm:py-28">
    <div class="container relative z-10 text-center">
        <span class="section-label" data-animate="fade-down">Rejoignez-nous</span>
        <h1 class="font-serif font-bold text-3xl sm:text-4xl lg:text-5xl text-white mt-2 mb-4" data-animate="fade-up">
            Admissions & Inscriptions
        </h1>
        <p class="text-white/65 text-base sm:text-lg uppercase tracking-widest font-light" data-animate="fade-up">
            Grille tarifaire · Dossier · Informations
        </p>
    </div>
</div>

<section class="py-24 bg-[#f7f5f0]">
    <div class="container">

        {{-- Info alert --}}
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 sm:p-8 flex gap-4 mb-16" data-animate="fade-up">
            <div class="w-10 h-10 rounded-xl bg-secondary/15 flex items-center justify-center shrink-0 mt-0.5">
                <i class="fas fa-info-circle text-secondary"></i>
            </div>
            <div>
                <h3 class="font-semibold text-amber-900 text-base mb-1">Inscriptions ouvertes</h3>
                <p class="text-amber-700 text-sm leading-relaxed">
                    L'inscription est ouverte pour <strong>l'Internat</strong>, <strong>l'Externat</strong> et les <strong>cours de vacances</strong>. Contactez-nous pour réserver votre place.
                </p>
            </div>
        </div>

        {{-- Title --}}
        <div class="text-center mb-12" data-animate="fade-up">
            <span class="section-label">Frais de scolarité</span>
            <h2 class="section-title">Grille Tarifaire <span class="text-secondary">Externat</span></h2>
            <div class="section-divider mx-auto"></div>
            <p class="mt-4 text-gray-500 text-sm">Franco-Arabe · Année scolaire en cours</p>
        </div>

        {{-- Tables --}}
        <div class="space-y-12">

            {{-- Préscolaire --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100" data-animate="fade-up">
                <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center text-base">🌱</div>
                    <h3 class="font-serif font-bold text-base text-gray-900">Préscolaire</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Niveau</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Inscription</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Mensualité</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Inscr. Demi-Pension</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Mensualité D-P</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach([
                                ['Petite Section',  '24 000 F', '12 000 F', '24 000 F', '20 000 F'],
                                ['Moyenne Section', '24 000 F', '12 000 F', '24 000 F', '20 000 F'],
                                ['Grande Section',  '24 000 F', '12 000 F', '24 000 F', '20 000 F'],
                            ] as $row)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $row[0] }}</td>
                                @foreach(array_slice($row, 1) as $val)
                                <td class="px-6 py-4 text-gray-600">{{ $val }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Élémentaire --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100" data-animate="fade-up">
                <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center text-base">📐</div>
                    <h3 class="font-serif font-bold text-base text-gray-900">Élémentaire (CI – CM2)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Niveau</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Inscription</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Mensualité</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Inscr. D-Pension</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Mensualité D-P</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php
                            $levels = [
                                ['CI',  '25 000 F', '12 000 F', '25 000 F', '25 000 F'],
                                ['CP',  '25 000 F', '12 000 F', '25 000 F', '25 000 F'],
                                ['CE1', '25 000 F', '12 000 F', '29 000 F', '29 000 F'],
                                ['CE2', '25 000 F', '12 000 F', '29 000 F', '29 000 F'],
                                ['CM1', '25 000 F', '12 000 F', '33 000 F', '33 000 F'],
                                ['CM2', '25 000 F', '12 000 F', '33 000 F', '33 000 F'],
                            ];
                            @endphp
                            @foreach($levels as $row)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $row[0] }}</td>
                                @foreach(array_slice($row, 1) as $val)
                                <td class="px-6 py-4 text-gray-600">{{ $val }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Collège --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100" data-animate="fade-up">
                <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-purple-100 flex items-center justify-center text-base">🎓</div>
                    <h3 class="font-serif font-bold text-base text-gray-900">Collège / Moyen Secondaire</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Niveau</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Inscription</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Mensualité</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach([
                                ['6ème', '34 000 F', '17 000 F'],
                                ['5ème', '34 000 F', '17 000 F'],
                                ['4ème', '44 000 F', '19 000 F'],
                                ['3ème', '50 000 F', '25 000 F'],
                            ] as $row)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $row[0] }}</td>
                                @foreach(array_slice($row, 1) as $val)
                                <td class="px-6 py-4 text-gray-600">{{ $val }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Notes + Dossier --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-12">

            {{-- Notes --}}
            <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100" data-animate="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-info-circle text-amber-500"></i>
                    </div>
                    <h3 class="font-serif font-bold text-base text-gray-900">Notes Importantes</h3>
                </div>
                <ul class="space-y-4">
                    @foreach([
                        ['<strong>Demi-Pension :</strong> L\'enfant reste toute la journée à l\'école et prend son déjeuner sur place (pris en charge par l\'école).', 'text-amber-500'],
                        ['Aucune somme perçue n\'est remboursable.', 'text-gray-400'],
                        ['Les frais d\'inscription ne sont ni remboursables ni échangeables.', 'text-gray-400'],
                    ] as [$note, $dotColor])
                    <li class="flex gap-3 items-start">
                        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }} mt-2 shrink-0"></span>
                        <p class="text-gray-600 text-sm leading-relaxed">{!! $note !!}</p>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Dossier --}}
            <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100" data-animate="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <i class="fas fa-folder-open text-primary"></i>
                    </div>
                    <h3 class="font-serif font-bold text-base text-gray-900">Dossier à fournir</h3>
                </div>
                <div class="space-y-4">
                    @foreach([
                        ['📄', 'État Civil', '2 pièces d\'État Civil à jour'],
                        ['📸', 'Photos d\'identité', '4 photos d\'identité récentes'],
                    ] as [$emoji, $title, $desc])
                    <div class="flex gap-4 items-center p-4 bg-gray-50 rounded-2xl">
                        <div class="text-2xl shrink-0">{{ $emoji }}</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $title }}</h4>
                            <p class="text-gray-500 text-xs mt-0.5">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="mt-12 text-center" data-animate="fade-up">
            <a href="{{ route('contact') }}" class="btn-primary">
                <i class="fas fa-phone"></i> Contacter pour s'inscrire
            </a>
        </div>

    </div>
</section>

@endsection