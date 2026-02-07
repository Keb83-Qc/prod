@include('partials.header')

{{-- SECTION 1 : INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite-individuelle.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{!! __('assurance-invalidite-individuelle.intro_text') !!}</p>
                </div>

                {{-- Boutons d'action --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('assurance-invalidite-individuelle.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('assurance-invalidite-individuelle.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- Image --}}
                <img src="{{ asset('assets/img/ques-ce-que-lassurance-invalidite-individuelle.png') }}" alt="{{ __('assurance-invalidite-individuelle.title') }}" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : COMPLÉMENT D'INFORMATION (Citation) --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <p class="text-muted fs-5 fst-italic">
                    "{!! __('assurance-invalidite-individuelle.quote_text') !!}"
                </p>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : LES AVANTAGES --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/les-anvantages-de-lass-invalidite-individuelle-PNG.png') }}" alt="{{ __('assurance-invalidite-individuelle.advantages_title') }}" class="img-fluid rounded shadow-lg w-100">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-invalidite-individuelle.advantages_title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <ul class="list-unstyled text-dark">
                    @foreach(range(1, 6) as $i)
                    <li class="d-flex mb-3 align-items-start">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <span>{{ __('assurance-invalidite-individuelle.adv_' . $i) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : FAQ (ACCORDÉON) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-invalidite-individuelle.faq_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion shadow-sm" id="faqAccordion">
                    @foreach(range(1, 7) as $i)
                    <div class="accordion-item border-0 mb-3 rounded overflow-hidden">
                        <h2 class="accordion-header" id="heading{{$i}}">
                            <button class="accordion-button {{ $i != 1 ? 'collapsed' : '' }} fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="{{ $i == 1 ? 'true' : 'false' }}" aria-controls="collapse{{$i}}">
                                {{ __('assurance-invalidite-individuelle.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse {{ $i == 1 ? 'show' : '' }}" aria-labelledby="heading{{$i}}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white text-muted">
                                <p>{!! __('assurance-invalidite-individuelle.faq_a' . $i) !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : CONCLUSION & CTA --}}
<section class="section-padding bg-white text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="text-muted fs-5 mb-4 fst-italic">
                    "{!! __('assurance-invalidite-individuelle.conclusion_text') !!}"
                </p>
                <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-5 shadow-sm text-white fw-bold">
                    {{ __('assurance-invalidite-individuelle.btn_advisor') }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 : ZONE CONSEILS (BLOG DYNAMIQUE) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-invalidite-individuelle.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-invalidite-individuelle.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-wheelchair fa-3x"></i></div>
                <p class="text-muted">{{ __('assurance-invalidite-individuelle.blog_no_article') }}</p>
            </div>
            @elseif(isset($conseils))
            @foreach($conseils as $post)
            @php
            $lang = app()->getLocale();
            $title = ($lang == 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
            $rawContent = ($lang == 'en' && !empty($post->content_en)) ? $post->content_en : $post->content;
            $desc = Str::limit(strip_tags(html_entity_decode($rawContent)), 100, '...');
            $imgSrc = !empty($post->image) ? asset($post->image) : asset('assets/img/default.jpg');
            $link = url('/article/' . $post->slug);
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('assurance-invalidite-individuelle.read_more') }}</a>
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

    .accordion-button:not(.collapsed) {
        color: var(--primary-color) !important;
        background-color: #f8f9fa !important;
        box-shadow: none !important;
    }

    .accordion-button:focus {
        box-shadow: none !important;
        border-color: rgba(0, 0, 0, .125);
    }
</style>

@include('partials.footer')