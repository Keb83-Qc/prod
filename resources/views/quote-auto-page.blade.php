@php
// 1. On récupère le conseiller stocké en session
$advisorCode = session('current_advisor_code');
$advisor = \App\Models\User::where('advisor_code', $advisorCode)->first();

// 2. Définition des variables d'affichage
// Note : Le nom et le téléphone sont des données, ils ne se traduisent pas (sauf si vous voulez formater le tel)
$advisorName = $advisor ? $advisor->first_name . ' ' . $advisor->last_name : 'Claude Goudreau';
$advisorPhone = $advisor && $advisor->phone ? $advisor->phone : '438-881-2954';
@endphp

<!DOCTYPE html>
{{-- DÉFINITION DYNAMIQUE DE LA LANGUE --}}
<html lang="{{ session('locale', 'fr') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- TITRE TRADUIT --}}
    <title>{{ __('chat.page_title') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}?v={{ time() }}">

    @livewireStyles

    <style>
        /* --- STYLE DE LA TOP BAR --- */
        :root {
            --vip-gold: #c9a050;
            --vip-blue: #0E1030;
        }

        body {
            /* On ajoute du padding pour ne pas cacher le haut du chat sous la barre fixe */
            padding-top: 90px;
            background-color: #f4f7f6;
        }

        .vip-navbar {
            background-color: #ffffff;
            border-bottom: 3px solid var(--vip-gold);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding-top: 10px;
            padding-bottom: 10px;
            z-index: 1000;
        }

        /* --- CONTENEUR DU LOGO --- */
        .navbar-brand {
            background-color: var(--vip-blue);
            padding: 8px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .navbar-brand:hover {
            background-color: #1a1d4d;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
        }

        .advisor-box {
            border-left: 1px solid #eee;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            line-height: 1.2;
        }

        .advisor-label {
            font-size: 0.7rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .advisor-name {
            font-weight: 700;
            color: var(--vip-blue);
            font-size: 1rem;
        }

        .advisor-phone {
            color: var(--vip-gold);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .advisor-phone:hover {
            color: var(--vip-blue);
            text-decoration: underline;
        }

        /* Ajustement Mobile */
        @media (max-width: 576px) {
            .navbar-brand img {
                height: 35px;
            }

            .navbar-brand {
                padding: 6px 10px;
            }

            .advisor-name {
                font-size: 0.85rem;
            }

            .advisor-phone {
                font-size: 0.8rem;
            }

            .advisor-box {
                padding-left: 10px;
            }
        }
    </style>
</head>

<body>

    {{-- DÉBUT TOP BAR --}}
    <nav class="navbar fixed-top vip-navbar">
        <div class="container">
            {{-- LOGO À GAUCHE --}}
            <a class="navbar-brand shadow-sm" href="/">
                <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" alt="VIP GPI Logo">
            </a>

            {{-- INFO CONSEILLER À DROITE --}}
            <div class="d-flex align-items-center">
                <div class="advisor-box text-end">
                    {{-- LABEL TRADUIT (Votre conseiller / Your Advisor / Konseye ou) --}}
                    <span class="advisor-label">{{ __('chat.advisor_label') }}</span>

                    <div class="advisor-name">
                        <i class="fas fa-user-tie me-1 text-muted small"></i>
                        {{ $advisorName }}
                    </div>

                    @if($advisorPhone && $advisorPhone !== 'Inconnu')
                    <a href="tel:{{ $advisorPhone }}" class="advisor-phone">
                        <i class="fas fa-phone-alt me-1 small"></i>
                        {{ $advisorPhone }}
                    </a>
                    @else
                    {{-- LABEL TRADUIT (Contactez-nous / Contact Us / Kontakte nou) --}}
                    <span class="text-muted small">{{ __('chat.contact_us') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    {{-- FIN TOP BAR --}}

    @livewire('quote-auto-chat')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
