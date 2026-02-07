<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Soumission Auto - VIP GPI' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    @livewireStyles

    <style>
    :root {
        --vip-gold: #c9a050;
        --vip-blue: #0E1030;
    }

    body {
        background-color: #f4f7f6;
        font-family: 'Montserrat', sans-serif;
        padding-top: 80px;
        /* Pour ne pas cacher le contenu sous la barre fixe */
    }

    /* Style de la Top Bar */
    .vip-navbar {
        background-color: #ffffff;
        border-bottom: 3px solid var(--vip-gold);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        height: 80px;
    }

    .advisor-box {
        border-left: 1px solid #eee;
        padding-left: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
    }

    .advisor-name {
        font-weight: 700;
        color: var(--vip-blue);
        font-size: 1rem;
        margin-bottom: 2px;
    }

    .advisor-phone {
        color: var(--vip-gold);
        font-weight: 600;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s;
    }

    .advisor-phone:hover {
        color: var(--vip-blue);
        text-decoration: underline;
    }

    .advisor-label {
        font-size: 0.7rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Logo responsive */
    .navbar-brand img {
        height: 50px;
        width: auto;
    }

    @media (max-width: 576px) {
        .advisor-name {
            font-size: 0.9rem;
        }

        .advisor-phone {
            font-size: 0.8rem;
        }

        .navbar-brand img {
            height: 40px;
        }
    }
    </style>
</head>

<body>

    {{-- TOP BAR --}}
    <nav class="navbar fixed-top vip-navbar">
        <div class="container">
            {{-- LOGO À GAUCHE --}}
            <a class="navbar-brand" href="/">
                {{-- Assurez-vous que le chemin du logo est correct --}}
                <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" alt="VIP GPI Logo">
            </a>

            {{-- INFO CONSEILLER À DROITE --}}
            <div class="d-flex align-items-center">
                <div class="advisor-box text-end">
                    {{-- On vérifie si les variables existent, sinon on met des valeurs par défaut --}}
                    <span class="advisor-label">Votre conseiller</span>

                    <div class="advisor-name">
                        <i class="fas fa-user-tie me-1 text-muted"></i>
                        {{ $advisorName ?? 'Conseiller VIP' }}
                    </div>

                    <a href="tel:{{ $advisorPhone ?? '1-800-000-0000' }}" class="advisor-phone">
                        <i class="fas fa-phone-alt me-1"></i>
                        {{ $advisorPhone ?? 'Contactez-nous' }}
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- CONTENU PRINCIPAL --}}
    <main>
        @if(isset($slot))
        {{ $slot }}
        @else
        @yield('content')
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>

</html>
