<!DOCTYPE html>
<html lang="{{ session('locale', 'fr') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('consentement.page_title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --vip-blue: #0E1030;
            --vip-gold: #c9a050;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Montserrat', sans-serif;
            color: #333;
        }

        /* --- CARTE PRINCIPALE --- */
        .privacy-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border-top: 5px solid var(--vip-gold);
        }

        .header-section {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .content-section {
            padding: 2rem;
        }

        /* --- STYLES DE VOTRE LISTE (Adaptés) --- */
        .icon-box {
            width: 50px;
            height: 50px;
            background-color: rgba(201, 160, 80, 0.1);
            color: var(--vip-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .list-group-item {
            border: none;
            padding: 1rem 0;
            display: flex;
            align-items: flex-start;
        }

        /* --- BADGE CONSEILLER --- */
        .advisor-badge {
            background-color: #e9ecef;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
            display: inline-block;
        }

        /* --- BOUTON PRINCIPAL --- */
        .btn-primary {
            background-color: var(--vip-blue);
            border-color: var(--vip-blue);
            padding: 12px 40px;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--vip-gold);
            border-color: var(--vip-gold);
            color: white;
        }

        /* --- STYLE DU MODAL (POPUP) --- */
        .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .modal-header {
            background-color: var(--vip-blue);
            color: white;
            border-bottom: 4px solid var(--vip-gold);
            justify-content: center;
            padding: 1.5rem 1rem;
        }

        .modal-title {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1.1rem;
        }

        /* Boutons de langue */
        .lang-btn {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px 10px;
            text-decoration: none;
            color: var(--vip-blue);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            height: 100%;
        }

        .lang-flag {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
            line-height: 1;
        }

        .lang-name {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .lang-btn:hover {
            transform: translateY(-5px);
            background-color: var(--vip-blue);
            color: var(--vip-gold);
            border-color: var(--vip-gold);
            box-shadow: 0 8px 15px rgba(14, 16, 48, 0.2);
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" alt="VIP GPI" style="height: 60px;">
                </div>

                {{-- Bouton Langue (Haut Droite) --}}
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#languageModal">
                        <i class="fas fa-globe me-1"></i>
                        {{ strtoupper(session('locale', 'fr')) }}
                    </button>
                </div>

                <div class="privacy-card">
                    <div class="header-section">
                        @if($advisor)
                        <div class="advisor-badge">
                            <i class="fas fa-user-tie me-2"></i>
                            {{ __('consentement.advisor_label') }}
                            <strong>{{ $advisor->first_name }} {{ $advisor->last_name }}</strong>
                        </div>
                        @endif

                        <h2 class="fw-bold mb-3">{{ __('consentement.main_title') }}</h2>
                        <p class="text-muted mb-0">
                            {{ __('consentement.subtitle') }}
                        </p>
                    </div>

                    <div class="content-section">
                        <h5 class="fw-bold mb-4 text-center">{{ __('consentement.why_title') }}</h5>

                        <div class="list-group">
                            {{-- RAISON 1 --}}
                            <div class="list-group-item">
                                <div class="icon-box"><i class="fas fa-id-card"></i></div>
                                <div>
                                    <h6 class="fw-bold">{{ __('consentement.reason_1_title') }}</h6>
                                    <p class="small text-muted mb-0">{{ __('consentement.reason_1_desc') }}</p>
                                </div>
                            </div>

                            {{-- RAISON 2 --}}
                            <div class="list-group-item">
                                <div class="icon-box"><i class="fas fa-handshake"></i></div>
                                <div>
                                    <h6 class="fw-bold">{{ __('consentement.reason_2_title') }}</h6>
                                    <p class="small text-muted mb-0">{{ __('consentement.reason_2_desc') }}</p>
                                </div>
                            </div>

                            {{-- RAISON 3 --}}
                            <div class="list-group-item">
                                <div class="icon-box"><i class="fas fa-lightbulb"></i></div>
                                <div>
                                    <h6 class="fw-bold">{{ __('consentement.reason_3_title') }}</h6>
                                    <p class="small text-muted mb-0">{{ __('consentement.reason_3_desc') }}</p>
                                </div>
                            </div>

                            {{-- RAISON 4 --}}
                            <div class="list-group-item">
                                <div class="icon-box"><i class="fas fa-shield-alt"></i></div>
                                <div>
                                    <h6 class="fw-bold">{{ __('consentement.reason_4_title') }}</h6>
                                    <p class="small text-muted mb-0">{{ __('consentement.reason_4_desc') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-light mt-4 border" role="alert">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                {{ __('consentement.disclaimer') }}
                            </small>
                        </div>

                        <div class="text-center mt-5">
                            <form action="{{ route('consent.accept') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary rounded-pill shadow">
                                    {{ __('consentement.accept_btn') }} <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </form>

                            <div class="mt-3">
                                <a href="https://ia.ca/politique-protection-renseignements-personnels" target="_blank"
                                    class="small text-muted text-decoration-underline">
                                    {{ __('consentement.policy_link') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="languageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languageModalLabel">
                        BIENVENUE / WELCOME / BYENVENI
                    </h5>
                </div>
                <div class="modal-body p-5">
                    <p class="text-center text-muted mb-5 fs-5">
                        {{ __('consentement.select_lang') }}<br>
                        <span class="small text-muted">Please select your language / Tanpri chwazi lang ou</span>
                    </p>

                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4 col-sm-6">
                            <a href="{{ route('consent.language', ['locale' => 'fr', 'code' => $advisor->advisor_code ?? '']) }}" class="lang-btn">
                                <span class="lang-flag">🇫🇷</span>
                                <span class="lang-name">Français</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a href="{{ route('consent.language', ['locale' => 'en', 'code' => $advisor->advisor_code ?? '']) }}" class="lang-btn">
                                <span class="lang-flag">🇨🇦</span>
                                <span class="lang-name">English</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a href="{{ route('consent.language', ['locale' => 'ht', 'code' => $advisor->advisor_code ?? '']) }}" class="lang-btn">
                                <span class="lang-flag">🇭🇹</span>
                                <span class="lang-name">Kreyòl</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Détection de la session locale
            let currentLocale = "{{ session('locale') }}";

            // Si aucune langue définie, on affiche le modal
            if (!currentLocale) {
                var myModal = new bootstrap.Modal(document.getElementById('languageModal'));
                myModal.show();
            }
        });
    </script>
</body>

</html>
