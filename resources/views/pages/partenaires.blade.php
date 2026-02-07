@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">

        {{-- En-tête de la page --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4 fw-bold" style="color: var(--primary-color);">{{ __('partenaires.title') }}</h2>
                <div class="text-muted" style="line-height: 1.8;">
                    <p>{{ __('partenaires.subtitle') }}</p>
                </div>
            </div>
        </div>

        {{-- Grille des partenaires --}}
        <div class="row g-4 justify-content-center align-items-center">

            @if(isset($partners) && $partners->count() > 0)
            @foreach($partners as $partner)
            @php
            // Utilisation de l'accesseur intelligent du modèle (Gère FR/EN)
            $logoSrc = $partner->logo_url;
            @endphp

            <div class="col-6 col-md-4 col-lg-3">
                <div
                    class="card h-100 border-0 shadow-sm p-4 d-flex align-items-center justify-content-center partner-card">

                    {{-- Lien vers le site du partenaire --}}
                    @if($partner->website)
                    <a href="{{ $partner->website }}" target="_blank"
                        class="d-flex align-items-center justify-content-center w-100 h-100 text-decoration-none">
                        @endif

                        {{-- Logo du partenaire --}}
                        @if($logoSrc)
                        <img src="{{ $logoSrc }}" alt="{{ $partner->name }}" class="img-fluid partner-logo"
                            title="{{ $partner->name }}" style="max-height: 80px; width: auto; object-fit: contain;">
                        @else
                        {{-- Fallback si image introuvable --}}
                        <span class="fw-bold text-muted">{{ $partner->name }}</span>
                        @endif

                        @if($partner->website)
                    </a>
                    @endif

                </div>
            </div>
            @endforeach
            @else
            <div class="col-12 text-center py-5">
                <p class="text-muted fst-italic">{{ __('partenaires.empty_list') }}</p>
            </div>
            @endif

        </div>
    </div>
</section>

{{-- Styles CSS --}}
<style>
    .partner-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        border-radius: 10px;
    }

    .partner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .partner-logo {
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .partner-card:hover .partner-logo {
        filter: grayscale(0%);
        opacity: 1;
    }
</style>

@include('partials.footer')