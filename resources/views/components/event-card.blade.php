@props(['event'])

@php
// Utilisation de Carbon pour manipuler les dates facilement
$date = \Carbon\Carbon::parse($event->event_date);

// Formatage manuel des mois en FR pour être sûr (si le serveur n'a pas les locales FR installées)
$months_fr = ['Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sep','Oct','Nov','Déc'];
$month_display = $months_fr[$date->month - 1];

$day = $date->format('d');

// Heures
$start_h = \Carbon\Carbon::parse($event->start_time)->format('H:i');
$end_h = \Carbon\Carbon::parse($event->end_time)->format('H:i');
@endphp

<div class="col-md-6 col-lg-4">
    <div class="card h-100 border-0 shadow-sm hover-lift transition-all">
        <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column align-items-center justify-content-center p-3 text-white"
                style="background-color: var(--primary-color); min-width: 90px;">
                <span class="display-6 fw-bold">{{ $day }}</span>
                <span class="text-uppercase small letter-spacing-2">{{ $month_display }}</span>
            </div>

            <div class="p-3 w-100">
                <div class="mb-2">
                    {{-- On vérifie si is_internal est vrai (1 ou true) --}}
                    @if($event->is_internal)
                    <span class="badge bg-warning text-dark mb-2">Interne</span>
                    @endif
                    <h5 class="card-title fw-bold mb-1 text-dark">{{ $event->title }}</h5>
                </div>

                <div class="small text-muted mb-3">
                    <i class="far fa-clock me-1 text-warning"></i> {{ $start_h }} - {{ $end_h }} <br>
                    <i class="fas fa-map-marker-alt me-1 text-warning"></i> {{ $event->location }}
                </div>

                <p class="card-text small text-secondary">
                    {{-- Helper Laravel pour couper le texte proprement --}}
                    {!! nl2br(e(Str::limit($event->description, 100, '...'))) !!}
                </p>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 text-end">
            <a href="{{ url('/contact?sujet=Event_' . $event->id) }}"
                class="btn btn-sm btn-outline-primary rounded-pill">
                S'inscrire <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

{{-- On garde le style inline ou on le met dans style.css --}}
@once
<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}
</style>
@endonce
