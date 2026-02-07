<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance en cours | VIP GPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    body {
        background-color: #f4f6f8;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .maintenance-card {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 600px;
        width: 90%;
        position: relative;
        overflow: hidden;
        border-top: 5px solid #c9a050;
    }

    .logo-img {
        max-height: 80px;
        margin-bottom: 2rem;
        background-color: #0E1030;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #0E1030;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    p.lead {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .icon-box {
        width: 80px;
        height: 80px;
        background-color: #fff3cd;
        color: #c9a050;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
        font-size: 2.5rem;
        animation: pulse 2s infinite;
    }

    .contact-box {
        background-color: #0E1030;
        color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-top: 2rem;
    }

    .contact-box a {
        color: #ffc107;
        text-decoration: none;
        font-weight: bold;
    }

    .admin-link {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 0.8rem;
        color: #dee2e6;
        text-decoration: none;
    }

    .admin-link:hover {
        color: #adb5bd;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(201, 160, 80, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(201, 160, 80, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(201, 160, 80, 0);
        }
    }
    </style>
</head>

<body>
    <div class="maintenance-card">
        <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" alt="VIP GPI" class="logo-img">
        <div class="icon-box"><i class="fas fa-tools"></i></div>
        <h1>Site en maintenance</h1>
        <p class="lead">Nous effectuons actuellement une mise à jour pour améliorer nos services. Le site sera de retour
            très bientôt.</p>

        @php
        $phone = $settings['site_phone'] ?? '438 838-2630';
        $email = $settings['site_email'] ?? 'admin@vipgpi.ca';
        $fb = $settings['facebook_url'] ?? '#';
        $li = $settings['linkedin_url'] ?? '#';
        $phoneLink = preg_replace('/[^0-9]/', '', $phone);
        @endphp

        <div class="contact-box">
            <p class="mb-2">Une urgence ou une question ?</p>
            <div class="fs-5">
                <i class="fas fa-phone-alt me-2"></i> <a href="tel:{{ $phoneLink }}">{{ $phone }}</a>
            </div>
            <div class="mt-2 small">
                <i class="fas fa-envelope me-1"></i> {{ $email }}
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ $fb }}" class="text-secondary me-3 fs-4" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="{{ $li }}" class="text-secondary fs-4" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>

        {{-- Lien discret vers admin --}}
        <a href="{{ url('/login') }}" class="admin-link"><i class="fas fa-lock"></i></a>
    </div>
</body>

</html>
