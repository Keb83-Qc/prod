@include('partials.header')

{{-- SECTION 1 : QU'EST-CE QUE C'EST ? (INTRO) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('programme-dachat-clef-en-main.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>
                        {{ __('programme-dachat-clef-en-main.intro_p1') }}
                    </p>
                    <p>
                        {{ __('programme-dachat-clef-en-main.intro_p2') }}
                    </p>
                </div>

                {{-- Boutons d'action --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('programme-dachat-clef-en-main.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('programme-dachat-clef-en-main.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- Image --}}
                <img src="{{ asset('assets/img/AdobeStock_305225678.jpg') }}" alt="{{ __('programme-dachat-clef-en-main.title') }}" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : OBJECTIF DU PROGRAMME (MAISON EN MAIN) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                {{-- Image --}}
                <img src="{{ asset('assets/img/AdobeStock_672446165.png') }}" alt="{{ __('programme-dachat-clef-en-main.objective_title') }}" class="img-fluid rounded w-100">
            </div>

            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0 ps-lg-5">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('programme-dachat-clef-en-main.objective_title') }}</h3>
                <div class="text-dark text-justify" style="line-height: 1.8;">
                    <p>
                        {{ __('programme-dachat-clef-en-main.objective_p1') }}
                    </p>
                    <p>
                        {{ __('programme-dachat-clef-en-main.objective_p2') }}
                    </p>
                    <p>
                        {{ __('programme-dachat-clef-en-main.objective_p3') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : LES ÉTAPES DU PROGRAMME (GRILLE 5 ÉTAPES) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('programme-dachat-clef-en-main.steps_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @php
            $icons = [
            'question_14215651.png',
            'financial-consultant_6868463.png',
            'estimate_4859658.png',
            'bidding_2631546.png',
            'team-member_9217629.png'
            ];
            @endphp

            @foreach(range(1, 5) as $i)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/' . $icons[$i-1]) }}" width="64" alt="Icone">
                    </div>
                    <h5 class="fw-bold mb-3 text-dark">{{ __('programme-dachat-clef-en-main.step_' . $i . '_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('programme-dachat-clef-en-main.step_' . $i . '_desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 4 : ZONE CONSEILS (BLOG DYNAMIQUE ACHAT/HYPOTHÈQUE) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('programme-dachat-clef-en-main.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('programme-dachat-clef-en-main.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-key fa-3x"></i></div>
                <p class="text-muted">{{ __('programme-dachat-clef-en-main.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('programme-dachat-clef-en-main.read_more') }}</a>
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