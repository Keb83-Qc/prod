@include('partials.header')

{{-- On force l'affichage du header ici ou on laisse le partials.header le faire s'il détecte $header_title --}}
<section class="page-header"
    style="background-image: url('{{ asset('assets/img/canvas.png') }}'); background-size: cover; background-position: center;">
    <div class="container text-center">
        {{-- Titre traduit --}}
        <h1 class="text-white text-uppercase fw-bold mb-3">{{ __('evenements.title') }}</h1>
        {{-- Sous-titre traduit --}}
        <p class="lead text-white-50">{{ __('evenements.subtitle') }}</p>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="mb-4">
            {{-- Titre de section traduit --}}
            <h3 class="fw-bold" style="color: var(--primary-color);">{{ __('evenements.upcoming_events') }}</h3>
            <div style="width: 50px; height: 3px; background: var(--secondary-color); margin-top: 10px;"></div>
        </div>

        @if($events->isEmpty())
        <div class="text-center py-5">
            <i class="far fa-calendar-times fa-4x text-muted mb-3"></i>
            {{-- Message "Aucun événement" traduit --}}
            <p class="h5 text-muted">{{ __('evenements.no_events') }}</p>
            {{-- Bouton traduit --}}
            <a href="{{ url('/contact') }}" class="btn btn-primary mt-3">{{ __('evenements.contact_btn') }}</a>
        </div>
        @else
        <div class="row g-4">
            @foreach($events as $event)
            <x-event-card :event="$event" />
            @endforeach
        </div>
        @endif
    </div>
</section>

@include('partials.footer')