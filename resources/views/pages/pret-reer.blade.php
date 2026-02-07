@include('partials.header')

{{-- SECTION 1 : INTRO HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-warning text-dark mb-2">Stratégie Fiscale</span>
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('pret-reer.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('pret-reer.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('pret-reer.intro_p1') }}</p>
                    <p>{{ __('pret-reer.intro_p2') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('pret-reer.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('pret-reer.btn_contact') }}
                    </a>
                    <a href="https://calculatrices-financieres.ca/#/pret-reer" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">
                        <i class="fas fa-calculator me-2"></i> {{ __('pret-reer.btn_calc') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/AdobeStock_60884518.jpg') }}" alt="Prêt REER" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : COMMENT ÇA FONCTIONNE (3 ÉTAPES) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-reer.how_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted w-75 mx-auto">{{ __('pret-reer.how_intro') }}</p>
        </div>

        <div class="row g-4 text-center">
            {{-- Étape 1 --}}
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-top border-4 border-warning position-relative hover-lift">
                    <div class="position-absolute top-0 start-50 translate-middle bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">1</div>
                    <div class="mb-3 mt-2"><i class="fas fa-hand-holding-usd fa-3x text-warning"></i></div>
                    <h5 class="fw-bold">{{ __('pret-reer.step_1_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('pret-reer.step_1_desc') }}</p>
                </div>
            </div>
            {{-- Étape 2 --}}
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-top border-4 border-success position-relative hover-lift">
                    <div class="position-absolute top-0 start-50 translate-middle bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">2</div>
                    <div class="mb-3 mt-2"><i class="fas fa-file-invoice-dollar fa-3x text-success"></i></div>
                    <h5 class="fw-bold">{{ __('pret-reer.step_2_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('pret-reer.step_2_desc') }}</p>
                </div>
            </div>
            {{-- Étape 3 --}}
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-top border-4 border-primary position-relative hover-lift">
                    <div class="position-absolute top-0 start-50 translate-middle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">3</div>
                    <div class="mb-3 mt-2"><i class="fas fa-chart-line fa-3x text-primary"></i></div>
                    <h5 class="fw-bold">{{ __('pret-reer.step_3_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('pret-reer.step_3_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : AVANTAGES STRATÉGIQUES (IMAGE + LISTE) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 order-2 order-lg-1">
                <img src="{{ asset('assets/img/AdobeStock_7655214.jpg') }}" alt="Avantages" class="img-fluid rounded shadow-lg w-100">
            </div>
            <div class="col-lg-7 order-1 order-lg-2 mb-4 mb-lg-0 ps-lg-5">
                <h3 class="fw-bold mb-2" style="color: var(--primary-color);">{{ __('pret-reer.benefits_title') }}</h3>
                <p class="text-muted fw-bold mb-4">{{ __('pret-reer.benefits_subtitle') }}</p>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-undo fa-2x text-info"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('pret-reer.benefit_1_title') }}</h5>
                        <p class="text-muted mb-0">{{ __('pret-reer.benefit_1_desc') }}</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-rocket fa-2x text-danger"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('pret-reer.benefit_2_title') }}</h5>
                        <p class="text-muted mb-0">{{ __('pret-reer.benefit_2_desc') }}</p>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-balance-scale fa-2x text-success"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('pret-reer.benefit_3_title') }}</h5>
                        <p class="text-muted mb-0">{{ __('pret-reer.benefit_3_desc') }}</p>
                    </div>
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
                <h3 class="fw-bold mb-4 text-primary">{{ __('pret-reer.faq_title') }}</h3>
                <div class="accordion shadow-sm" id="faqAccordion">
                    @foreach(range(1, 6) as $i)
                    <div class="accordion-item mb-2 border-0 rounded overflow-hidden">
                        <h2 class="accordion-header" id="heading{{$i}}">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}">
                                {{ __('pret-reer.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white text-muted small">
                                {!! __('pret-reer.faq_a' . $i) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA Box --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg h-100 bg-dark text-white p-4 text-center">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="mb-4 text-warning"><i class="fas fa-bullhorn fa-3x"></i></div>
                        <h3 class="fw-bold mb-3">{{ __('pret-reer.cta_title') }}</h3>
                        <p class="mb-4 opacity-75">{{ __('pret-reer.cta_text') }}</p>
                        <a href="{{ url('/rendez-vous') }}" class="btn btn-warning rounded-pill px-5 fw-bold text-dark hover-scale">
                            {{ __('pret-reer.cta_btn') }}
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
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-reer.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('pret-reer.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-piggy-bank fa-3x"></i></div>
                <p class="text-muted">{{ __('pret-reer.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('pret-reer.read_more') }}</a>
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