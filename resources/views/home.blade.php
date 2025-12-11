@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="carousel-container">
            <!-- Carousel Slides -->
            <div class="carousel-slide active" style="background-image: url('{{ asset('Images/Header.jpeg') }}');"></div>
            <div class="carousel-slide" style="background-image: url('{{ asset('Images/header2.jpeg') }}');"></div>
            <div class="carousel-slide" style="background-image: url('{{ asset('Images/header3.jpeg') }}');"></div>
            <div class="carousel-slide" style="background-image: url('{{ asset('Images/header4.jpeg') }}');"></div>
        </div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1>Éducation d'Excellence & Valeurs Authentiques</h1>
            <p>L'Institut International Baye Barhamou (2IBSN) forme les leaders de demain à travers un modèle éducatif
                franco-islamique unique.</p>
            <div class="hero-actions">
                <a href="{{ route('admissions') }}" class="btn">S'inscrire Maintenant</a>
                <a href="{{ route('programs') }}" class="btn btn-outline">Découvrir nos Programmes</a>
            </div>
        </div>

        <div class="carousel-indicators">
            <div class="indicator active" data-slide="0"></div>
            <div class="indicator" data-slide="1"></div>
            <div class="indicator" data-slide="2"></div>
            <div class="indicator" data-slide="3"></div>
        </div>
    </section>

    <section class="values">
        <div class="container">
            <h2 class="section-title">Pourquoi Choisir 2IBSN ?</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">📚</div>
                    <h3>Double Cursus</h3>
                    <p>Un programme harmonieux alliant l'enseignement officiel du Sénégal et une éducation religieuse
                        approfondie.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🕌</div>
                    <h3>Éducation Islamique</h3>
                    <p>Apprentissage du Coran et des valeurs islamiques pour forger une identité forte et morale.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌟</div>
                    <h3>Excellence Académique</h3>
                    <p>Un encadrement rigoureux visant la réussite scolaire et l'épanouissement personnel de chaque élève.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-preview">
        <div class="container">
            <div class="about-grid">
                <div class="about-text">
                    <h2 class="section-title" style="text-align: left; margin-bottom: 1.5rem;">Notre Vision</h2>
                    <p style="margin-bottom: 1.5rem;">
                        Fondé le 05 Septembre 2016, l’Institut International Baye Barhamou (2ib) est un établissement
                        d’enseignement privé qui a pour vocation d'offrir une éducation complète.
                    </p>
                    <p style="margin-bottom: 2rem;">
                        La principale préoccupation de notre direction est d’ouvrir nos élèves tant aux fondamentaux du
                        savoir universel qu’à la pratique éclairée de l’Islam.
                    </p>
                    <a href="{{ route('about') }}" class="btn">En savoir plus</a>
                </div>
                <div class="about-image">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.14.jpeg') }}" alt="Élèves de 2IBSN">
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <h2 class="section-title">Vie à l'Institut</h2>
            <div class="gallery-grid">
                <!-- Using a mix of images for the gallery -->
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.11.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.12.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.13.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.15.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.16.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.17.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.18.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('Images/WhatsApp Image 2025-12-05 at 21.16.19.jpeg') }}" loading="lazy"
                        alt="2IBSN Gallery">
                    <div class="gallery-overlay"><span class="gallery-icon">+</span></div>
                </div>
            </div>
        </div>
    </section>

@endsection