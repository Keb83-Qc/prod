@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('celi.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('celi.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('celi.btn_open') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('celi.btn_contact') }}</a>
                    <a href="https://calculatrices-financieres.ca/#/epargne" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">{{ __('celi.btn_calc') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Quest-ce-que-le-Celi.png') }}" alt="CELI" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

<section class="section-padding d-flex align-items-center" style="background-image: url('{{ asset('assets/img/Les-droits-de-cotisations-au-CELI.jpg') }}'); background-size: cover; background-position: center; min-height: 600px;">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6 col-md-10">
                <div class="card border-0 shadow-lg p-4 hover-lift" style="background-color: rgba(255, 255, 255, 0.95);">
                    <div class="card-body text-start">
                        <div class="mb-3 text-warning"><i class="fas fa-coins fa-3x"></i></div>
                        <h3 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('celi.contrib_title') }}</h3>
                        <div class="text-dark" style="line-height: 1.8;">
                            <p>{{ __('celi.contrib_text') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('celi.criteria_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center text-center">
            <div class="col-md-4">
                <div class="mb-3"><img src="{{ asset('assets/img/18_2141502.png') }}" width="64" alt="18"></div>
                <h5 class="fw-bold">{{ __('celi.crit_1') }}</h5>
            </div>
            <div class="col-md-4">
                <div class="mb-3"><img src="{{ asset('assets/img/supreme-court_6744453.png') }}" width="64" alt="Résident"></div>
                <h5 class="fw-bold">{{ __('celi.crit_2') }}</h5>
            </div>
            <div class="col-md-4">
                <div class="mb-3"><img src="{{ asset('assets/img/social-security_10880567.png') }}" width="64" alt="NAS"></div>
                <h5 class="fw-bold">{{ __('celi.crit_3') }}</h5>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('celi.modalities_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/tax_3200773.png') }}" width="64" alt="Retrait"></div>
                    <h5 class="fw-bold mb-2">{{ __('celi.mod_1') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/transfer_11542718.png') }}" width="64" alt="Transfert"></div>
                    <h5 class="fw-bold mb-2">{{ __('celi.mod_2') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/cargo_7074830.png') }}" width="64" alt="Placements"></div>
                    <h5 class="fw-bold mb-2">{{ __('celi.mod_3') }}</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('celi.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-wallet fa-3x"></i></div>
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
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('celi.read_more') }}</a>
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