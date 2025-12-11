@extends('layouts.app')

@section('title', 'Admissions & Tarifs - 2IBSN')

@section('content')
    <div class="page-header">
        <div class="container">
            <h1>Admissions & Inscriptions</h1>
            <p>Rejoignez la famille 2IBSN pour l'année scolaire</p>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <div class="info-alert">
                <h3>Information Importante</h3>
                <p>L'inscription est ouverte pour l'Internat, l'Externat et les cours de Vacances.</p>
            </div>

            <h2 class="section-title">Grille Tarifaire (Externat Franco-Arabe)</h2>

            <h3>Préscolaire</h3>
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Inscription</th>
                        <th>Mensualité</th>
                        <th>Inscription Demi-Pension</th>
                        <th>Mensualité Demi-Pension</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Petit Section</td>
                        <td>24.000 F</td>
                        <td>12.000 F</td>
                        <td>24.000 F</td>
                        <td>20.000 F</td>
                    </tr>
                    <tr>
                        <td>Moyen Section</td>
                        <td>24.000 F</td>
                        <td>12.000 F</td>
                        <td>24.000 F</td>
                        <td>20.000 F</td>
                    </tr>
                    <tr>
                        <td>Grande Section</td>
                        <td>24.000 F</td>
                        <td>12.000 F</td>
                        <td>24.000 F</td>
                        <td>20.000 F</td>
                    </tr>
                </tbody>
            </table>

            <h3>Élémentaire (CI - CM2)</h3>
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Inscription</th>
                        <th>Mensualité</th>
                        <th>Inscription Demi-Pension</th>
                        <th>Mensualité Demi-Pension</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CI</td>
                        <td>25.000 F</td>
                        <td>12.000 F</td>
                        <td>25.000 F</td>
                        <td>25.000 F</td>
                    </tr>
                    <tr>
                        <td>CP</td>
                        <td>25.000 F</td>
                        <td>12.000 F</td>
                        <td>25.000 F</td>
                        <td>25.000 F</td>
                    </tr>
                    <tr>
                        <td>CE1</td>
                        <td>25.000 F</td>
                        <td>12.000 F</td>
                        <td>29.000 F</td>
                        <td>29.000 F</td>
                    </tr>
                    <tr>
                        <td>CE2</td>
                        <td>25.000 F</td>
                        <td>12.000 F</td>
                        <td>29.000 F</td>
                        <td>29.000 F</td>
                    </tr>
                    <tr>
                        <td>CM1</td>
                        <td>25.000 F</td>
                        <td>12.000 F</td>
                        <td>33.000 F</td>
                        <td>33.000 F</td>
                    </tr>
                    <tr>
                        <td>CM2</td>
                        <td>25.000 F</td>
                        <td>12.000 F</td>
                        <td>33.000 F</td>
                        <td>33.000 F</td>
                    </tr>
                </tbody>
            </table>

            <h3>Moyen Secondaire</h3>
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Inscription</th>
                        <th>Mensualité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>6ème</td>
                        <td>34.000 F</td>
                        <td>17.000 F</td>
                    </tr>
                    <tr>
                        <td>5ème</td>
                        <td>34.000 F</td>
                        <td>17.000 F</td>
                    </tr>
                    <tr>
                        <td>4ème</td>
                        <td>44.000 F</td>
                        <td>19.000 F</td>
                    </tr>
                    <tr>
                        <td>3ème</td>
                        <td>50.000 F</td>
                        <td>25.000 F</td>
                    </tr>
                </tbody>
            </table>

            <div class="notes">
                <h3>Notes Importantes (NB)</h3>
                <ul>
                    <li><strong>Demi-Pension :</strong> L'enfant passe toute la journée à l'école et prend son déjeuner sur
                        place (pris en charge par l'école).</li>
                    <li>Aucune somme perçue n'est remboursable.</li>
                    <li>Les frais d'inscription ne sont ni remboursables ni échangeables.</li>
                </ul>
            </div>

            <div class="dossier">
                <h3>Dossier à fournir</h3>
                <ul>
                    <li>📄 2 pièces d'État Civil</li>
                    <li>📸 4 photos d'identité</li>
                </ul>
            </div>

            <div class="cta-container">
                <a href="{{ route('contact') }}" class="btn">Contacter pour Inscription</a>
            </div>
        </div>
    </section>
@endsection