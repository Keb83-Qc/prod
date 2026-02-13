@include('partials.header')

{{-- SECTION 1 : CONTENU PRINCIPAL --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center justify-content-between">

            {{-- COLONNE GAUCHE --}}
            <div class="col-lg-7 mb-5 mb-lg-0">
                <span class="badge bg-primary text-white mb-2">{{ __('management.badge_section') }}</span>

                <h2 class="fw-bold mb-3" style="color: var(--primary-color);">
                    {{ __('management.intro_title') }}
                </h2>

                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                {{-- AJOUT DE LA CLASSE fst-italic ICI --}}
                <p class="lead fw-bold text-dark mb-4 fst-italic">
                    {{ __('management.intro_subtitle') }}
                </p>

                <div class="mb-4">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm text-white fw-bold hover-lift">
                        {{ __('management.btn_intro') }}
                    </a>
                </div>

                <div class="text-muted text-justify" style="line-height: 1.8;">
                    <p class="mb-3">{{ __('management.intro_p1') }}</p>
                    <p class="mb-3">{{ __('management.intro_p2') }}</p>
                    <p class="mb-0">{{ __('management.intro_p3') }}</p>
                </div>
            </div>

            {{-- COLONNE DROITE --}}
            <div class="col-lg-5 text-center text-lg-end">
                <img src="{{ asset('assets/img/management/intro-image.jpg') }}"
                    alt="Gestion de patrimoine"
                    class="img-fluid rounded shadow hover-lift w-100 object-fit-cover"
                    style="max-height: 500px;">
            </div>

        </div>
    </div>
</section>

{{-- SECTION 2 : APPROCHE (Background Image au complet) --}}
<section class="section-padding position-relative"
    style="background-image: url('{{ asset('assets/img/management/process-image.jpg') }}');
                background-size: 100% 100%;
                background-repeat: no-repeat;
                background-position: center;">

    {{-- Overlay allégé (0.3 au lieu de 0.6) pour mieux voir l'image --}}
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3);"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center" style="min-height: 500px;">

            {{-- COLONNE GAUCHE (Votre texte - Inchangé) --}}
            <div class="col-lg-6 text-white mb-5 mb-lg-0 pe-lg-5">
                <h2 class="fw-bold mb-4 text-white">
                    {{ __('management.sec2_title') }}
                </h2>

                <div style="width: 60px; height: 3px; background: #fff; margin-bottom: 25px;"></div>

                <p class="lead fst-italic mb-4">
                    {{ __('management.sec2_subtitle') }}
                </p>

                <div class="text-white-50 text-justify" style="line-height: 1.8;">
                    <p>{{ __('management.sec2_text') }}</p>
                </div>
            </div>

            {{-- COLONNE DROITE (Les 3 Cartes Verticales comme l'image) --}}
            <div class="col-lg-6">
                <div class="row g-3"> {{-- Gutter (espace) entre les cartes --}}

                    {{-- CARTE 1 : APPROCHE GLOBALE (Bleu Foncé) --}}
                    <div class="col-md-4">
                        <div class="card h-100 border-0 text-white text-center p-3 d-flex flex-column justify-content-center"
                            style="background-color: #0c2340; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                            <div class="mb-3">
                                <i class="fas fa-globe fa-3x"></i>
                            </div>
                            <h6 class="fw-bold text-uppercase mb-3" style="font-size: 0.9rem;">
                                {{ __('management.card1_title') }}
                            </h6>
                            <p class="small mb-0" style="font-size: 0.85rem; line-height: 1.4;">
                                {{ __('management.card1_text') }}
                            </p>
                        </div>
                    </div>

                    {{-- CARTE 2 : INDÉPENDANCE (Gris Bleu) --}}
                    <div class="col-md-4">
                        <div class="card h-100 border-0 text-white text-center p-3 d-flex flex-column justify-content-center"
                            style="background-color: #3b4d61; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                            <div class="mb-3">
                                <i class="fas fa-scale-balanced fa-3x"></i>
                            </div>
                            <h6 class="fw-bold text-uppercase mb-3" style="font-size: 0.9rem;">
                                {{ __('management.card2_title') }}
                            </h6>
                            <p class="small mb-0" style="font-size: 0.85rem; line-height: 1.4;">
                                {{ __('management.card2_text') }}
                            </p>
                        </div>
                    </div>

                    {{-- CARTE 3 : ACCOMPAGNEMENT (Doré/Moutarde) --}}
                    <div class="col-md-4">
                        <div class="card h-100 border-0 text-white text-center p-3 d-flex flex-column justify-content-center"
                            style="background-color: #967d28; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                            <div class="mb-3">
                                <i class="fas fa-users-line fa-3x"></i>
                            </div>
                            <h6 class="fw-bold text-uppercase mb-3" style="font-size: 0.9rem;">
                                {{ __('management.card3_title') }}
                            </h6>
                            <p class="small mb-0" style="font-size: 0.85rem; line-height: 1.4;">
                                {{ __('management.card3_text') }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- SECTION 3 : SERVICES COMPLETS (Version Compacte) --}}
<section class="section-padding p-0">
    <div class="container-fluid">
        <div class="row">

            {{-- COLONNE GAUCHE : Image (Réduite à col-lg-4 au lieu de 5) --}}
            <div class="col-lg-4 p-0 d-none d-lg-block"
                style="background-image: url('{{ asset('assets/img/management/section3.jpg') }}');
                        background-size: cover;
                        background-position: center;
                        min-height: 400px;"> {{-- Hauteur min réduite --}}
            </div>

            {{-- Image sur mobile --}}
            <div class="col-12 d-lg-none p-0">
                <img src="{{ asset('assets/img/management/section3.jpg') }}" class="img-fluid w-100" alt="VIP Services">
            </div>

            {{-- COLONNE DROITE : Contenu (Élargie à col-lg-8) --}}
            <div class="col-lg-8 text-white d-flex flex-column" style="background-color: #0c1524;">

                {{-- Partie Haute : Titre et Intro (Padding réduit p-4) --}}
                <div class="p-4">
                    {{-- Titre h3 au lieu de display-5 pour réduire la taille --}}
                    <h3 class="fw-bold mb-2 text-white">
                        {{ __('management.section3_title') }}
                    </h3>
                    {{-- Texte plus petit (font-size 0.95rem) --}}
                    <p class="text-white-50 mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                        {{ __('management.section3_p1') }}
                    </p>
                </div>

                {{-- Partie Basse : Les 4 Piliers --}}
                <div class="row g-0 flex-grow-1">

                    {{-- Pilier 1 --}}
                    <div class="col-md-3 p-3 text-center border-end border-secondary" style="background-color: #0c1524;">
                        <div class="mb-2 text-warning"><i class="fas fa-chart-line fa-2x"></i></div> {{-- Icône fa-2x --}}
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.8rem;">{{ __('management.pillar_1_title') }}</h6>
                        <p class="mb-0 text-white-50" style="font-size: 0.75rem; line-height: 1.4;">{{ __('management.pillar_1_desc') }}</p>
                    </div>

                    {{-- Pilier 2 --}}
                    <div class="col-md-3 p-3 text-center border-end border-secondary" style="background-color: #0c1524;">
                        <div class="mb-2 text-white"><i class="fas fa-scale-balanced fa-2x"></i></div>
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.8rem;">{{ __('management.pillar_2_title') }}</h6>
                        <p class="mb-0 text-white-50" style="font-size: 0.75rem; line-height: 1.4;">{{ __('management.pillar_2_desc') }}</p>
                    </div>

                    {{-- Pilier 3 --}}
                    <div class="col-md-3 p-3 text-center border-end border-secondary" style="background-color: #2c3e50;">
                        <div class="mb-2 text-warning"><i class="fas fa-umbrella fa-2x"></i></div>
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.8rem;">{{ __('management.pillar_3_title') }}</h6>
                        <p class="mb-0 text-white-50" style="font-size: 0.75rem; line-height: 1.4;">{{ __('management.pillar_3_desc') }}</p>
                    </div>

                    {{-- Pilier 4 --}}
                    <div class="col-md-3 p-3 text-center text-dark" style="background-color: #8B7500;">
                        <div class="mb-2 text-white"><i class="fas fa-landmark fa-2x"></i></div>
                        <h6 class="fw-bold text-uppercase mb-2 text-white" style="font-size: 0.8rem;">{{ __('management.pillar_4_title') }}</h6>
                        <p class="mb-0 text-white" style="font-size: 0.75rem; line-height: 1.4;">{{ __('management.pillar_4_desc') }}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- SECTION 4 : CLIENTÈLE EXIGEANTE (Style Image da5ec1) --}}
<section class="section-padding p-0">
    <div class="container-fluid">
        <div class="row">

            {{-- COLONNE GAUCHE : Contenu (Fond Bleu Foncé #0c1524) --}}
            <div class="col-lg-6 text-white d-flex flex-column justify-content-center p-5" style="background-color: #0c1524;">

                {{-- Titre --}}
                <h2 class="fw-bold display-6 mb-4 text-white">
                    {{ __('management.section4_title') }}
                </h2>

                {{-- Paragraphes --}}
                <div class="mb-5" style="font-size: 1rem; line-height: 1.6; color: #e0e0e0;">
                    <p class="mb-3">{{ __('management.section4_p1') }}</p>
                    <p class="mb-0">{{ __('management.section4_p2') }}</p>
                </div>

                {{-- Les 3 Icônes en bas (Alignées horizontalement) --}}
                <div class="row text-center mt-auto">

                    {{-- Icône 1 : Professionnels --}}
                    <div class="col-4 px-2">
                        <div class="mb-3 text-warning"><i class="fas fa-briefcase fa-2x"></i></div>
                        <h6 class="fw-bold text-white mb-2" style="font-size: 0.9rem;">{{ __('management.client_1_title') }}</h6>
                        <p class="small text-white-50 mb-0" style="font-size: 0.75rem; line-height: 1.3;">{{ __('management.client_1_desc') }}</p>
                    </div>

                    {{-- Icône 2 : Entrepreneurs --}}
                    <div class="col-4 px-2">
                        <div class="mb-3 text-warning"><i class="far fa-building fa-2x"></i></div>
                        <h6 class="fw-bold text-white mb-2" style="font-size: 0.9rem;">{{ __('management.client_2_title') }}</h6>
                        <p class="small text-white-50 mb-0" style="font-size: 0.75rem; line-height: 1.3;">{{ __('management.client_2_desc') }}</p>
                    </div>

                    {{-- Icône 3 : Familles --}}
                    <div class="col-4 px-2">
                        <div class="mb-3 text-warning"><i class="fas fa-money-bill-wave fa-2x"></i></div>
                        <h6 class="fw-bold text-white mb-2" style="font-size: 0.9rem;">{{ __('management.client_3_title') }}</h6>
                        <p class="small text-white-50 mb-0" style="font-size: 0.75rem; line-height: 1.3;">{{ __('management.client_3_desc') }}</p>
                    </div>

                </div>
            </div>

            {{-- COLONNE DROITE : Image (Homme à lunettes) --}}
            <div class="col-lg-6 p-0 d-none d-lg-block"
                style="background-image: url('{{ asset('assets/img/management/section4.jpg') }}');
                        background-size: cover;
                        background-position: center left;
                        min-height: 600px;">
            </div>

            {{-- Image Mobile --}}
            <div class="col-12 d-lg-none p-0">
                <img src="{{ asset('assets/img/management/section4.jpg') }}" class="img-fluid w-100" alt="Clientèle Exigeante">
            </div>

        </div>
    </div>
</section>

{{-- SECTION 5 : PARTENAIRES (Version SVG) --}}
<section class="section-padding p-0">
    <div class="container-fluid">
        <div class="row">

            {{-- COLONNE GAUCHE : Image Gratte-ciel --}}
            <div class="col-lg-3 p-0 d-none d-lg-block"
                style="background-image: url('{{ asset('assets/img/management/section5.jpg') }}');
                        background-size: cover;
                        background-position: center;
                        min-height: 400px;">
            </div>

            {{-- Image mobile --}}
            <div class="col-12 d-lg-none p-0">
                <img src="{{ asset('assets/img/management/section5.jpg') }}" class="img-fluid w-100" alt="Partenaires">
            </div>

            {{-- COLONNE DROITE : Contenu --}}
            <div class="col-lg-9 text-white p-4 d-flex flex-column justify-content-center" style="background-color: #0c1524;">

                <h3 class="fw-bold mb-3 text-white">
                    {{ __('management.partners_title') }}
                </h3>

                <p class="text-white-50 mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                    {{ __('management.partners_text') }}
                </p>

                {{-- 3 COLONNES comme sur l'image --}}
                <div class="row g-4 align-items-start">

                    {{-- COL 1 : INSTITUTIONS FINANCIÈRES --}}
                    <div class="col-12 col-lg-4 text-center">
                        <h6 class="fw-bold text-warning text-uppercase mb-3">
                            {{ __('management.partners_cat1') }}
                        </h6>

                        <div class="partner-grid">
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/bmo.svg') }}" class="partner-logo" alt="BMO">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/b2b.svg') }}" class="partner-logo" alt="B2B">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/rbc.svg') }}" class="partner-logo" alt="RBC">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/manulife.svg') }}" class="partner-logo" alt="Manulife">
                            </div>
                        </div>
                    </div>

                    {{-- COL 2 : COMPAGNIES D'ASSURANCE --}}
                    <div class="col-12 col-lg-4 text-center">
                        <h6 class="fw-bold text-warning text-uppercase mb-3">
                            {{ __('management.partners_cat2') }}
                        </h6>

                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/ia.svg') }}" class="partner-logo" alt="iA">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/canadalife.svg') }}" class="partner-logo" alt="Canada Life">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/assomption.svg') }}" class="partner-logo" alt="Assomption Vie">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('assets/img/management/sunlife.svg') }}" class="partner-logo" alt="Sun Life">
                            </div>
                        </div>
                    </div>

                    {{-- COL 3 : EXPERTS SPÉCIALISÉS --}}
                    <div class="col-12 col-lg-4 text-center">
                        <h6 class="fw-bold text-warning text-uppercase mb-3">
                            {{ __('management.partners_cat3') }}
                        </h6>
                        <div class="partner-item">
                            <p class="text-white-50 mb-0" style="line-height: 1.6;">
                                {{ __('management.partners_experts_list') }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>

{{-- SECTION 6 : CTA FINAL (Échange confidentiel) --}}
{{-- Basé sur l'image du livre/main sur bureau --}}
<section class="section-padding position-relative"
    style="background-image: url('{{ asset('assets/img/management/section6.jpg') }}');
                background-size: cover;
                background-position: center;
                padding: 100px 0;">

    {{-- Overlay très sombre --}}
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7);"></div>

    <div class="container position-relative z-2">
        <div class="row justify-content-end"> {{-- Contenu aligné à droite --}}
            <div class="col-lg-6 text-white">
                <h2 class="fw-bold display-5 mb-3">{{ __('management.cta_final_title') }}</h2>

                <p class="lead mb-4 text-white-50">
                    {{ __('management.cta_final_text') }}
                </p>

                <p class="mb-4">
                    {{ __('management.cta_final_subtext') }}
                </p>

                <a href="{{ url('/rendez-vous') }}" class="btn btn-warning rounded-pill px-5 py-3 fw-bold text-dark shadow hover-lift">
                    {{ __('management.btn_contact_final') }}
                </a>

                <p class="small text-white-50 mt-3 mb-0">
                    {{ __('management.cta_garantie') }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Style CSS --}}
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    /* grille centrée (2 logos par rangée sur desktop, 2 aussi sur mobile) */
    .partner-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px 36px;
        /* vertical / horizontal */
        align-items: center;
        justify-items: center;
        /* centre chaque logo */
        margin-top: 10px;
    }

    /* "case" uniforme */
    .partner-item {
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* taille logique (130px est trop gros et casse l’alignement) */
    .partner-logo {
        height: 130px;
        /* ajuste 48-60 selon ton goût */
        width: auto;
        max-width: 170px;
        opacity: .85;
        filter: brightness(0) invert(1);
        transition: all .25s ease;
    }

    .partner-logo:hover {
        opacity: 1;
        transform: scale(1.06);
    }

    /* sur mobile on peut garder 2 colonnes, ou passer à 1 si tu préfères */
    @media (max-width: 576px) {
        .partner-logo {
            height: 44px;
        }
    }
</style>

@include('partials.footer')