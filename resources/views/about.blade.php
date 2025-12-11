@extends('layouts.app')

@section('title', 'À Propos - 2IBSN')

@section('content')
    <div class="page-header">
        <div class="container">
            <h1>À Propos de l'Institut</h1>
            <p>Histoire, Mission et Vision</p>
        </div>
    </div>

    <section class="about-section">
        <div class="container">
            <div class="history-grid">
                <div class="history-text">
                    <h2>Notre Histoire</h2>
                    <p>
                        Fondé le 05 Septembre 2016, l’Institut International Baye Barhamou (2ib) est un établissement
                        d’enseignement privé, internat et externat.
                    </p>
                    <p>
                        Depuis sa création, l'école s'est engagée à fournir un environnement d'apprentissage stimulant et
                        bienveillant, où chaque élève est encouragé à atteindre son plein potentiel académique et personnel.
                    </p>
                </div>
                <div class="history-image">
                    <img src="{{ asset('Images/Header.jpeg') }}" alt="Bâtiment de l'Institut 2IBSN">
                </div>
            </div>

            <div class="mission-cards">
                <div class="info-card">
                    <div class="info-card-icon">🎯</div>
                    <h3>Notre Mission</h3>
                    <p>
                        Offrir une éducation complète alliant l'enseignement officiel du Sénégal et une solide formation
                        islamique, pour former des citoyens responsables et éclairés.
                    </p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">👁️</div>
                    <h3>Notre Vision</h3>
                    <p>
                        Devenir un modèle d'excellence éducative en Afrique de l'Ouest, reconnu pour la qualité de son
                        enseignement bilingue (Français-Arabe) et ses valeurs éthiques.
                    </p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">🤝</div>
                    <h3>Nos Valeurs</h3>
                    <p>
                        Excellence, Intégrité, Respect et Solidarité sont les piliers de notre communauté éducative, guidant
                        chacune de nos actions au quotidien.
                    </p>
                </div>
            </div>

            <div class="director-section">
                <div class="director-grid">
                    <div class="director-avatar">
                        <!-- Placeholder for Director's Image or generic avatar -->
                        <img src="{{ asset('Images/avatar.png') }}"
                            onerror="this.src='https://ui-avatars.com/api/?name=Madiara+Ndiaye&background=d4af37&color=1a4d2e&size=200'"
                            alt="Le Directeur">
                    </div>
                    <div class="director-quote">
                        <h2>Le Mot du Directeur</h2>
                        <blockquote>
                            "La principale préoccupation du dirigeant de 2ib est d’ouvrir ses élèves tant aux fondamentaux
                            du
                            savoir universel qu’à la pratique de l’Islam."
                        </blockquote>
                        <div class="director-name">Madiara Ndiaye</div>
                        <div class="director-title">Directeur de l'Institut</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection