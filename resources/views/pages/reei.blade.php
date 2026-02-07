@include('partials.header')

{{-- 1. HERO SECTION --}}
<section class="section-padding bg-light position-relative overflow-hidden"
    style="padding-top: 120px; padding-bottom: 80px;">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge bg-primary mb-3 fw-bold px-3 py-2 rounded-pill">
                    {{ __('menu.rdsp') }}
                </span>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ __('reei.title') }}
                </h1>
                <p class="lead text-secondary mb-4" style="font-size: 1.2rem;">
                    {{ __('reei.subtitle') }}
                </p>
                <a href="{{ url('/contact') }}" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm">
                    {{ __('reei.cta_btn') }}
                </a>
            </div>
            <div class="col-lg-6">
                {{-- Utilisation de l'image passée par le contrôleur ou fallback --}}
                <img src="{{ $header_bg ?? asset('assets/img/En-tete-REER.jpg') }}" alt="REEI Family"
                    class="img-fluid rounded-4 shadow-lg border border-4 border-white">
            </div>
        </div>
    </div>
</section>

{{-- 2. DÉFINITION & INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-7">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('reei.what_is_title') }}</h3>
                <p class="text-muted mb-4 lead">
                    {{ __('reei.what_is_text') }}
                </p>
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <i class="fas fa-umbrella fa-2x text-warning me-3"></i>
                            <div>
                                <h6 class="fw-bold">{{ __('reei.tax_shelter_title') }}</h6>
                                <p class="small text-muted">{{ __('reei.tax_shelter_text') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <i class="fas fa-file-invoice-dollar fa-2x text-warning me-3"></i>
                            <div>
                                <h6 class="fw-bold">{{ __('reei.non_deductible_title') }}</h6>
                                <p class="small text-muted">{{ __('reei.non_deductible_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bloc Info CIPH (DTC) --}}
            <div class="col-lg-5">
                <div class="p-4 bg-light rounded-3 shadow-sm border-start border-4 border-primary">
                    <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>{{ __('reei.ciph_info_title') }}
                    </h5>
                    <p class="text-muted fst-italic mb-0">
                        {{ __('reei.ciph_info_text') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. ADMISSIBILITÉ & CARACTÉRISTIQUES --}}
<section class="section-padding" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            {{-- Admissibilité --}}
            <div class="col-lg-6">
                <div class="bg-white p-5 rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold mb-4">{{ __('reei.eligibility_title') }}</h3>
                    <p class="mb-4">{{ __('reei.eligibility_intro') }}</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i> {{ __('reei.condition_ciph') }}
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                            {{ __('reei.condition_residence') }}
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i> {{ __('reei.condition_age') }}
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i> {{ __('reei.condition_sin') }}
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Chiffres clés (Grid) --}}
            <div class="col-lg-6">
                <div class="row g-3 h-100">
                    <div class="col-6">
                        <div
                            class="bg-white p-4 rounded-4 shadow-sm h-100 text-center border-bottom border-4 border-warning">
                            <div class="text-muted small text-uppercase fw-bold mb-2">
                                {{ __('reei.spec_limit_lifetime') }}
                            </div>
                            <h3 class="fw-bold text-dark">{{ __('reei.spec_limit_lifetime_val') }}</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div
                            class="bg-white p-4 rounded-4 shadow-sm h-100 text-center border-bottom border-4 border-warning">
                            <div class="text-muted small text-uppercase fw-bold mb-2">{{ __('reei.spec_limit_annual') }}
                            </div>
                            <h3 class="fw-bold text-dark">{{ __('reei.spec_limit_annual_val') }}</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 d-flex align-items-center">
                            <i class="far fa-calendar-alt fa-3x text-warning me-4"></i>
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">{{ __('reei.spec_deadline') }}
                                </div>
                                <h5 class="fw-bold mb-0">{{ __('reei.spec_deadline_val') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 d-flex align-items-center">
                            <i class="fas fa-users fa-3x text-warning me-4"></i>
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">{{ __('reei.spec_contributor') }}
                                </div>
                                <h5 class="fw-bold mb-0">{{ __('reei.spec_contributor_val') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. SUBVENTIONS (Highlight) --}}
<section class="section-padding text-white position-relative"
    style="background: linear-gradient(135deg, #0E1030 0%, #2a2d5c 100%);">
    <div class="container position-relative z-1">
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark mb-2">Max. 90 000 $</span>
            <h2 class="fw-bold display-5">{{ __('reei.grants_title') }}</h2>
            <p class="lead opacity-75">{{ __('reei.grants_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- SCEI --}}
            <div class="col-lg-5">
                <div class="p-4 rounded-4 h-100 border border-secondary bg-white bg-opacity-10 backdrop-blur">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="fw-bold h4">{{ __('reei.scei_name') }}</h3>
                        <i class="fas fa-gift fa-2x text-warning"></i>
                    </div>
                    <h2 class="text-warning fw-bold mb-3">{{ __('reei.scei_max') }}</h2>
                    <ul class="list-unstyled opacity-75">
                        <li class="mb-2"><i class="fas fa-check me-2"></i> {{ __('reei.scei_desc') }}</li>
                        <li><i class="fas fa-check me-2"></i> {{ __('reei.scei_annual') }}</li>
                    </ul>
                </div>
            </div>

            {{-- BCEI --}}
            <div class="col-lg-5">
                <div class="p-4 rounded-4 h-100 border border-secondary bg-white bg-opacity-10 backdrop-blur">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="fw-bold h4">{{ __('reei.bcei_name') }}</h3>
                        <i class="fas fa-hand-holding-heart fa-2x text-info"></i>
                    </div>
                    <h2 class="text-info fw-bold mb-3">{{ __('reei.bcei_max') }}</h2>
                    <ul class="list-unstyled opacity-75">
                        <li class="mb-2"><i class="fas fa-check me-2"></i> {{ __('reei.bcei_desc') }}</li>
                        <li><i class="fas fa-check me-2"></i> {{ __('reei.bcei_annual') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 5. AVANTAGES & PLACEMENTS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5">
            {{-- Avantages --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('reei.benefits_title') }}</h3>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-light rounded-circle p-3 text-warning">
                            <i class="fas fa-shield-alt fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('reei.benefit_security') }}</h5>
                        <p class="text-muted mb-0">{{ __('reei.benefit_security_desc') }}</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-light rounded-circle p-3 text-warning">
                            <i class="fas fa-user-check fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('reei.benefit_social') }}</h5>
                        <p class="text-muted mb-0">{{ __('reei.benefit_social_desc') }}</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-light rounded-circle p-3 text-warning">
                            <i class="fas fa-hand-holding-medical fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('reei.benefit_flexibility') }}</h5>
                        <p class="text-muted mb-0">{{ __('reei.benefit_flexibility_desc') }}</p>
                    </div>
                </div>
            </div>

            {{-- Placements --}}
            <div class="col-lg-6">
                <div class="bg-light p-5 rounded-4 h-100">
                    <h4 class="fw-bold mb-4">{{ __('reei.investments_title') }}</h4>
                    <ul class="row list-unstyled gy-3">
                        <li class="col-md-6"><i class="fas fa-chart-pie text-secondary me-2"></i>
                            {{ __('reei.inv_funds') }}
                        </li>
                        <li class="col-md-6"><i class="fas fa-certificate text-secondary me-2"></i>
                            {{ __('reei.inv_cpg') }}
                        </li>
                        <li class="col-md-6"><i class="fas fa-chart-line text-secondary me-2"></i>
                            {{ __('reei.inv_stocks') }}
                        </li>
                        <li class="col-md-6"><i class="fas fa-layer-group text-secondary me-2"></i>
                            {{ __('reei.inv_etf') }}
                        </li>
                        <li class="col-md-6"><i class="fas fa-file-contract text-secondary me-2"></i>
                            {{ __('reei.inv_bonds') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 6. FAQ --}}
<section class="section-padding" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">{{ __('reei.faq_title') }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion shadow-sm" id="faqAccordion">
                    {{-- Loop manuel pour l'ordre précis --}}
                    @foreach(['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7'] as $key)
                    <div class="accordion-item border-0 mb-2 rounded overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $key }}">
                                {{ __('reei.'.$key) }}
                            </button>
                        </h2>
                        <div id="{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                {{ __('reei.'.str_replace('q', 'a', $key)) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center">
            <h2 class="fw-bold mb-3">{{ __('reei.final_cta_title') }}</h2>
            <p class="text-muted mb-4">{{ __('reei.final_cta_text') }}</p>
            <a href="{{ url('/contact') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                {{ __('reei.cta_btn') }}
            </a>
        </div>
    </div>
</section>

<style>
    .backdrop-blur {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(14, 16, 48, 0.05);
        color: var(--primary-color);
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(14, 16, 48, 0.1);
    }
</style>

@include('partials.footer')