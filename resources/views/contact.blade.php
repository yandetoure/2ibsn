@extends('layouts.app')

@section('title', 'Contact – 2IBSN')
@section('meta_description', 'Contactez l\'Institut 2IBSN pour toute information sur les inscriptions, programmes et tarifs.')

@section('content')

{{-- Page Hero --}}
<div class="page-hero py-20 sm:py-28">
    <div class="container relative z-10 text-center">
        <span class="section-label" data-animate="fade-down">Besoin d'infos ?</span>
        <h1 class="font-serif font-bold text-4xl sm:text-5xl lg:text-6xl text-white mt-2 mb-4" data-animate="fade-up">
            Contactez-nous
        </h1>
        <p class="text-white/65 text-base sm:text-lg uppercase tracking-widest font-light" data-animate="fade-up">
            Nous sommes à votre écoute
        </p>
    </div>
</div>

<section class="py-24 bg-[#f7f5f0]">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">

            {{-- Contact info --}}
            <div data-animate="fade-right">
                <span class="section-label">Informations</span>
                <h2 class="section-title mb-4">Nos <span class="text-secondary">coordonnées</span></h2>
                <div class="section-divider"></div>
                <p class="text-gray-500 text-sm leading-relaxed mb-10">
                    N'hésitez pas à nous contacter par téléphone, WhatsApp ou email. Notre équipe vous répondra dans les plus brefs délais.
                </p>

                <div class="space-y-4">
                    @foreach([
                        ['fas fa-map-marker-alt', 'Adresse',              'Institut International Baye Barhamou (2IBSN)<br>Dakar, Sénégal', '#', null],
                        ['fas fa-phone',          'Téléphone / WhatsApp', '+221 77 375 07 24 · +221 77 486 27 27', 'tel:+221773750724', null],
                        ['fas fa-envelope',       'Email',                'institutinternationalbayebarha@gmail.com', 'mailto:institutinternationalbayebarha@gmail.com', null],
                        ['fab fa-whatsapp',       'WhatsApp direct',      'Cliquez pour nous écrire', 'https://wa.me/221773750724', '_blank'],
                        ['fas fa-user',           'Directeur',            'Madiara Ndiaye', '#', null],
                    ] as [$icon, $label, $value, $href, $target])
                    <a href="{{ $href }}" @if($target) target="{{ $target }}" @endif
                       class="group flex items-center gap-4 p-5 bg-white rounded-2xl border border-gray-100
                              shadow-[0_2px_12px_rgba(0,0,0,0.04)] transition-all duration-300
                              hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,0.08)] hover:border-secondary/20">
                        <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center shrink-0
                                    transition-all duration-300 group-hover:bg-secondary group-hover:text-primary-dark">
                            <i class="{{ $icon }} text-primary group-hover:text-primary-dark transition-colors text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">{{ $label }}</p>
                            <p class="text-gray-800 text-sm font-medium">{!! $value !!}</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 text-xs ml-auto group-hover:text-secondary transition-colors"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Contact form --}}
            <div data-animate="fade-left">
                <div class="bg-white rounded-3xl shadow-[0_16px_48px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
                    {{-- Form header --}}
                    <div class="bg-primary px-8 py-8 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-15"
                             style="background: radial-gradient(circle at top right, #d4af37 0%, transparent 60%);"></div>
                        <h3 class="font-serif font-bold text-2xl text-white relative z-10 mb-1">Envoyer un message</h3>
                        <p class="text-white/60 text-sm relative z-10">Nous vous répondrons sous 24h</p>
                    </div>

                    <form action="#" method="POST" class="p-8 space-y-5"
                          onsubmit="event.preventDefault(); this.innerHTML='<div class=\'flex flex-col items-center justify-center py-12 text-center\'><div class=\'w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4\'><i class=\'fas fa-check text-green-500 text-2xl\'></i></div><h4 class=\'font-serif font-bold text-xl text-gray-900 mb-2\'>Message envoyé !</h4><p class=\'text-gray-500 text-sm\'>Merci pour votre message. Nous vous recontacterons bientôt.</p></div>';">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Nom complet</label>
                                <input type="text" id="name" name="name"
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400
                                              focus:outline-none focus:border-secondary focus:bg-white focus:ring-2 focus:ring-secondary/20 transition-all"
                                       placeholder="Votre nom">
                            </div>
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Téléphone</label>
                                <input type="tel" id="phone" name="phone"
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400
                                              focus:outline-none focus:border-secondary focus:bg-white focus:ring-2 focus:ring-secondary/20 transition-all"
                                       placeholder="+221 77 000 00 00">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                   class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400
                                          focus:outline-none focus:border-secondary focus:bg-white focus:ring-2 focus:ring-secondary/20 transition-all"
                                   placeholder="votre@email.com">
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sujet</label>
                            <select id="subject" name="subject"
                                    class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800
                                           focus:outline-none focus:border-secondary focus:bg-white focus:ring-2 focus:ring-secondary/20 transition-all">
                                <option value="">Sélectionnez un sujet</option>
                                <option>Demande d'inscription</option>
                                <option>Informations sur les programmes</option>
                                <option>Tarifs & frais de scolarité</option>
                                <option>Internat</option>
                                <option>Autre</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Message</label>
                            <textarea id="message" name="message" rows="4"
                                      class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 resize-none
                                             focus:outline-none focus:border-secondary focus:bg-white focus:ring-2 focus:ring-secondary/20 transition-all"
                                      placeholder="Comment pouvons-nous vous aider ?"></textarea>
                        </div>

                        <button type="submit" class="w-full btn-primary justify-center py-4 rounded-xl text-base">
                            <i class="fas fa-paper-plane"></i> Envoyer le message
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection