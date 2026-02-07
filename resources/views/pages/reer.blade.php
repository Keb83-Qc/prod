@include('partials.header')

{{-- SECTION 1 : INTRO HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-success text-white mb-2">Épargne & Retraite</span>
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('reer.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('reer.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('reer.intro_p1') }}</p>
                    <p>{{ __('reer.intro_p2') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('reer.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('reer.btn_contact') }}
                    </a>
                    <a href="https://calculatrices-financieres.ca/#/epargne" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">
                        <i class="fas fa-calculator me-2"></i> {{ __('reer.btn_calc') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- Image Hero --}}
                <img src="{{ asset('assets/img/Quest-ceque-le-REER.jpg') }}" alt="REER" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : AVANTAGES FISCAUX & CARACTÉRISTIQUES --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">

            {{-- Colonne Gauche : Avantages Fiscaux --}}
            <div class="col-lg-6 mb-5 mb-lg-0 order-2 order-lg-1">
                <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-success h-100">
                    <h3 class="fw-bold mb-4 text-success">{{ __('reer.adv_title') }}</h3>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-hand-holding-usd fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold">{{ __('reer.adv_1_title') }}</h5>
                            <p class="text-muted small mb-0">{{ __('reer.adv_1_desc') }}</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-chart-line fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold">{{ __('reer.adv_2_title') }}</h5>
                            <p class="text-muted small mb-0">{{ __('reer.adv_2_desc') }}</p>
                        </div>
                    </div>

                    <p class="fw-bold text-center fst-italic text-dark mt-3">
                        "{{ __('reer.adv_conclusion') }}"
                    </p>
                </div>
            </div>

            {{-- Colonne Droite : Caractéristiques + Image --}}
            <div class="col-lg-6 order-1 order-lg-2 ps-lg-5 mb-4">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('reer.features_title') }}</h3>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i> <span>{{ __('reer.feat_1') }}</span></li>
                    <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i> <span>{{ __('reer.feat_2') }}</span></li>
                    <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i> <span>{{ __('reer.feat_3') }}</span></li>
                    <li class="mb-3 d-flex align-items-start"><i class="fas fa-exclamation-circle text-warning me-2 mt-1"></i> <span>{{ __('reer.feat_4') }}</span></li>
                    <li class="mb-3 d-flex align-items-start"><i class="fas fa-info-circle text-primary me-2 mt-1"></i> <span>{{ __('reer.feat_5') }}</span></li>
                </ul>
                <img src="{{ asset('assets/img/Combine-puis-je-cotiser-a-mon-CELI.jpg') }}" alt="Caractéristiques REER" class="img-fluid rounded shadow mt-3 w-100">
            </div>

        </div>
    </div>
</section>

{{-- SECTION 3 : MAXIMISER VOS COTISATIONS (GRILLE DE 6) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('reer.max_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('reer.max_subtitle') }}</p>
        </div>

        <div class="row g-4">
            {{-- Stratégie 1 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="mb-3 text-primary"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                    <h5 class="fw-bold">{{ __('reer.strat_1_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('reer.strat_1_desc') }}</p>
                </div>
            </div>
            {{-- Stratégie 2 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="mb-3 text-success"><i class="fas fa-percentage fa-2x"></i></div>
                    <h5 class="fw-bold">{{ __('reer.strat_2_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('reer.strat_2_desc') }}</p>
                </div>
            </div>
            {{-- Stratégie 3 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="mb-3 text-warning"><i class="fas fa-home fa-2x"></i></div>
                    <h5 class="fw-bold">{{ __('reer.strat_3_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('reer.strat_3_desc') }}</p>
                </div>
            </div>
            {{-- Stratégie 4 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="mb-3 text-info"><i class="fas fa-sync-alt fa-2x"></i></div>
                    <h5 class="fw-bold">{{ __('reer.strat_4_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('reer.strat_4_desc') }}</p>
                </div>
            </div>
            {{-- Stratégie 5 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="mb-3 text-danger"><i class="fas fa-chart-pie fa-2x"></i></div>
                    <h5 class="fw-bold">{{ __('reer.strat_5_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('reer.strat_5_desc') }}</p>
                </div>
            </div>
            {{-- Stratégie 6 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="mb-3 text-secondary"><i class="fas fa-user-friends fa-2x"></i></div>
                    <h5 class="fw-bold">{{ __('reer.strat_6_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('reer.strat_6_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : FAQ & CTA --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-start">
            {{-- FAQ --}}
            <div class="col-lg-7 mb-5 mb-lg-0">
                <h3 class="fw-bold mb-4 text-primary">{{ __('reer.faq_title') }}</h3>
                <div class="accordion shadow-sm" id="faqAccordion">
                    @foreach(range(1, 5) as $i)
                    <div class="accordion-item mb-2 border-0 rounded overflow-hidden">
                        <h2 class="accordion-header" id="heading{{$i}}">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}">
                                {{ __('reer.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white text-muted small">
                                {{ __('reer.faq_a' . $i) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA Box (Image Couple Âgé) --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg overflow-hidden h-100">
                    <img src="{{ asset('assets/img/AdobeStock_230329183.jpg') }}" alt="Retraite heureuse" class="card-img-top object-fit-cover" style="height: 200px;">
                    <div class="card-body p-4 text-center bg-dark text-white">
                        <h4 class="fw-bold text-warning mb-3">{{ __('reer.cta_title') }}</h4>
                        <p class="small mb-4">{{ __('reer.cta_text') }}</p>
                        <a href="{{ url('/rendez-vous') }}" class="btn btn-warning rounded-pill px-5 fw-bold text-dark hover-scale">
                            {{ __('reer.cta_btn') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : ZONE CONSEILS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('reer.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('reer.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-piggy-bank fa-3x"></i></div>
                <p class="text-muted">{{ __('reer.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('reer.read_more') }}</a>
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