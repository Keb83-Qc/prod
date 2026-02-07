@include('partials.header')

{{-- SECTION 1 : INTRO HERO (DYNAMIQUE VIA CONTROLLER) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-success text-white mb-2">Santé & Bien-être</span>

                {{-- Utilisation des variables du contrôleur --}}
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ $header_title }}</h1>
                <h4 class="text-muted mb-4">{{ $header_subtitle }}</h4>

                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('assurance-complementaire-dentaire.intro_p1') }}</p>
                    <p>{{ __('assurance-complementaire-dentaire.intro_p2') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('assurance-complementaire-dentaire.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('assurance-complementaire-dentaire.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- L'image est aussi passée par le contrôleur --}}
                <img src="{{ $header_bg }}" alt="{{ $header_title }}" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : POURQUOI ESSENTIEL (2 COLONNES) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-complementaire-dentaire.essential_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/african-social-worker-taking-care-senior-woman.jpg') }}" alt="Soins de santé" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6">
                <div class="mb-4">
                    <h4 class="fw-bold text-primary"><i class="fas fa-pills me-2"></i> {{ __('assurance-complementaire-dentaire.meds_title') }}</h4>
                    <p class="text-muted">{{ __('assurance-complementaire-dentaire.meds_text') }}</p>
                </div>
                <div>
                    <h4 class="fw-bold text-primary"><i class="fas fa-tooth me-2"></i> {{ __('assurance-complementaire-dentaire.dental_title') }}</h4>
                    <p class="text-muted">{{ __('assurance-complementaire-dentaire.dental_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : CE QUE ÇA COUVRE (GRILLE D'ICÔNES) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-complementaire-dentaire.coverage_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-complementaire-dentaire.coverage_intro') }}</p>
        </div>

        <div class="row g-4">
            {{-- Médicaments --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-danger"><i class="fas fa-prescription-bottle-alt fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('assurance-complementaire-dentaire.cov_1_title') }}</h5>
                    <p class="small text-muted">{{ __('assurance-complementaire-dentaire.cov_1_desc') }}</p>
                </div>
            </div>
            {{-- Dentaire --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-info"><i class="fas fa-tooth fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('assurance-complementaire-dentaire.cov_2_title') }}</h5>
                    <p class="small text-muted">{{ __('assurance-complementaire-dentaire.cov_2_desc') }}</p>
                </div>
            </div>
            {{-- Paramédical --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-success"><i class="fas fa-user-md fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('assurance-complementaire-dentaire.cov_3_title') }}</h5>
                    <p class="small text-muted">{{ __('assurance-complementaire-dentaire.cov_3_desc') }}</p>
                </div>
            </div>
            {{-- Vue --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-dark"><i class="fas fa-glasses fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('assurance-complementaire-dentaire.cov_4_title') }}</h5>
                    <p class="small text-muted">{{ __('assurance-complementaire-dentaire.cov_4_desc') }}</p>
                </div>
            </div>
            {{-- Voyage --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-warning"><i class="fas fa-plane-departure fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('assurance-complementaire-dentaire.cov_5_title') }}</h5>
                    <p class="small text-muted">{{ __('assurance-complementaire-dentaire.cov_5_desc') }}</p>
                </div>
            </div>
            {{-- Divers --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-secondary"><i class="fas fa-ambulance fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('assurance-complementaire-dentaire.cov_6_title') }}</h5>
                    <p class="small text-muted">{{ __('assurance-complementaire-dentaire.cov_6_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : STATISTIQUES --}}
<section class="section-padding bg-dark text-white">
    <div class="container">
        <h3 class="fw-bold text-center mb-5 text-warning">{{ __('assurance-complementaire-dentaire.stats_title') }}</h3>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <h2 class="fw-bold text-white">70%</h2>
                <p class="small opacity-75">{{ __('assurance-complementaire-dentaire.stat_1') }}</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-white">48.2 G$</h2>
                <p class="small opacity-75">{{ __('assurance-complementaire-dentaire.stat_2') }}</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-white">1 / 4</h2>
                <p class="small opacity-75">{{ __('assurance-complementaire-dentaire.stat_3') }}</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-white">+45%</h2>
                <p class="small opacity-75">{{ __('assurance-complementaire-dentaire.stat_4') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : FOCUS DENTAIRE --}}
<section class="section-padding bg-light">
    <div class="container">
        {{-- J'ai ajouté 'align-items-center' pour que l'image soit centrée verticalement par rapport au texte --}}
        <div class="row g-5 align-items-center">
            {{-- Colonne Gauche : Texte --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('assurance-complementaire-dentaire.dental_focus_title') }}</h3>
                <p class="text-muted mb-4">{{ __('assurance-complementaire-dentaire.dental_focus_intro') }}</p>

                <div class="accordion shadow-sm mb-4" id="dentalAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headCost">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCost">
                                {{ __('assurance-complementaire-dentaire.dental_cost_title') }}
                            </button>
                        </h2>
                        <div id="collapseCost" class="accordion-collapse collapse show" data-bs-parent="#dentalAccordion">
                            <div class="accordion-body small text-muted">
                                {{ __('assurance-complementaire-dentaire.dental_cost_text') }}
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headPay">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePay">
                                {{ __('assurance-complementaire-dentaire.dental_payment_title') }}
                            </button>
                        </h2>
                        <div id="collapsePay" class="accordion-collapse collapse" data-bs-parent="#dentalAccordion">
                            <div class="accordion-body small text-muted">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-coins text-warning me-2"></i> {{ __('assurance-complementaire-dentaire.dental_payment_1') }}</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-complementaire-dentaire.dental_payment_2') }}</li>
                                    <li><i class="fas fa-hospital text-primary me-2"></i> {{ __('assurance-complementaire-dentaire.dental_payment_3') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info border-0 shadow-sm">
                    <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i> {{ __('assurance-complementaire-dentaire.dental_prevention_title') }}</h6>
                    <p class="small mb-0">{{ __('assurance-complementaire-dentaire.dental_prevention_text') }}</p>
                </div>
            </div>

            {{-- Colonne Droite : Image Unique (Plus propre) --}}
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/female-dentist-holding-dental-model-hands-concept-dentistry-dental-treatment.jpg') }}"
                    alt="Dentiste" class="img-fluid rounded shadow w-100 object-fit-cover" style="min-height: 450px;">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 : FAQ & CTA --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <h3 class="fw-bold mb-4 text-primary">{{ __('assurance-complementaire-dentaire.faq_title') }}</h3>
                <div class="accordion shadow-sm" id="faqGlobal">
                    @foreach(range(1, 3) as $i)
                    <div class="accordion-item mb-2 border-0 rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingFAQ{{$i}}">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFAQ{{$i}}">
                                {{ __('assurance-complementaire-dentaire.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="collapseFAQ{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqGlobal">
                            <div class="accordion-body bg-light text-muted small">
                                {!! __('assurance-complementaire-dentaire.faq_a' . $i) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-lg h-100 overflow-hidden">
                    <img src="{{ asset('assets/img/view-hands-with-heart-shape-represent-affection.jpg') }}" alt="Protection" class="card-img-top object-fit-cover" style="height: 200px;">
                    <div class="card-body p-4 text-center bg-dark text-white">
                        <h4 class="fw-bold text-warning mb-3">{{ __('assurance-complementaire-dentaire.cta_title') }}</h4>
                        <p class="small mb-4 opacity-75">{{ __('assurance-complementaire-dentaire.cta_text') }}</p>
                        <a href="{{ url('/rendez-vous') }}" class="btn btn-warning rounded-pill px-5 fw-bold text-dark hover-scale">
                            {{ __('assurance-complementaire-dentaire.cta_btn') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 7 : ZONE CONSEILS --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-complementaire-dentaire.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-complementaire-dentaire.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-heartbeat fa-3x"></i></div>
                <p class="text-muted">{{ __('assurance-complementaire-dentaire.blog_no_article') }}</p>
            </div>
            @elseif(isset($conseils))
            @foreach($conseils as $post)
            @php
            $lang = app()->getLocale();
            $title = ($lang == 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
            $rawContent = ($lang == 'en' && !empty($post->content_en)) ? $post->content_en : $post->content;
            $desc = Str::limit(strip_tags(html_entity_decode($rawContent)), 100, '...');
            $imgSrc = !empty($post->image) ? asset($post->image) : asset('assets/img/default.jpg');
            $link = url('/article/' . $post->id);
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div style="height: 200px; background-color: #ddd; background-image: url('{{ $imgSrc }}'); background-size: cover; background-position: center;"></div>
                    <div class="card-body text-center p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small text-uppercase">
                            <i class="far fa-calendar-alt text-warning me-1"></i> {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('assurance-complementaire-dentaire.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
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

    .hover-scale:hover {
        transform: scale(1.05);
        transition: transform 0.3s;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: var(--primary-color);
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.1);
    }
</style>

@include('partials.footer')