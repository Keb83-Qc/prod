@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('pret-reee.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('pret-reee.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('pret-reee.btn_request') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('pret-reee.btn_contact') }}</a>
                    <a href="https://financialservices.equisoft.com/resp/EducationNeeds.aspx?language=fr-CA" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">{{ __('pret-reee.btn_calc') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/A-cote-du-texte-REEE-.jpg') }}" alt="REEE" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <img src="{{ asset('assets/img/Les-benefices-du-REEE.jpg') }}" alt="Bénéfices" class="img-fluid rounded shadow-lg w-100">
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0 ps-lg-5">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('pret-reee.benefits_title') }}</h3>
                <div class="text-dark" style="line-height: 1.8;">
                    <ul class="list-unstyled">
                        @foreach(__('pret-reee.benefits_list') as $benefit)
                        <li class="mb-3"><strong style="color: var(--primary-color);">•</strong> {{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4 p-4 bg-white rounded shadow-sm border-start border-4 border-warning">
                    <p class="mb-3 small text-muted">{{ __('pret-reee.more_info_text') }}</p>
                    <a href="{{ url('/contact') }}" class="btn btn-sm btn-primary rounded-pill px-4 text-white">{{ __('pret-reee.btn_click') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-reee.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-graduation-cap fa-3x"></i></div>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('pret-reee.read_more') }}</a>
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