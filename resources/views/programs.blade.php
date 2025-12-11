@extends('layouts.app')

@section('title', 'Nos Programmes - 2IBSN')

@section('content')
    <div class="page-header" style="background-color: var(--primary); color: white; padding: 4rem 0; text-align: center;">
        <div class="container">
            <h1>Nos Programmes</h1>
            <p>Un cursus complet pour chaque étape de la vie de l'élève</p>
        </div>
    </div>

    <section class="section" style="padding: 5rem 0;">
        <div class="container">
            <div class="program-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                <!-- Daara -->
                <div class="program-card"
                    style="background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-soft);">
                    <div class="program-header"
                        style="background-color: var(--secondary); padding: 1.5rem; color: var(--primary-dark);">
                        <h3 style="margin: 0;">Daara (Enseignement Coranique)</h3>
                    </div>
                    <div class="program-body" style="padding: 2rem;">
                        <p>Un Daara dédié à l'enseignement coranique pour aider les enfants à mémoriser le Saint Coran en un
                            temps record.</p>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-top: 1rem;">
                            <li>Mémorisation du Coran</li>
                            <li>Tajwid (Règles de lecture)</li>
                            <li>Éducation islamique de base</li>
                        </ul>
                    </div>
                </div>

                <!-- Préscolaire -->
                <div class="program-card"
                    style="background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-soft);">
                    <div class="program-header" style="background-color: var(--primary); padding: 1.5rem; color: white;">
                        <h3 style="margin: 0;">Préscolaire</h3>
                    </div>
                    <div class="program-body" style="padding: 2rem;">
                        <p>L'éveil et la socialisation dans un cadre bienveillant. Petite, Moyenne et Grande Section.</p>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-top: 1rem;">
                            <li>Apprentissage ludique</li>
                            <li>Initiation à la lecture et au calcul</li>
                            <li>Éveil religieux</li>
                        </ul>
                    </div>
                </div>

                <!-- Élémentaire -->
                <div class="program-card"
                    style="background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-soft);">
                    <div class="program-header" style="background-color: var(--primary); padding: 1.5rem; color: white;">
                        <h3 style="margin: 0;">Élémentaire</h3>
                    </div>
                    <div class="program-body" style="padding: 2rem;">
                        <p>Du CI au CM2, un programme rigoureux conforme au programme officiel du Sénégal.</p>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-top: 1rem;">
                            <li>Français, Mathématiques, Sciences</li>
                            <li>Arabe renforcé</li>
                            <li>Activités périscolaires</li>
                        </ul>
                    </div>
                </div>

                <!-- Secondaire -->
                <div class="program-card"
                    style="background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-soft);">
                    <div class="program-header" style="background-color: var(--primary); padding: 1.5rem; color: white;">
                        <h3 style="margin: 0;">Secondaire (Moyen)</h3>
                    </div>
                    <div class="program-body" style="padding: 2rem;">
                        <p>Préparation au BFEM avec un suivi personnalisé. 6ème à la 3ème.</p>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-top: 1rem;">
                            <li>Enseignement général complet</li>
                            <li>Préparation aux examens d'État</li>
                            <li>Formation morale continue</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection