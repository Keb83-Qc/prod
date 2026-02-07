@include('partials.header')

{{-- SECTION 1 : INTRODUCTION --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="fw-bold mb-4 text-primary">{{ __('assurance-maladie-grave.intro_definition') }}</h2>
                <p class="lead text-muted">{{ __('assurance-maladie-grave.definition_text') }}</p>
                <h4 class="fw-bold mt-5 mb-3">{{ __('assurance-maladie-grave.covered_illnesses_title') }}</h4>
                <p>{{ __('assurance-maladie-grave.covered_illnesses_text') }}</p>
                <div class="row">
                    @foreach(__('assurance-maladie-grave.illnesses_list') as $illness)
                    <div class="col-md-6 mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check text-warning me-2"></i>
                            <span>{{ $illness }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <img src="{{ asset('assets/img/A-cote-texte-Maladies-Graves.jpg') }}" class="img-fluid rounded-4 shadow"
                    alt="Maladies Graves">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : RAMQ --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5 align-items-center flex-lg-row-reverse">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">{{ __('assurance-maladie-grave.ramq_vs_title') }}</h2>
                <p>{{ __('assurance-maladie-grave.ramq_description') }}</p>
                <div class="p-4 bg-white rounded-4 shadow-sm border-start border-4 border-danger">
                    <h5 class="fw-bold text-danger mb-3">{{ __('assurance-maladie-grave.ramq_not_covered_title') }}</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach(__('assurance-maladie-grave.ramq_not_covered_list') as $item)
                        <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <p class="mt-4 fst-italic text-muted">{{ __('assurance-maladie-grave.ramq_conclusion') }}</p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/AdobeStock_727436851.jpg') }}" class="img-fluid rounded-4 shadow"
                    alt="RAMQ vs Private">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : COUTS RÉELS --}}
<section class="section-padding bg-white">
    <div class="container">
        <h2 class="text-center fw-bold mb-2">{{ __('assurance-maladie-grave.real_costs_title') }}</h2>
        <p class="text-center text-muted mb-5">{{ __('assurance-maladie-grave.real_costs_intro') }}</p>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-4 rounded-4 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">{{ __('assurance-maladie-grave.cost_1_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-maladie-grave.cost_1_text') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-4 rounded-4 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">{{ __('assurance-maladie-grave.cost_2_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-maladie-grave.cost_2_text') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-4 rounded-4 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">{{ __('assurance-maladie-grave.cost_3_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-maladie-grave.cost_3_text') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-4 rounded-4 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">{{ __('assurance-maladie-grave.cost_4_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-maladie-grave.cost_4_text') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-5 p-4 bg-warning bg-opacity-10 border-start border-4 border-warning rounded text-center">
            <p class="mb-0 fw-bold text-dark"><i class="fas fa-exclamation-triangle me-2"></i>
                {{ __('assurance-maladie-grave.impact_stats') }}
            </p>
        </div>
    </div>
</section>

{{-- SECTION 4 : SAVIEZ-VOUS QUE --}}
<section class="section-padding bg-dark text-white">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">{{ __('assurance-maladie-grave.did_you_know_title') }}</h2>
        <div class="row g-4">
            @foreach(__('assurance-maladie-grave.did_you_know_items') as $stat)
            <div class="col-md-6">
                <div class="d-flex mb-4">
                    <i class="fas fa-chart-line text-warning fa-2x me-3"></i>
                    <p class="mb-0">{{ $stat }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 5 : FAQ --}}
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">{{ __('assurance-maladie-grave.faqs_title') }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqMG">
                    @foreach(__('assurance-maladie-grave.faqs') as $index => $faq)
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq{{ $index }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqMG">
                            <div class="accordion-body text-muted">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SOURCES --}}
<div class="container py-4 border-top">
    <small class="text-muted">
        <strong>{{ __('assurance-maladie-grave.sources_title') }}</strong>
        <ul class="list-inline mt-2">
            @foreach(__('assurance-maladie-grave.sources_list') as $source)
            <li class="list-inline-item">• {{ $source }}</li>
            @endforeach
        </ul>
    </small>
</div>

@include('partials.footer')