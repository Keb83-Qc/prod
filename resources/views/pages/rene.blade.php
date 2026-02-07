@include('partials.header')

{{-- SECTION 1 : INTRODUCTION --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4 text-primary">{{ __('rene.section1_title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('rene.section1_p1') }}</p>
                    <p>{{ __('rene.section1_p2') }}</p>
                    <p class="fw-bold">{{ __('rene.section1_list_title') }}</p>
                    <ul class="list-unstyled">
                        @foreach(__('rene.section1_list') as $item)
                        <li><i class="fas fa-check text-success me-2"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                    <p class="fst-italic text-muted">{{ __('rene.section1_conclusion') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}"
                        class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">Obtenir une
                        consultation</a>
                    <a href="{{ url('/contact') }}"
                        class="btn btn-outline-dark rounded-pill px-4 shadow-sm">Contactez-nous</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/img/Quest-ce-quun-regime-depargne-non-enregistre.jpg') }}" alt="RENE"
                    class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : FISCALITÉ --}}
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">{{ __('rene.fiscality_title') }}</h2>
        <p class="text-center text-muted mb-5">{{ __('rene.fiscality_intro') }}</p>
        <div class="row g-4">
            @foreach(__('rene.fiscality_items') as $item)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4">
                    <div class="text-warning mb-3"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                    <h5 class="fw-bold">{{ $item['title'] }}</h5>
                    <p class="small text-muted mb-0">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <p class="mt-5 text-center fst-italic text-muted px-lg-5">{{ __('rene.fiscality_conclusion') }}</p>
    </div>
</section>

{{-- SECTION 3 : À QUOI ÇA SERT & CIBLE --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="p-4 bg-light rounded-4 h-100 shadow-sm">
                    <h3 class="fw-bold mb-4 text-primary"><i class="fas fa-bullseye me-2"></i>
                        {{ __('rene.utility_title') }}
                    </h3>
                    <ul class="list-group list-group-flush bg-transparent">
                        @foreach(__('rene.utility_list') as $item)
                        <li class="list-group-item bg-transparent border-0 ps-0 text-dark"><i
                                class="fas fa-arrow-right text-warning me-2"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-dark text-white rounded-4 h-100 shadow">
                    <h3 class="fw-bold mb-4 text-warning"><i class="fas fa-user-check me-2"></i>
                        {{ __('rene.target_title') }}
                    </h3>
                    <ul class="list-unstyled">
                        @foreach(__('rene.target_list') as $item)
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : FAQ COMPLÈTE --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- FAQ STANDARD --}}
                <h2 class="text-center fw-bold mb-5">{{ __('rene.faq_title') }}</h2>
                <div class="accordion shadow-sm mb-5" id="faqRene">
                    @foreach(__('rene.faqs') as $i => $faq)
                    <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#faqRene">
                            <div class="accordion-body text-muted bg-white">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- FAQ AVANCÉE --}}
                <h2 class="text-center fw-bold mt-5 mb-5">{{ __('rene.faq_advanced_title') }}</h2>
                <div class="accordion shadow-sm" id="faqAdvanced">
                    @foreach(__('rene.faqs_advanced') as $j => $faq)
                    <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqa{{ $j }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faqa{{ $j }}" class="accordion-collapse collapse" data-bs-parent="#faqAdvanced">
                            <div class="accordion-body text-muted bg-white">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

@include('partials.footer')