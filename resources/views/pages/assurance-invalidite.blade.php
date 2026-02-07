@include('partials.header')

{{-- SECTION 1 : INTRODUCTION HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-warning text-dark mb-2">Protection du revenu</span>
                <h1 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('assurance-invalidite.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p class="lead">{{ __('assurance-invalidite.intro_text_1') }}</p>
                    <p>{{ __('assurance-invalidite.intro_text_2') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('assurance-invalidite.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('assurance-invalidite.btn_contact') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                {{-- Image Hero --}}
                <img src="{{ asset('assets/img/A-cote-texte-invalidite-introduction.jpg') }}" alt="Assurance invalidité" class="section-img rounded shadow hover-lift w-100">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : POURQUOI ESSENTIEL & CIBLE (Mélange des sections) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">
            {{-- Pourquoi essentiel --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite.why_essential_title') }}</h3>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex"><i class="fas fa-exclamation-circle text-warning me-3 mt-1"></i> {{ __('assurance-invalidite.why_point_1') }}</li>
                    <li class="mb-3 d-flex"><i class="fas fa-exclamation-circle text-warning me-3 mt-1"></i> {{ __('assurance-invalidite.why_point_2') }}</li>
                    <li class="mb-3 d-flex"><i class="fas fa-exclamation-circle text-warning me-3 mt-1"></i> {{ __('assurance-invalidite.why_point_3') }}</li>
                    <li class="mb-3 d-flex"><i class="fas fa-exclamation-circle text-warning me-3 mt-1"></i> {{ __('assurance-invalidite.why_point_4') }}</li>
                </ul>
            </div>
            {{-- À qui ça s'adresse --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite.target_title') }}</h3>
                <p>{{ __('assurance-invalidite.target_desc') }}</p>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-invalidite.target_1') }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-invalidite.target_2') }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-invalidite.target_3') }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-invalidite.target_4') }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-invalidite.target_5') }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-invalidite.target_6') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : TYPES ET COUVERTURE (GRID) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-invalidite.types_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4 mb-5">
            {{-- Court terme --}}
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift border-top border-4 border-info">
                    <div class="mb-3"><i class="fas fa-stopwatch fa-3x text-info"></i></div>
                    <h4 class="fw-bold mb-3">{{ __('assurance-invalidite.short_term_title') }}</h4>
                    <p>{{ __('assurance-invalidite.short_term_desc') }}</p>
                    <ul class="list-unstyled bg-light p-3 rounded">
                        <li class="mb-2 small"><strong>{{ __('assurance-invalidite.short_term_duration') }}</strong></li>
                        <li class="mb-2 small"><strong>{{ __('assurance-invalidite.short_term_amount') }}</strong></li>
                        <li class="small"><i class="fas fa-lightbulb text-warning me-1"></i> {{ __('assurance-invalidite.short_term_ideal') }}</li>
                    </ul>
                </div>
            </div>
            {{-- Long terme --}}
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift border-top border-4 border-primary">
                    <div class="mb-3"><i class="fas fa-hourglass-half fa-3x text-primary"></i></div>
                    <h4 class="fw-bold mb-3">{{ __('assurance-invalidite.long_term_title') }}</h4>
                    <p>{{ __('assurance-invalidite.long_term_desc') }}</p>
                    <ul class="list-unstyled bg-light p-3 rounded">
                        <li class="mb-2 small"><strong>{{ __('assurance-invalidite.long_term_duration') }}</strong></li>
                        <li class="mb-2 small"><strong>{{ __('assurance-invalidite.long_term_amount') }}</strong></li>
                        <li class="small"><i class="fas fa-lightbulb text-warning me-1"></i> {{ __('assurance-invalidite.long_term_ideal') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Que couvre-t-elle (Liste Grid) --}}
        <h4 class="fw-bold mb-4 text-center">{{ __('assurance-invalidite.coverage_title') }}</h4>
        <div class="row g-3">
            @foreach(range(1, 6) as $i)
            <div class="col-md-4">
                <div class="d-flex align-items-center p-3 border rounded shadow-sm h-100">
                    <i class="fas fa-shield-alt text-success me-3"></i>
                    <span>{{ __('assurance-invalidite.cover_' . $i) }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 4 : AIDE-MÉMOIRE & DÉFINITIONS (IMPORTANT) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            {{-- Colonne Gauche : Termes Clés --}}
            <div class="col-lg-5 mb-4">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite.terms_title') }}</h3>
                <div class="accordion shadow-sm" id="termsAccordion">
                    @foreach(range(1, 4) as $i)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $i!=1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#term{{$i}}">
                                <strong>{{ __('assurance-invalidite.term_' . $i . '_title') }}</strong>
                            </button>
                        </h2>
                        <div id="term{{$i}}" class="accordion-collapse collapse {{ $i==1 ? 'show' : '' }}" data-bs-parent="#termsAccordion">
                            <div class="accordion-body">
                                {{ __('assurance-invalidite.term_' . $i . '_desc') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Colonne Droite : Définitions Invalidité (Tableau Comparatif) --}}
            <div class="col-lg-7">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite.def_title') }}</h3>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('assurance-invalidite.def_th1') }}</th>
                                        <th>{{ __('assurance-invalidite.def_th2') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-success">{{ __('assurance-invalidite.def_propre_title') }}</td>
                                        <td>{{ __('assurance-invalidite.def_propre_desc') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-warning">{{ __('assurance-invalidite.def_habituelle_title') }}</td>
                                        <td>{{ __('assurance-invalidite.def_habituelle_desc') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-danger">{{ __('assurance-invalidite.def_toute_title') }}</td>
                                        <td>{{ __('assurance-invalidite.def_toute_desc') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3 p-3 bg-white border-start border-4 border-warning shadow-sm">
                    <small class="text-muted">
                        <em>{{ __('assurance-invalidite.def1_toute_desc') }}</em>
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : SOUSCRIPTION & EMPLOYEURS (SEO) --}}
<section class="section-padding bg-white">
    <div class="container">
        {{-- Comment souscrire --}}
        <div class="mb-5">
            <h2 class="fw-bold text-center mb-4">{{ __('assurance-invalidite.subscribe_title') }}</h2>
            <div class="row g-4">

                {{-- 1. Assurance Collective (Lien vers /assurance-invalidite-de-groupe) --}}
                <div class="col-md-6">
                    <a href="{{ url('/assurance/assurance-invalidite-de-groupe') }}" class="text-decoration-none text-dark">
                        <div class="p-4 bg-light rounded shadow-sm h-100 hover-lift border border-light">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-building fa-2x text-primary me-3"></i>
                                <h4 class="mb-0 fw-bold">{{ __('assurance-invalidite.sub_collective_title') }}</h4>
                            </div>
                            <p class="mb-0">{{ __('assurance-invalidite.sub_collective_desc') }}</p>
                            <div class="mt-3 text-end">
                                <span class="btn btn-sm btn-outline-primary rounded-pill">{{ __('assurance-invalidite.sub_btn') }}<i class="fas fa-arrow-right ms-1"></i></span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- 2. Assurance Individuelle (Lien vers /assurance-invalidite-individuelle) --}}
                <div class="col-md-6">
                    <a href="{{ url('/assurance/assurance-invalidite-individuelle') }}" class="text-decoration-none text-dark">
                        <div class="p-4 bg-light rounded shadow-sm h-100 hover-lift border border-light">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-user-shield fa-2x text-primary me-3"></i>
                                <h4 class="mb-0 fw-bold">{{ __('assurance-invalidite.sub_individual_title') }}</h4>
                            </div>
                            <p class="mb-0">{{ __('assurance-invalidite.sub_individual_desc') }}</p>
                            <div class="mt-3 text-end">
                                <span class="btn btn-sm btn-outline-primary rounded-pill">{{ __('assurance-invalidite.sub_btn') }}<i class="fas fa-arrow-right ms-1"></i></span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        {{-- SEO Avantages Employeurs --}}
        <div class="card border-0 shadow bg-dark text-white p-4 p-md-5">
            <h3 class="fw-bold mb-4 text-warning">{{ __('assurance-invalidite.employer_title') }}</h3>
            <p class="lead mb-4">{{ __('assurance-invalidite.emp_intro') }}</p>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <i class="fas fa-users fa-2x mb-2 text-warning"></i>
                    <h6 class="fw-bold">{{ __('assurance-invalidite.emp_retention') }}</h6>
                    <p class="small opacity-75">{{ __('assurance-invalidite.emp_retention_desc') }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-magnet fa-2x mb-2 text-warning"></i>
                    <h6 class="fw-bold">{{ __('assurance-invalidite.emp_attraction') }}</h6>
                    <p class="small opacity-75">{{ __('assurance-invalidite.emp_attraction_desc') }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-notes-medical fa-2x mb-2 text-warning"></i>
                    <h6 class="fw-bold">{{ __('assurance-invalidite.emp_absenteeism') }}</h6>
                    <p class="small opacity-75">{{ __('assurance-invalidite.emp_absenteeism_desc') }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-chart-line fa-2x mb-2 text-warning"></i>
                    <h6 class="fw-bold">{{ __('assurance-invalidite.emp_productivity') }}</h6>
                    <p class="small opacity-75">{{ __('assurance-invalidite.emp_productivity_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 : FAQ & CONSEILLER --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            {{-- FAQ --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h3 class="fw-bold mb-4 text-primary">{{ __('assurance-invalidite.faq_title') }}</h3>
                <div class="accordion" id="faqAccordion">
                    @foreach(range(1, 5) as $i)
                    <div class="accordion-item mb-2 border-0 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{$i}}">
                                {{ __('assurance-invalidite.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="faq{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ __('assurance-invalidite.faq_a' . $i) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Carte Conseiller --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow p-4 text-center" style="background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="mb-4">
                            <img src="{{ asset('assets/img/VIP_Logo_Gold_Gradient10.png') }}" width="100" alt="Logo">
                        </div>
                        <h3 class="fw-bold mb-3">{{ __('assurance-invalidite.advisor_title') }}</h3>
                        <p class="text-muted mb-4">{{ __('assurance-invalidite.advisor_text') }}</p>
                        <h5 class="fw-bold text-primary mb-4">{{ __('assurance-invalidite.advisor_cta') }}</h5>
                        <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-5 py-3 shadow hover-lift text-white fw-bold">
                            {{ __('assurance-invalidite.btn_quote') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }
</style>

@include('partials.footer')