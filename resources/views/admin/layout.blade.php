<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - 2IBSN')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: {{ App\Models\Setting::get('primary_color', '#1a4d2e') }};
            --primary-dark: #0f2d1b;
            --primary-light: rgba(26, 77, 46, 0.1);
            --secondary: {{ App\Models\Setting::get('secondary_color', '#d4af37') }};
            --accent: {{ App\Models\Setting::get('accent_color', '#f8f9fa') }};
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --sidebar-width: 280px;
            --radius-lg: 16px;
            --radius-md: 12px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--accent);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--primary-dark);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-header img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1.5rem 1rem;
            overflow-y: auto;
        }

        .nav-section-title {
            padding: 1.5rem 1rem 0.75rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 4px;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .nav-item i {
            width: 20px;
            font-size: 1.1rem;
            transition: transform 0.2s;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .nav-item:hover i {
            transform: translateX(3px);
        }

        .nav-item.active {
            background: var(--secondary);
            color: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        .nav-item.active i {
            color: var(--primary-dark);
        }

        /* --- Main Content --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* --- Top Bar --- */
        .top-bar {
            height: 80px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .menu-toggle {
            display: none;
            background: var(--white);
            border: 1px solid #e2e8f0;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
            color: var(--primary);
        }

        .page-title-group h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            background: var(--white);
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-profile:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .avatar {
            width: 32px;
            height: 32px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info .name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .user-info .role {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .logout-btn {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        /* --- Global Content Styles --- */
        .content-body {
            padding: 2.5rem;
        }

        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 77, 46, 0.2);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        /* --- Tables --- */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        table th {
            text-align: left;
            padding: 1rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
        }

        table tr td {
            background: var(--white);
            padding: 1rem;
            font-size: 0.95rem;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
        }

        table tr td:first-child {
            border-left: 1px solid #f1f5f9;
            border-top-left-radius: var(--radius-md);
            border-bottom-left-radius: var(--radius-md);
        }

        table tr td:last-child {
            border-right: 1px solid #f1f5f9;
            border-top-right-radius: var(--radius-md);
            border-bottom-right-radius: var(--radius-md);
        }

        table tr:hover td {
            background: #f8fafc;
        }

        /* --- Responsive --- */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            backdrop-filter: blur(4px);
        }

        .sidebar-overlay.open {
            display: block;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="sidebar-overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            @php $logo = App\Models\Setting::get('logo_image'); @endphp
            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="Logo">
            @else
                <div class="avatar" style="width: 40px; height: 40px; font-size: 1.2rem;">2I</div>
            @endif
            <h2>2IBSN Admin</h2>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                Dashboard
            </a>

            <div class="nav-section-title">Gestion Académique</div>
            <a href="{{ route('admin.students.index') }}" class="nav-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                Élèves
            </a>
            <a href="{{ route('admin.payments.index') }}" class="nav-item {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                Paiements
            </a>
            <a href="{{ route('admin.levels.index') }}" class="nav-item {{ request()->routeIs('admin.levels.*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                Niveaux & Tarifs
            </a>
            <a href="{{ route('admin.school-years.index') }}" class="nav-item {{ request()->routeIs('admin.school-years.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                Années Scolaires
            </a>

            <div class="nav-section-title">Configuration Site</div>
            <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                Paramètres
            </a>
            <a href="{{ route('admin.appearance.hero') }}" class="nav-item {{ request()->routeIs('admin.appearance.hero') ? 'active' : '' }}">
                <i class="fas fa-paint-roller"></i>
                Design Hero
            </a>
            <a href="{{ route('admin.appearance.colors') }}" class="nav-item {{ request()->routeIs('admin.appearance.colors') ? 'active' : '' }}">
                <i class="fas fa-palette"></i>
                Couleurs
            </a>
            <a href="{{ route('admin.appearance.gallery') }}" class="nav-item {{ request()->routeIs('admin.appearance.gallery') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                Galerie
            </a>
            <a href="{{ route('admin.appearance.events') }}" class="nav-item {{ request()->routeIs('admin.appearance.events') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                Événements
            </a>

            <div style="margin-top: 2rem; padding: 0 1rem;">
                <a href="{{ route('home') }}" target="_blank" class="nav-item" style="background: rgba(255,255,255,0.05);">
                    <i class="fas fa-external-link-alt"></i>
                    Voir le site
                </a>
            </div>
        </nav>
    </aside>

    <div class="main-wrapper">
        <header class="top-bar">
            <div class="top-bar-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title-group">
                    <h1>@yield('page-title', 'Tableau de Bord')</h1>
                </div>
            </div>

            <div class="top-bar-right">
                <div class="user-profile">
                    <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="user-info">
                        <span class="name">{{ Auth::user()->name }}</span>
                        <span class="role">Administrateur</span>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-power-off"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </header>

        <main class="content-body">
            @if(session('success'))
                <div class="alert alert-success" style="padding: 1rem; background: #dcfce7; color: #166534; border-radius: var(--radius-md); margin-bottom: 2rem; display: flex; align-items: center; gap: 12px; border: 1px solid #bbf7d0;">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="padding: 1rem; background: #fee2e2; color: #991b1b; border-radius: var(--radius-md); margin-bottom: 2rem; display: flex; align-items: center; gap: 12px; border: 1px solid #fecaca;">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            });
        }
    </script>
    @yield('scripts')
</body>

</html>