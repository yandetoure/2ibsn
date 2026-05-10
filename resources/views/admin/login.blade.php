<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - 2IBSN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #1a4d2e;
            --primary-dark: #0f331d;
            --secondary: #d4af37;
            --secondary-light: #e8c84a;
            --accent: #f7f5f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--primary-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            overflow: hidden;
            position: relative;
        }

        /* Decorative background elements */
        .bg-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--secondary);
            filter: blur(150px);
            opacity: 0.1;
            border-radius: 50%;
            z-index: 0;
        }

        .blob-1 { top: -100px; right: -100px; }
        .blob-2 { bottom: -100px; left: -100px; background: var(--primary); }
        
        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2.5rem;
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            position: relative;
            z-index: 10;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-content {
            padding: 3.5rem 3rem;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .logo-wrapper {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            padding: 0.75rem;
        }

        .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .login-header h1 {
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }
        
        .login-header p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.95rem;
            font-weight: 300;
        }
        
        .form-group {
            margin-bottom: 1.75rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.65rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .form-group input {
            width: 100%;
            padding: 1.1rem 1.25rem 1.1rem 3.25rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.25rem;
            font-size: 1rem;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
        }
        
        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        }

        .form-group input:focus + i {
            color: var(--secondary);
        }
        
        .error-message {
            color: #ff6b6b;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-submit {
            width: 100%;
            padding: 1.1rem;
            background: var(--secondary);
            color: var(--primary-dark);
            border: none;
            border-radius: 1.25rem;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }
        
        .btn-submit:hover {
            background: var(--secondary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 1.25rem;
            border-radius: 1.25rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ff6b6b;
        }

        .alert ul {
            list-style: none;
            font-size: 0.9rem;
        }

        .login-footer {
            margin-top: 2.5rem;
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .login-footer a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .login-footer a:hover {
            color: var(--secondary);
        }

        @media (max-width: 480px) {
            .login-content {
                padding: 2.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="login-card">
        <div class="login-content">
            <div class="login-header">
                <div class="logo-wrapper">
                    @php
                        $adminLogoPath = App\Models\Setting::get('logo_image');
                        $adminLogoSrc = $adminLogoPath ? asset('storage/' . $adminLogoPath) : asset('Images/logo.png');
                    @endphp
                    <img src="{{ $adminLogoSrc }}" alt="Logo">
                </div>
                <h1>Administration</h1>
                <p>Espace de gestion sécurisé 2IBSN</p>
            </div>
            
            @if($errors->any())
                <div class="alert">
                    <i class="fas fa-exclamation-circle" style="margin-top: 0.2rem;"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Identifiant Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@2ibsn.sn" required autofocus>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit">
                    <span>Accéder au tableau de bord</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer">
                <a href="{{ route('home') }}">
                    <i class="fas fa-chevron-left" style="font-size: 0.7rem; margin-right: 0.4rem;"></i>
                    Retour au site public
                </a>
            </div>
        </div>
    </div>
</body>
</html>

