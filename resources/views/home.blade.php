@include('partials.header')

{{-- SECTION HERO CARROUSEL --}}
<section class="p-0 position-relative">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        {{-- Indicateurs --}}
        <div class="carousel-indicators">
            @foreach($slides as $key => $slide)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @forelse($slides as $key => $slide)
            @php
            $isActive = ($key == 0) ? 'active' : '';
            $imgUrl = asset('storage/' . $slide->image);
            @endphp

            <div class="carousel-item {{ $isActive }}" style="height: 65vh; min-height: 500px;">
                <div class="w-100 h-100"
                    style="background-image: url('{{ $imgUrl }}'); background-size: cover; background-position: center;">
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(to bottom, rgba(14, 16, 48, 0.02), rgba(14, 16, 48, 0.05));">
                </div>

                <div class="carousel-caption d-flex flex-column h-100 align-items-center justify-content-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center" data-aos="fade-up">

                                @if($slide->title)
                                <h1 class="fw-bold text-white mb-4 animate__animated animate__fadeInDown"
                                    style="text-shadow: 0 4px 15px rgba(0,0,0,0.6);
                                    font-size: clamp(1.5rem, 4vw, 3.5rem);">
                                    {{ $slide->title }}
                                </h1>
                                @endif

                                @if($slide->subtitle)
                                <div
                                    class="lead text-white-50 mb-5 fs-4 animate__animated animate__fadeInUp animate__delay-1s">
                                    {!! $slide->subtitle !!}
                                </div>
                                @endif

                                @if($slide->button_text && $slide->button_link)
                                <div class="animate__animated animate__fadeInUp animate__delay-2s">
                                    <a href="{{ $slide->button_link }}"
                                        class="btn btn-cta btn-lg px-5 py-3 fw-bold shadow hover-scale">
                                        {{ $slide->button_text }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="carousel-item active" style="height: 65vh; min-height: 500px;">
                <div class="w-100 h-100"
                    style="background-image: url('{{ asset('assets/img/canvas.png') }}'); background-size: cover; background-position: center;">
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(14, 16, 48, 0.7);">
                </div>
                <div class="carousel-caption d-flex flex-column h-100 align-items-center justify-content-center">
                    <h1 class="display-3 fw-bold text-white">Votre sécurité, notre priorité</h1>
                    <p class="lead text-white-50 mb-5">Bienvenue chez VIP GPI.</p>
                </div>
            </div>
            @endforelse
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</section>

<style>
    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    .carousel-indicators button {
        width: 12px !important;
        height: 12px !important;
        border-radius: 50%;
        margin: 0 5px !important;
    }
</style>

{{-- SECTION POURQUOI NOUS --}}
<section class="section-padding"
    style="background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('{{ asset('assets/img/bg-frame-work.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">

                {{-- TITRE --}}
                <h3 class="mb-4 fw-bold text-white">
                    {{ __('home.why_us_title') }}
                </h3>

                {{-- SOUS-TITRE --}}
                <h4 class="text-white-50 mb-3 fw-light">
                    {{ __('home.why_us_subtitle') }}
                </h4>

                {{-- LISTE 1 : LES PROBLÈMES --}}
                <ul class="list-unstyled mb-4">
                    @foreach(__('home.why_us_pain_points') as $point)
                    <li class="d-flex align-items-start mb-2 text-white">
                        <i class="fas fa-check-circle text-warning mt-1 me-3"></i>
                        <span>{{ $point }}</span>
                    </li>
                    @endforeach
                </ul>

                {{-- SOLUTION --}}
                <div class="text-white text-justify opacity-90 mb-4" style="line-height: 1.8;">
                    <p>{{ __('home.why_us_solution') }}</p>
                </div>

                {{-- RÉSUMÉ --}}
                <p class="text-white fw-bold mb-3">{{ __('home.why_us_summary') }}</p>

                {{-- LISTE 2 : LES AVANTAGES --}}
                <ul class="list-unstyled mb-4">
                    @foreach(__('home.why_us_benefits') as $benefit)
                    <li class="d-flex align-items-start mb-2 text-white">
                        <i class="fas fa-star text-warning mt-1 me-3"></i>
                        <span>{{ $benefit }}</span>
                    </li>
                    @endforeach
                </ul>

            </div>

            {{-- IMAGE DE DROITE --}}
            <div class="col-lg-5">
                <img src="{{ asset('assets/img/pourquoi_avec_nous.jpg') }}"
                    class="img-fluid rounded shadow-lg border border-4 border-white" alt="Pourquoi nous choisir">
            </div>
        </div>
    </div>
</section>

{{-- SECTION SERVICES --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--primary-color);">
                {{ __('home.services_title') }}
            </h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4">
            @forelse($services as $svc)
            @php
            if (strpos($svc->image, 'http') === 0) {
            $imgSrc = $svc->image;
            }
            elseif (strpos($svc->image, 'assets/') === 0) {
            $imgSrc = asset($svc->image);
            }
            else {
            $imgSrc = asset('storage/' . $svc->image);
            }

            $linkUrl = (strpos($svc->link, 'http') === 0) ? $svc->link : url($svc->link);
            @endphp

            <div class="col-md-6 col-lg-3">
                <a href="{{ $linkUrl }}" class="service-grid-card" style="background-image: url('{{ $imgSrc }}');">
                    <div class="service-grid-content">
                        <h3>{{ $svc->title }}</h3>
                    </div>
                    <div class="service-overlay">
                        <div class="service-overlay-content">
                            <h4 class="text-warning mb-3">{{ $svc->title }}</h4>
                            <p>{!! nl2br(e($svc->description)) !!}</p>
                            <span class="btn btn-sm btn-outline-light rounded-pill mt-2">
                                {{ __('home.learn_more') }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>{{ __('home.no_services') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- SECTION STATS --}}
<section class="position-relative w-100" id="stats-section">
    <img src="{{ asset('assets/img/Background-nombre-de-clients-taux-de-conservation-1.jpg') }}" alt="Stats Background"
        class="w-100 d-block" style="height: auto; min-height: 250px; object-fit: cover;">

    <div class="position-absolute top-50 start-0 w-100 translate-middle-y text-white text-center"
        style="text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
        <div class="container">
            <div class="row">
                @foreach($stats as $s)
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold" style="color: var(--secondary-color);">
                        <span class="counter" data-target="{{ $s->value }}">0</span>{{ $s->suffix }}
                    </div>
                    <div class="fw-bold text-uppercase letter-spacing-1">{{ $s->label }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ==================================================================== --}}
{{-- ICI : INTÉGRATION DES AVIS GOOGLE (Remplace les témoignages manuels) --}}
{{-- ==================================================================== --}}
@include('sections.google-reviews')

{{-- SECTION BLOG --}}
<x-blog-section />

@include('partials.footer')