<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - VIP GPI Services Financiers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* J'ai gardé votre CSS intact */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            overflow: hidden;
            background-color: #0E1030;
            perspective: 1000px;
            cursor: pointer;
        }

        .split-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, #1a1d4d 0%, #0E1030 100%);
            z-index: -1;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 60%;
            opacity: 0.03;
            z-index: 0;
            animation: pulseBg 10s infinite alternate;
        }

        .welcome-card {
            background: rgba(14, 16, 48, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(201, 160, 80, 0.4);
            padding: 4rem 3rem;
            border-radius: 20px;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.05) inset, 0 50px 100px -20px rgba(0, 0, 0, 0.8), 0 0 30px rgba(201, 160, 80, 0.1);
            max-width: 650px;
            width: 90%;
            text-align: center;
            position: relative;
            z-index: 2;
            opacity: 0;
            transform-style: preserve-3d;
            animation: cinematicEntrance 1.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards, floating 6s ease-in-out infinite 1.8s;
        }

        .logo-main {
            max-width: 300px;
            filter: drop-shadow(0 10px 10px rgba(0, 0, 0, 0.5));
            animation: logoShine 8s infinite 2s;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            font-size: 1.8rem;
            margin-bottom: 2.5rem;
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .lang-btn {
            display: block;
            width: 100%;
            padding: 18px;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(201, 160, 80, 0.5);
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(30px);
            z-index: 10;
        }

        .lang-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(201, 160, 80, 0.4), transparent);
            transition: 0.6s;
        }

        .lang-btn:hover {
            background: #c9a050;
            color: #0E1030;
            box-shadow: 0 0 30px rgba(201, 160, 80, 0.6);
            border-color: #c9a050;
            transform: scale(1.05);
        }

        .lang-btn:hover::before {
            left: 100%;
        }

        .btn-entrance {
            animation: slideUpFade 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        .delay-1 {
            animation-delay: 1.0s;
        }

        .delay-2 {
            animation-delay: 1.2s;
        }

        .footer-note {
            margin-top: 3rem;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: fadeIn 1s forwards 2s;
            opacity: 0;
        }

        @keyframes cinematicEntrance {
            0% {
                opacity: 0;
                transform: translateY(100px) scale(0.8) rotateX(20deg);
                filter: blur(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1) rotateX(0deg);
                filter: blur(0);
            }
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseBg {
            0% {
                opacity: 0.03;
                transform: scale(1);
            }

            100% {
                opacity: 0.06;
                transform: scale(1.1);
            }
        }

        @keyframes logoShine {

            0%,
            100% {
                filter: drop-shadow(0 10px 10px rgba(0, 0, 0, 0.5)) brightness(1);
            }

            50% {
                filter: drop-shadow(0 10px 20px rgba(201, 160, 80, 0.3)) brightness(1.2);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

    <div class="split-bg"></div>
    <div class="bg-overlay"></div>

    <audio id="bgMusic" preload="auto">
        <source src="{{ asset('assets/audio/intro.mp3') }}" type="audio/mpeg">
    </audio>

    <div id="clickOverlay" style="position:fixed; top:0; left:0; width:100%; height:100%; z-index:1; cursor:pointer;">
    </div>

    <div class="welcome-card">
        <div class="logo-container">
            <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" alt="VIP GPI" class="logo-main">
        </div>

        <h1>BIENVENUE / WELCOME</h1>

        <div class="row g-3">
            <div class="col-md-6">
                {{-- MODIFICATION ICI : Lien vers la route Laravel --}}
                <a href="{{ route('switch.language', 'fr') }}" class="lang-btn rounded-pill btn-entrance delay-1">Français</a>
            </div>
            <div class="col-md-6">
                {{-- MODIFICATION ICI : Lien vers la route Laravel --}}
                <a href="{{ route('switch.language', 'en') }}" class="lang-btn rounded-pill btn-entrance delay-2">English</a>
            </div>
        </div>

        <div class="footer-note">
            Sélectionnez votre langue pour continuer<br>
            Select your language to continue
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var music = document.getElementById('bgMusic');
            var overlay = document.getElementById('clickOverlay');
            music.volume = 0.4;

            var playAudio = function() {
                var promise = music.play();
                if (promise !== undefined) {
                    promise.then(_ => {
                        if (overlay) overlay.style.display = 'none';
                        document.removeEventListener('click', playAudio);
                        document.removeEventListener('mousemove', playAudio);
                        document.removeEventListener('scroll', playAudio);
                        document.removeEventListener('touchstart', playAudio);
                    }).catch(error => {});
                }
            };

            playAudio();
            document.addEventListener('click', playAudio);
            document.addEventListener('mousemove', playAudio);
            document.addEventListener('scroll', playAudio);
            document.addEventListener('touchstart', playAudio);
            if (overlay) {
                overlay.addEventListener('click', playAudio);
            }
        });
    </script>

</body>

</html>