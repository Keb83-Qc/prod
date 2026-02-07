@include('partials.header')

@php
// 1. Image
$imgSrc = $member->image_url;
$full_name = $member->first_name . ' ' . $member->last_name;
$lang = app()->getLocale();

// 2. Logique du Titre (Robuste pour éviter l'erreur Array)
$display_role = 'Conseiller';

if ($member->title) {
// Si c'est un tableau (Spatie Translatable)
if (is_array($member->title->name)) {
$display_role = $member->title->name[$lang] ?? ($member->title->name['fr'] ?? array_values($member->title->name)[0]);
}
// Si c'est du JSON string
elseif (is_string($member->title->name) && str_starts_with($member->title->name, '{')) {
$decoded = json_decode($member->title->name, true);
$display_role = $decoded[$lang] ?? ($decoded['fr'] ?? $member->title->name);
}
// Si c'est une simple chaine
else {
$display_role = $member->title->name;
}
}
// Si pas de titre, on prend le rôle système
elseif ($member->role) {
$display_role = ucfirst($member->role->name);
}
@endphp

<section class="section-padding bg-light" style="margin-top: -80px; padding-bottom: 80px;">
    <div class="container">
        <div class="row g-5">

            {{-- COLONNE GAUCHE (Sticky) --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg text-center p-4 sticky-top" style="top: 100px; z-index: 10;">

                    {{-- PHOTO --}}
                    <div class="d-flex justify-content-center w-100 mb-3" style="margin-top: -80px;">
                        <img src="{{ $imgSrc }}" alt="{{ $full_name }}"
                            class="rounded-circle shadow border border-4 border-white bg-white"
                            style="width: 180px; height: 180px; object-fit: cover;">
                    </div>

                    {{-- AJOUT : NOM ET TITRE SOUS LA PHOTO --}}
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-1 h3">{{ $full_name }}</h2>
                        <div class="text-primary fw-bold text-uppercase small">{{ $display_role }}</div>
                        @if(!empty($member->city))
                        <div class="text-muted small mt-1"><i class="fas fa-map-marker-alt me-1"></i> {{ $member->city }}</div>
                        @endif
                    </div>
                    {{-- FIN AJOUT --}}

                    <h4 class="fw-bold mb-3 text-dark border-top pt-3">{{ __('team_detail.contact_me') }}</h4>

                    <div class="d-grid gap-2 text-start px-2">
                        @if(!empty($member->email))
                        <a href="mailto:{{ $member->email }}"
                            class="btn btn-light border d-flex align-items-center justify-content-center py-2 text-decoration-none">
                            <i class="fas fa-envelope text-warning me-2"></i>
                            <span class="text-dark text-truncate">{{ $member->email }}</span>
                        </a>
                        @endif

                        @if(!empty($member->phone))
                        <a href="tel:{{ $member->phone }}"
                            class="btn btn-light border d-flex align-items-center justify-content-center py-2 text-decoration-none">
                            <i class="fas fa-phone text-warning me-2"></i>
                            <span class="text-dark">{{ $member->phone }}</span>
                        </a>
                        @endif

                        @if(!empty($member->facebook_url))
                        <a href="{{ $member->facebook_url }}" target="_blank" class="btn btn-primary mt-2 border-0"
                            style="background-color: #1877F2;">
                            <i class="fab fa-facebook-f me-2"></i> {{ __('team_detail.facebook_btn') }}
                        </a>
                        @endif

                        {{-- BLOC SOUMISSION AUTO --}}
                        @if(!empty($member->advisor_code))
                        <div class="mt-4 p-3 rounded" style="background-color: #f8f1e5; border: 1px dashed #c9a050;">
                            <h6 class="fw-bold text-dark mb-2" style="font-size: 0.9rem;">
                                {{ __('team_detail.auto_insurance_title') }}
                            </h6>
                            <p class="text-muted mb-3" style="font-size: 0.8rem;">
                                {{ __('team_detail.auto_insurance_text') }}
                            </p>
                            <a href="{{ route('consent.show', ['code' => $member->advisor_code]) }}"
                                class="btn btn-dark w-100 fw-bold shadow-sm py-2">
                                <i class="fas fa-car me-2 text-warning"></i> {{ __('team_detail.auto_insurance_btn') }}
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        @if(!empty($member->booking_url))
                        <a href="{{ $member->booking_url }}" target="_blank"
                            class="btn btn-success w-100 shadow-sm fw-bold py-2">
                            <i class="fas fa-calendar-check me-2"></i> {{ __('team_detail.book_appointment') }}
                        </a>
                        @else
                        <a href="{{ url('/contact') }}" class="btn btn-dark w-100 shadow-sm fw-bold py-2">
                            <i class="fas fa-paper-plane me-2"></i> {{ __('team_detail.send_message') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- COLONNE DROITE (Bio) --}}
            <div class="col-lg-8" style="padding-top: 80px;">
                <div class="bg-white p-5 rounded shadow-sm h-100">
                    <h3 class="fw-bold text-dark mb-4 border-bottom pb-3">
                        {{ __('team_detail.bio_title') }}
                    </h3>

                    <div class="content-area text-secondary" style="font-size: 1.1rem; line-height: 1.8;">
                        @if(!empty($member->bio))
                        {!! $member->bio !!}
                        @else
                        <p class="text-muted fst-italic">{{ __('team_detail.bio_empty') }}</p>
                        @endif
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <a href="{{ url('/equipe') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-2"></i> {{ __('team_detail.back_to_team') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Schema.org --}}
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $full_name }}",
        "jobTitle": "{{ $display_role }}",
        "image": "{{ $imgSrc }}",
        "email": "{{ $member->email ?? '' }}",
        "telephone": "{{ $member->phone ?? '' }}",
        "worksFor": {
            "@type": "FinancialService",
            "name": "VIP GPI Services Financiers",
            "url": "{{ url('/') }}"
        }
    }
</script>

@include('partials.footer')