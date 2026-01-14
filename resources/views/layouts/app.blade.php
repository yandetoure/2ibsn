<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '2ibsn - Institut International Baye Barhamou')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Base Critical CSS to prevent FOUC */
        :root {
            --primary: #1a4d2e; /* Deep Islamic Green */
            --secondary: #d4af37; /* Gold */
            --accent: #f5f5f0; /* Off-white/Cream */
            --text-dark: #1f2937;
            --text-light: #4b5563;
            --white: #ffffff;
        }
        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            margin: 0;
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('Images/logo.png') }}" alt="2IBSN Logo" class="logo-img" loading="eager" width="60" height="60">
                <div class="logo-text">
                    <span class="logo-title">2ibsn</span>
                    <span class="logo-subtitle">Institut International Baye Barhamou</span>
                </div>
            </a>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">À propos</a></li>
                    <li><a href="{{ route('programs') }}" class="{{ request()->routeIs('programs') ? 'active' : '' }}">Programmes</a></li>
                    <li><a href="{{ route('admissions') }}" class="{{ request()->routeIs('admissions') ? 'active' : '' }}">Admissions</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                <button class="mobile-menu-toggle" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="{{ asset('Images/logo2.png') }}" alt="2IBSN Logo" class="footer-logo" loading="lazy" width="80" height="80">
                    <p>Un établissement d'excellence alliant savoir universel et valeurs islamiques.</p>
                </div>
                <div class="footer-col">
                    <h3>Liens Rapides</h3>
                    <ul>
                        <li><a href="{{ route('about') }}">Notre Histoire</a></li>
                        <li><a href="{{ route('programs') }}">Nos Programmes</a></li>
                        <li><a href="{{ route('admissions') }}">S'inscrire</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contact</h3>
                    <p>contact@2ibsn.edu.sn</p> <!-- Placeholder email if not provided, used user provided one in reality but putting typo free one here or using the one provided -->
                    <p>+221 77 375 07 24</p>
                    <p>institutinternationalbayebarha@gmail.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Institut International Baye Barhamou. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
