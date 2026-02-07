@include('partials.header')

{{-- SECTION 1 : INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-primary text-white mb-2">Protection Générale</span>
                <h1 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-dommages.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('assurance-dommages.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('assurance-dommages.intro_text') }}</p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="fas fa-car text-warning me-2"></i> {{ __('assurance-dommages.intro_list_1') }}</li>
                        <li class="mb-2"><i class="fas fa-store text-warning me-2"></i> {{ __('assurance-dommages.intro_list_2') }}</li>
                        <li class="mb-2"><i class="fas fa-user-tie text-warning me-2"></i> {{ __('assurance-dommages.intro_list_3') }}</li>
                    </ul>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('assurance-dommages.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('assurance-dommages.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/jeune-couple-signant-contrat-location-tout-rencontrant-agent-immobilier-accent-est-mis-homme.jpg') }}"
                    alt="Assurance dommages" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : ASSURANCE AUTO --}}
<section class="section-padding bg-light" id="auto">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0 order-2 order-lg-1">
                <img src="{{ asset('assets/img/assurance-auto.jpg') }}" alt="Auto" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-7 order-1 order-lg-2">
                <div class="ps-lg-4">
                    <h2 class="fw-bold mb-2" style="color: var(--primary-color);">{{ __('assurance-dommages.auto_title') }}</h2>
                    <p class="text-muted fw-bold">{{ __('assurance-dommages.auto_subtitle') }}</p>

                    <div class="row g-4 mt-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm h-100 border-start border-4 border-warning">
                                <h5 class="fw-bold">{{ __('assurance-dommages.auto_rc_title') }}</h5>
                                <p class="small text-muted mb-0">{{ __('assurance-dommages.auto_rc_text') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm h-100 border-start border-4 border-primary">
                                <h5 class="fw-bold">{{ __('assurance-dommages.auto_all_risks_title') }}</h5>
                                <p class="small text-muted mb-0">{{ __('assurance-dommages.auto_all_risks_text') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- CTA AUTO --}}
                    <div class="mt-4 p-4 rounded text-white" style="background-color: var(--vip-blue, #0E1030);">
                        <h5 class="fw-bold text-warning mb-2">{{ __('assurance-dommages.auto_cta_slogan') }}</h5>
                        <p class="mb-3 small opacity-75">{{ __('assurance-dommages.auto_cta_text') }}</p>
                        <a href="{{ url('/assurance-auto') }}" class="btn btn-warning rounded-pill px-4 text-dark fw-bold">
                            {{ __('assurance-dommages.auto_btn') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : ASSURANCE HABITATION --}}
<section class="section-padding bg-white" id="habitation">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="fw-bold mb-2" style="color: var(--primary-color);">{{ __('assurance-dommages.home_title') }}</h2>
                <p class="text-muted fw-bold">{{ __('assurance-dommages.home_subtitle') }}</p>
                <p class="mb-4">{{ __('assurance-dommages.home_intro') }}</p>

                <h5 class="fw-bold text-dark">{{ __('assurance-dommages.home_cover_title') }}</h5>
                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><i class="fas fa-fire text-danger me-2"></i> {{ __('assurance-dommages.home_cover_1') }}</li>
                    <li class="mb-2"><i class="fas fa-water text-info me-2"></i> {{ __('assurance-dommages.home_cover_2') }}</li>
                    <li class="mb-2"><i class="fas fa-user-shield text-success me-2"></i> {{ __('assurance-dommages.home_cover_3') }}</li>
                </ul>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100">
                            <h6 class="fw-bold text-primary"><i class="fas fa-key me-2"></i> {{ __('assurance-dommages.home_tenant_title') }}</h6>
                            <p class="small text-muted mb-0">{{ __('assurance-dommages.home_tenant_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100">
                            <h6 class="fw-bold text-primary"><i class="fas fa-home me-2"></i> {{ __('assurance-dommages.home_owner_title') }}</h6>
                            <p class="small text-muted mb-0">{{ __('assurance-dommages.home_owner_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ url('/assurance-habitation') }}" class="btn btn-outline-primary rounded-pill px-4">
                        {{ __('assurance-dommages.home_btn') }} <i class="fas fa-home ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 mb-4 mb-lg-0 mt-4 mt-lg-0">
                <img src="{{ asset('assets/img/assurance-habitation.jpg') }}" alt="Habitation" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : COMMERCIAL & PRO (2 colonnes) --}}
<section class="section-padding bg-light" id="commercial">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">Protection des Entreprises</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-5">
            {{-- COMMERCIAL --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-dark text-white p-4">
                        <h4 class="mb-0 fw-bold"><i class="fas fa-building me-2 text-warning"></i> {{ __('assurance-dommages.comm_title') }}</h4>
                        <small class="text-white-50">{{ __('assurance-dommages.comm_subtitle') }}</small>
                    </div>
                    <div class="card-body p-4">
                        <p class="card-text">{{ __('assurance-dommages.comm_intro') }}</p>
                        <h6 class="fw-bold mt-3">{{ __('assurance-dommages.comm_why_title') }}</h6>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-dommages.comm_why_1') }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-dommages.comm_why_2') }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-dommages.comm_why_3') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <a href="{{ url('/assurance-commerciale') }}" class="btn btn-primary w-100 py-2 fw-bold rounded-pill">
                            {{ __('assurance-dommages.comm_btn') }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- PRO (E&O) --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-primary text-white p-4">
                        <h4 class="mb-0 fw-bold"><i class="fas fa-briefcase me-2"></i> {{ __('assurance-dommages.pro_title') }}</h4>
                        <small class="text-white-50">{{ __('assurance-dommages.pro_subtitle') }}</small>
                    </div>
                    <div class="card-body p-4">
                        <p class="card-text">{{ __('assurance-dommages.pro_intro') }}</p>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark border me-1">Consultants</span>
                            <span class="badge bg-light text-dark border me-1">Ingénieurs</span>
                            <span class="badge bg-light text-dark border">Comptables</span>
                        </div>
                        <h6 class="fw-bold mt-3">{{ __('assurance-dommages.pro_cover_title') }}</h6>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2"><i class="fas fa-shield-alt text-primary me-2"></i> {{ __('assurance-dommages.pro_cover_1') }}</li>
                            <li class="mb-2"><i class="fas fa-gavel text-primary me-2"></i> {{ __('assurance-dommages.pro_cover_2') }}</li>
                            <li class="mb-2"><i class="fas fa-money-bill text-primary me-2"></i> {{ __('assurance-dommages.pro_cover_3') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <a href="{{ url('/assurance-responsabilite-professionnelle') }}" class="btn btn-outline-primary w-100 py-2 fw-bold rounded-pill">
                            {{ __('assurance-dommages.pro_btn') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- {{-- SECTION CTA : COMMENCER SOUMISSION --}}
<section class="py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-color) 0%, #1a1d50 100%);">
    <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>

    <div class="container position-relative z-1">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-lg-8">
                <h3 class="fw-bold text-white mb-3">
                    {{ __('assurance-dommages.cta_quote_title') }}
                </h3>
                <p class="text-white-50 fs-5 mb-4">
                    {{ __('assurance-dommages.cta_quote_text') }}
                </p>

                {{-- LE BOUTON VERS LE CONSENTEMENT --}}
                <a href="{{ route('consent.show') }}" class="btn btn-warning btn-lg rounded-pill px-5 py-3 shadow-lg fw-bold text-dark hover-scale">
                    <i class="fas fa-play-circle me-2"></i> {{ __('assurance-dommages.cta_quote_btn') }}
                </a>
            </div>
        </div>
    </div>
</section> -->

{{-- SECTION 6 : ZONE CONSEILS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-dommages.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-dommages.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-home fa-3x"></i></div>
                <p class="text-muted">{{ __('assurance-dommages.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('assurance-dommages.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
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
</style>

@include('partials.footer')