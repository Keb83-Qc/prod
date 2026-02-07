<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Important pour AJAX --}}
    <title>Connexion | VIP GPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
        background: linear-gradient(135deg, #0E1030 0%, #1f2354 100%);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        padding: 2.5rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #c9a050, #e6c885, #c9a050);
    }

    .btn-login {
        background-color: #0E1030;
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background-color: #c9a050;
        color: white;
        transform: translateY(-2px);
    }

    .form-control:focus {
        border-color: #c9a050;
        box-shadow: 0 0 0 0.25rem rgba(201, 160, 80, 0.15);
    }

    .fade-in {
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>
    <div class="login-card text-center">
        <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" alt="Logo"
            style="height: 80px; margin-bottom: 25px;">

        {{-- SECTION LOGIN --}}
        <div id="login-section" class="fade-in">
            <h4 class="mb-1 fw-bold text-dark">Espace Membre</h4>
            <p class="text-muted small mb-4">Connectez-vous pour accéder à votre portail.</p>

            @if ($errors->any())
            <div
                class="alert alert-danger text-start py-2 fs-6 border-0 bg-danger bg-opacity-10 text-danger rounded-3 mb-3">
                <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                        placeholder="name@example.com" value="{{ old('email') }}" required>
                    <label for="floatingInput">Adresse Email</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Mot de passe" required>
                    <label for="floatingPassword">Mot de passe</label>
                </div>

                <button type="submit" class="btn btn-login w-100 py-3 rounded-3 shadow-sm">
                    <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                </button>

                <div class="text-center mt-4 pt-3 border-top">
                    <small class="text-muted d-block mb-2">Vous n'avez pas d'accès ?</small>
                    <button type="button" onclick="toggleForms('register')"
                        class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        Demander un compte
                    </button>
                </div>
            </form>
        </div>

        {{-- SECTION REGISTER --}}
        <div id="register-section" class="fade-in" style="display: none;">
            <h4 class="mb-3 fw-bold text-dark">Rejoindre l'équipe</h4>
            <p class="text-muted small mb-4">Remplissez ce formulaire pour demander un accès.</p>

            <form id="registerForm">
                @csrf {{-- Token CSRF pour AJAX --}}
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="text" name="first_name" class="form-control" id="regPr" placeholder="Prénom"
                                required>
                            <label for="regPr" class="small">Prénom</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="text" name="last_name" class="form-control" id="regNm" placeholder="Nom"
                                required>
                            <label for="regNm" class="small">Nom</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="regEm" placeholder="Email" required>
                    <label for="regEm">Courriel professionnel</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="phone" class="form-control" id="regPh" placeholder="Téléphone" required>
                    <label for="regPh">Téléphone</label>
                </div>

                <button type="submit" class="btn btn-success w-100 py-3 fw-bold shadow-sm">
                    <i class="fas fa-paper-plane me-2"></i> Envoyer la demande
                </button>
            </form>

            <div id="regFeedback" class="mt-3" style="display:none;"></div>

            <div class="mt-4 pt-2 border-top">
                <button type="button" onclick="toggleForms('login')"
                    class="btn btn-link text-secondary text-decoration-none small">
                    <i class="fas fa-arrow-left me-1"></i> Retour à la connexion
                </button>
            </div>
        </div>

        <div class="mt-4 text-muted small opacity-50" style="font-size: 0.75rem;">
            &copy; {{ date('Y') }} VIP Services Financiers
        </div>
    </div>

    {{-- MODAL SUCCESS --}}
    <div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 p-4 text-center rounded-4 shadow-lg">
                <div class="mb-3">
                    <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                        style="width: 80px; height: 80px;">
                        <i class="fas fa-check fa-3x text-success"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-2">Demande envoyée !</h3>
                <p class="text-muted mb-4">Nous avons bien reçu votre demande.<br>Un administrateur validera votre
                    compte sous peu.</p>
                <button type="button" class="btn btn-dark px-5 py-2 fw-bold rounded-pill"
                    onclick="window.location.reload();">Terminer</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleForms(view) {
        const loginBox = document.getElementById('login-section');
        const regBox = document.getElementById('register-section');
        const feedback = document.getElementById('regFeedback');
        if (feedback) feedback.style.display = 'none';

        if (view === 'register') {
            loginBox.style.display = 'none';
            regBox.style.display = 'block';
        } else {
            regBox.style.display = 'none';
            loginBox.style.display = 'block';
        }
    }

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const feedback = document.getElementById('regFeedback');
        const btn = this.querySelector('button[type="submit"]');
        const originalBtnText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';

        fetch("{{ route('register.ajax') }}", { // Route Laravel
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                    myModal.show();
                    this.reset();
                } else {
                    feedback.style.display = 'block';
                    feedback.innerHTML =
                        '<div class="alert alert-danger py-2 small border-0 bg-danger bg-opacity-10 text-danger rounded-3"><i class="fas fa-exclamation-circle me-1"></i> ' +
                        data.message + '</div>';
                    btn.disabled = false;
                    btn.innerHTML = originalBtnText;
                }
            })
            .catch(err => {
                feedback.style.display = 'block';
                feedback.innerHTML = '<div class="alert alert-danger py-2 small">Erreur serveur (' + err +
                    ')</div>';
                btn.disabled = false;
                btn.innerHTML = originalBtnText;
            });
    });
    </script>
</body>

</html>
