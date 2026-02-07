@php
// On récupère les avis visibles, triés par les plus récents, max 10
// On utilise le chemin complet vers le modèle pour éviter les erreurs d'import
$reviews = \App\Models\GoogleReview::visible()->take(10)->get();
@endphp

@if($reviews->count() > 0)
<section class="section-padding bg-white py-5 position-relative">
    <div class="container">

        {{-- En-tête de section --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--primary-color);">Ce que nos clients disent</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span class="fw-bold fs-5 text-dark">4.9</span>
                <div class="text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <span class="text-muted small">sur Google</span>
            </div>
        </div>

        {{-- Le Slider Swiper --}}
        <div class="swiper google-reviews-slider pb-5">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="background: #f8f9fa;">

                        {{-- Haut de la carte : Auteur + Date --}}
                        <div class="d-flex align-items-center mb-3">
                            @if($review->author_photo_url)
                            <img src="{{ $review->author_photo_url }}" alt="{{ $review->author_name }}"
                                class="rounded-circle me-3" style="width: 45px; height: 45px;">
                            @else
                            <div class="rounded-circle me-3 bg-secondary d-flex align-items-center justify-content-center text-white fw-bold"
                                style="width: 45px; height: 45px;">
                                {{ substr($review->author_name, 0, 1) }}
                            </div>
                            @endif
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $review->author_name }}</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    {{ $review->review_time->diffForHumans() }}
                                </small>
                            </div>
                            <i class="fab fa-google text-muted ms-auto fs-4 opacity-25"></i>
                        </div>

                        {{-- Étoiles --}}
                        <div class="mb-3 text-warning small">
                            @for($i = 0; $i < 5; $i++) @if($i < $review->rating)
                                <i class="fas fa-star"></i>
                                @else
                                <i class="far fa-star"></i>
                                @endif
                                @endfor
                        </div>

                        {{-- Texte --}}
                        <div class="card-text text-secondary small" style="line-height: 1.6;">
                            @if(strlen($review->text) > 120)
                            {{ Str::limit($review->text, 120) }}
                            @else
                            {{ $review->text }}
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination (les petits points en bas) --}}
            <div class="swiper-pagination position-relative mt-4"></div>
        </div>

        {{-- Bouton d'action
        <div class="text-center mt-2">
            <a href="https://search.google.com/local/writereview?placeid={{ env('GOOGLE_PLACE_ID') }}" target="_blank"
        class="btn btn-outline-primary rounded-pill px-4 fw-bold hover-lift">
        <i class="fas fa-pen me-2"></i> Donnez votre avis sur Google
        </a>
    </div>

    </div>--}}
</section>

{{-- Styles et Scripts nécessaires pour le Slider --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    .swiper-pagination-bullet-active {
        background-color: var(--primary-color) !important;
    }

    .swiper-slide {
        height: auto;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".google-reviews-slider", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });
    });
</script>
@endif