@include('partials.header')

{{-- SECTION 1 : INTRO HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('ferr.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('ferr.intro_text') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('ferr.btn_convert') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('ferr.btn_contact') }}
                    </a>
                    <a href="https://www.equitable.ca/fr/nos-produits/%C3%A9pargne-et-retraite/calculateurs-%C3%A9pargne-et-retraite/calculatrice-de-paiement-ferr/"
                        target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">
                        {{ __('ferr.btn_calc') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/A-cote-texte-FERR.jpg') }}" alt="FERR Retraite" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : RÈGLES DE BASE --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm p-4 bg-white border-start border-4 border-warning">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 text-warning">
                            <i class="fas fa-info-circle fa-2x"></i>
                        </div>
                        <div>
                            <ul class="list-unstyled mb-0 text-dark">
                                <li class="mb-2">{{ __('ferr.rules_list.r1') }}</li>
                                <li>{{ __('ferr.rules_list.r2') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : POINTS CLÉS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('ferr.key_points_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @php
            $points = [
            ['icon' => 'lending_2856892.png', 'key' => 'p1'],
            ['icon' => 'alert_14356955.png', 'key' => 'p2'],
            ['icon' => 'delete_11502976.png', 'key' => 'p3'],
            ['icon' => 'growth_2910299.png', 'key' => 'p4'],
            ['icon' => 'business_13389610.png', 'key' => 'p5'],
            ['icon' => 'friendship_7959236.png', 'key' => 'p6'],
            ['icon' => 'limited-time_9449615.png', 'key' => 'p7']
            ];
            @endphp

            @foreach($points as $p)
            <div class="col-md-6 col-lg-{{ $loop->iteration > 3 ? '3' : '4' }}">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/' . $p['icon']) }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3">{{ __('ferr.points.' . $p['key'] . '_title') }}</h5>
                    <p class="text-muted small">{{ __('ferr.points.' . $p['key'] . '_desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 text-center px-lg-5">
            <p class="text-muted fst-italic fs-5">"{{ __('ferr.disclaimer') }}"</p>
            <a href="{{ url('/contact') }}" class="btn btn-outline-primary rounded-pill px-4 mt-3">{{ __('ferr.cta_contact') }}</a>
        </div>
    </div>
</section>

{{-- SECTION 4 : ZONE CONSEILS --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('ferr.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-coins fa-3x"></i></div>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('ferr.read_more') }}</a>
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