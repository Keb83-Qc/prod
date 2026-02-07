@include('partials.header')

<section class="d-flex align-items-center justify-content-center" style="min-height: 70vh; background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">

                <div class="mb-4 position-relative d-inline-block">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 120px; height: 120px; background-color: rgba(201, 160, 80, 0.1);">
                        <i class="fas fa-tools fa-4x" style="color: var(--secondary-color);"></i>
                    </div>
                    <div class="position-absolute top-0 end-0 bg-warning rounded-circle p-2 shadow-sm">
                        <i class="fas fa-exclamation text-dark"></i>
                    </div>
                </div>

                {{-- Titre Traduit --}}
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('construction.title') }}</h1>

                {{-- Message Traduit --}}
                <p class="lead text-muted mb-4 mx-auto" style="max-width: 600px;">
                    {{ __('construction.message') }}
                </p>

                <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row">
                    <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-home me-2"></i> {{ __('construction.btn_home') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark px-4 py-2">
                        {{ __('construction.btn_contact') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@include('partials.footer')