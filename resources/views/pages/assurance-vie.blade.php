@include('partials.header')

{{-- SECTION 1 : INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('assurance-vie.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-muted text-justify" style="line-height: 1.8;">
                    <p>{!! __('assurance-vie.intro_text') !!}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/A-cote-texte-assurance-vie-1.jpg') }}" alt="{{ __('assurance-vie.title') }}" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : TEMPORAIRE --}}
<section class="section-padding pb-0" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold" style="color: var(--primary-color);">{{ __('assurance-vie.temp_title') }}</h3>
            <p class="text-muted">{{ __('assurance-vie.temp_subtitle') }}</p>
        </div>
    </div>
</section>

<section class="py-5 mb-5 d-flex align-items-center" style="background-color: #0b0d26; width: 100%; border-radius: 0 200px 200px 0; min-height: 400px;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white rounded-4 hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/Protection-du-revenu.png') }}" alt="{{ __('assurance-vie.card_1_title') }}" style="width: 70px; height: auto;">
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary);">{{ __('assurance-vie.card_1_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-vie.card_1_desc') }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white rounded-4 hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/Paiement-des-dettes.png') }}" alt="{{ __('assurance-vie.card_2_title') }}" style="width: 70px; height: auto;">
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary);">{{ __('assurance-vie.card_2_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-vie.card_2_desc') }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white rounded-4 hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/Securite-financiere.png') }}" alt="{{ __('assurance-vie.card_3_title') }}" style="width: 70px; height: auto;">
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary);">{{ __('assurance-vie.card_3_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-vie.card_3_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : PERMANENTE --}}
<section class="section-padding pb-0" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold" style="color: var(--primary-color);">{{ __('assurance-vie.perm_title') }}</h3>
            <p class="text-muted">{{ __('assurance-vie.perm_subtitle') }}</p>
        </div>
    </div>
</section>

<section class="py-5 mb-5 d-flex align-items-center" style="background-color: #0b0d26; width: 100%; border-radius: 200px 0 0 200px; min-height: 400px;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white rounded-4 hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/Protection-du-revenu.png') }}" alt="{{ __('assurance-vie.perm_card_1_title') }}" style="width: 70px; height: auto;">
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary);">{{ __('assurance-vie.perm_card_1_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-vie.perm_card_1_desc') }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white rounded-4 hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/Paiement-des-dettes.png') }}" alt="{{ __('assurance-vie.perm_card_2_title') }}" style="width: 70px; height: auto;">
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary);">{{ __('assurance-vie.perm_card_2_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-vie.perm_card_2_desc') }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white rounded-4 hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/Securite-financiere.png') }}" alt="{{ __('assurance-vie.perm_card_3_title') }}" style="width: 70px; height: auto;">
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary);">{{ __('assurance-vie.perm_card_3_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('assurance-vie.perm_card_3_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : OPTIONS DE SOUSCRIPTION --}}
<section class="section-padding bg-primary" style="background-color: var(--primary) !important;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white">{{ __('assurance-vie.options_title') }}</h2>
            <p class="text-white-50">{{ __('assurance-vie.options_subtitle') }}</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 rounded h-100 bg-white shadow-lg border-0 hover-lift">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-stethoscope fa-2x me-3" style="color: var(--secondary);"></i>
                        <h4 class="mb-0 fw-bold" style="color: var(--primary);">{{ __('assurance-vie.opt_1_title') }}</h4>
                    </div>
                    <p class="small text-uppercase fw-bold mb-3" style="color: var(--secondary);">{{ __('assurance-vie.opt_1_subtitle') }}</p>

                    <p style="color: var(--primary);">
                        {!! __('assurance-vie.opt_1_text') !!}
                    </p>

                    <a href="{{ url('/contact?sujet=avec_tarification') }}" class="btn btn-sm btn-outline-dark mt-3 rounded-pill fw-bold">{{ __('assurance-vie.btn_quote') }}</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 rounded h-100 bg-white shadow-lg border-0 hover-lift">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-file-signature fa-2x me-3" style="color: var(--secondary);"></i>
                        <h4 class="mb-0 fw-bold" style="color: var(--primary);">{{ __('assurance-vie.opt_2_title') }}</h4>
                    </div>
                    <p class="small text-uppercase fw-bold mb-3" style="color: var(--secondary);">{{ __('assurance-vie.opt_2_subtitle') }}</p>

                    <p style="color: var(--primary);">
                        {!! __('assurance-vie.opt_2_text') !!}
                    </p>

                    <a href="{{ url('/contact?sujet=sans_tarification') }}" class="btn btn-sm btn-outline-dark mt-3 rounded-pill fw-bold">{{ __('assurance-vie.btn_quote') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : POURQUOI ? --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--primary-color);">{{ __('assurance-vie.why_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100 hover-lift">
                    <img src="{{ asset('assets/img/beneficiary_6000659-1.png') }}" alt="Famille" class="mb-3" width="80">
                    <h5 class="fw-bold mb-3">{{ __('assurance-vie.reason_1') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-vie.reason_1_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100 hover-lift">
                    <img src="{{ asset('assets/img/insurance-policy_10279437.png') }}" alt="Succession" class="mb-3" width="80">
                    <h5 class="fw-bold mb-3">{{ __('assurance-vie.reason_2') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-vie.reason_2_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100 hover-lift">
                    <img src="{{ asset('assets/img/money_2960150.png') }}" alt="Investissement" class="mb-3" width="80">
                    <h5 class="fw-bold mb-3">{{ __('assurance-vie.reason_3') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-vie.reason_3_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100 hover-lift">
                    <img src="{{ asset('assets/img/homework-help_15051664.png') }}" alt="Éducation" class="mb-3" width="80">
                    <h5 class="fw-bold mb-3">{{ __('assurance-vie.reason_4') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-vie.reason_4_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 : ZONE CONSEILS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-vie.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-heartbeat fa-3x"></i></div>
                <p class="text-muted">Aucun article disponible.</p>
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
                        <h5 class="card-title fw-bold mb-3">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2">{{ __('assurance-vie.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

{{-- SECTION 7 : DISCLAIMER --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <em class="text-muted fs-5">"{{ __('assurance-vie.disclaimer') }}"</em>
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