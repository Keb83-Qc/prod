@include('partials.header')

{{-- SECTION 1 : INTRO HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-secondary text-white mb-2">Fonds de Pension</span>
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('cri.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('cri.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('cri.intro_text') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('cri.btn_transfer') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('cri.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/AdobeStock_230329183.jpg') }}" alt="CRI Retraite" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : QU'EST-CE QUE C'EST & ORIGINE DES FONDS --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">
            {{-- Colonne Gauche : Définition --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('cri.what_title') }}</h3>
                <p class="text-dark mb-4">{{ __('cri.what_text') }}</p>

                <h5 class="fw-bold mb-3">{{ __('cri.purpose_title') }}</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('cri.purpose_1') }}</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('cri.purpose_2') }}</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('cri.purpose_3') }}</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('cri.purpose_4') }}</li>
                </ul>
            </div>

            {{-- Colonne Droite : Origine & Avertissement --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-light rounded-circle p-3 me-3 text-primary">
                                <i class="fas fa-exchange-alt fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-0">{{ __('cri.origin_title') }}</h4>
                        </div>
                        <p>{{ __('cri.origin_intro') }}</p>
                        <ul class="list-unstyled mb-4 small">
                            <li class="mb-2">🔹 {{ __('cri.origin_source_1') }}</li>
                            <li class="mb-2">🔹 {{ __('cri.origin_source_2') }}</li>
                            <li class="mb-2">🔹 {{ __('cri.origin_source_3') }}</li>
                        </ul>

                        {{-- ALERTE IMPORTANTE --}}
                        <div class="alert alert-warning border-0 d-flex align-items-start shadow-sm">
                            <i class="fas fa-exclamation-triangle mt-1 me-3 fa-lg"></i>
                            <div>
                                <strong class="d-block mb-1">{{ __('cri.warning_title') }}</strong>
                                {{ __('cri.warning_text') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : FONCTIONNEMENT FISCAL (3 COLONNES) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('cri.tax_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4 bg-light rounded shadow-sm hover-lift h-100 border-top border-4 border-success">
                    <div class="mb-3 text-success"><i class="fas fa-university fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('cri.tax_transfer_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('cri.tax_transfer_desc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 bg-light rounded shadow-sm hover-lift h-100 border-top border-4 border-primary">
                    <div class="mb-3 text-primary"><i class="fas fa-chart-line fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('cri.tax_growth_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('cri.tax_growth_desc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 bg-light rounded shadow-sm hover-lift h-100 border-top border-4 border-secondary">
                    <div class="mb-3 text-secondary"><i class="fas fa-hand-holding-usd fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('cri.tax_withdraw_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('cri.tax_withdraw_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : CONVERSION & CONCLUSION --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="{{ asset('assets/img/AdobeStock_722043369.png') }}" alt="Conversion CRI" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h3 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('cri.conversion_title') }}</h3>
                <p class="text-muted mb-4">{{ __('cri.conversion_intro') }}</p>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-white rounded-circle p-3 shadow-sm text-info">
                            <i class="fas fa-random fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('cri.conv_frv_title') }}</h5>
                        <p class="small text-muted mb-0">{{ __('cri.conv_frv_desc') }}</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-white rounded-circle p-3 shadow-sm text-info">
                            <i class="fas fa-file-contract fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">{{ __('cri.conv_rente_title') }}</h5>
                        <p class="small text-muted mb-0">{{ __('cri.conv_rente_desc') }}</p>
                    </div>
                </div>

                <div class="p-3 bg-white rounded border-start border-4 border-primary">
                    <strong class="d-block mb-1 text-primary">{{ __('cri.conclusion_title') }}</strong>
                    <p class="small mb-0 fst-italic">"{{ __('cri.conclusion_text') }}"</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : ZONE CONSEILS (BLOG) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('cri.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('cri.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-lock fa-3x"></i></div>
                <p class="text-muted">{{ __('cri.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('cri.read_more') }}</a>
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
</style>

@include('partials.footer')