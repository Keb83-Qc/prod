@include('partials.header')

{{-- SECTION 1 : INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite-de-groupe.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>
                        {{ __('assurance-invalidite-de-groupe.intro_text') }}
                    </p>
                </div>

                {{-- Boutons d'action --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('assurance-invalidite-de-groupe.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('assurance-invalidite-de-groupe.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- Image --}}
                <img src="{{ asset('assets/img/tech-people-trying-achieve-ambitious-sustainability-goals.jpg') }}"
                    alt="{{ __('assurance-invalidite-de-groupe.title') }}" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : AVANTAGES (POUR LES MEMBRES) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="mb-5 text-center">
                    <h2 class="fw-bold" style="color: var(--primary-color);">{{ __('assurance-invalidite-de-groupe.advantages_title') }}</h2>
                    <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
                </div>

                <div class="bg-white p-5 rounded shadow-sm">
                    <ul class="list-unstyled text-dark">
                        @foreach(range(1, 7) as $i)
                        <li class="mb-3">
                            <strong style="color: var(--primary-color);">{{ __('assurance-invalidite-de-groupe.adv_' . $i . '_title') }}</strong>
                            {{ __('assurance-invalidite-de-groupe.adv_' . $i . '_desc') }}
                        </li>
                        @endforeach
                    </ul>
                    <div class="text-center mt-4">
                        <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white">
                            {{ __('assurance-invalidite-de-groupe.btn_quote_free') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : INCONVÉNIENTS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="mb-4">
                    <h3 class="fw-bold" style="color: var(--primary-color);">{{ __('assurance-invalidite-de-groupe.disadvantages_title') }}</h3>
                </div>
                <div class="p-4 bg-light rounded border-start border-4 border-warning">
                    <ul class="list-unstyled text-dark mb-0">
                        @foreach(range(1, 5) as $i)
                        <li class="mb-3">
                            <strong style="color: var(--primary-color);">{{ __('assurance-invalidite-de-groupe.dis_' . $i . '_title') }}</strong>
                            {{ __('assurance-invalidite-de-groupe.dis_' . $i . '_desc') }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : AVANTAGES POUR L'EMPLOYEUR (GRILLE) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-invalidite-de-groupe.employer_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-invalidite-de-groupe.employer_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @php
            $icons = [
            'magnet_5234194.png',
            'chart_2701085.png',
            'hand-washing_2633447.png',
            'fx_5581181.png',
            'positive-thinking_2464191.png',
            'collector_5809169.png',
            'marketing-agent_7725987.png'
            ];
            @endphp

            @foreach(range(1, 7) as $i)
            <div class="col-md-6 col-lg-{{ $i > 4 ? '4' : '3' }}">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/' . $icons[$i-1]) }}" width="64" alt="Icone">
                    </div>
                    <h6 class="fw-bold text-dark">{{ __('assurance-invalidite-de-groupe.emp_' . $i . '_title') }}</h6>
                    <p class="text-muted small mb-0">{{ __('assurance-invalidite-de-groupe.emp_' . $i . '_desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 text-center">
            <em class="text-muted">
                "{{ __('assurance-invalidite-de-groupe.final_quote') }}"
            </em>
        </div>
    </div>
</section>

{{-- SECTION 5 : ZONE CONSEILS (BLOG DYNAMIQUE GROUPE) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-invalidite-de-groupe.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-invalidite-de-groupe.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-users fa-3x"></i></div>
                <p class="text-muted">{{ __('assurance-invalidite-de-groupe.blog_no_article') }}</p>
            </div>
            @elseif(isset($conseils))
            @foreach($conseils as $post)
            @php
            $lang = app()->getLocale();
            $title = ($lang == 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
            $rawContent = ($lang == 'en' && !empty($post->content_en)) ? $post->content_en : $post->content;
            $desc = Str::limit(strip_tags(html_entity_decode($rawContent)), 100, '...');
            $imgSrc = !empty($post->image) ? asset($post->image) : asset('assets/img/default.jpg');
            $link = url('/article/' . $post->id); // ou ->slug selon votre structure
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div style="height: 200px; background-color: #ddd; background-image: url('{{ $imgSrc }}'); background-size: cover; background-position: center;"></div>
                    <div class="card-body text-center p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small text-uppercase">
                            <i class="far fa-calendar-alt text-warning me-1"></i>
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">
                                {{ __('assurance-invalidite-de-groupe.read_more') }}
                            </a>
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