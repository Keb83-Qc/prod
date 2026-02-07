@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            {{-- COLONNE GAUCHE : FORMULAIRE --}}
            <div class="col-lg-7 pe-lg-5 mb-5 mb-lg-0">
                <h2 class="mb-4 fw-bold" style="color: var(--primary-color);">{{ __('contact.title') }}</h2>
                <p class="text-muted mb-4">{{ __('contact.subtitle') }}</p>

                <form method="POST" action="{{ url('/contact') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <input type="text" name="first_name" class="form-control form-line"
                                placeholder="{{ __('contact.placeholder_name') }}" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="email" name="email" class="form-control form-line"
                                placeholder="{{ __('contact.placeholder_email') }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="subject" class="form-control form-line"
                            placeholder="{{ __('contact.placeholder_subject') }}" value="{{ $objet_par_defaut }}"
                            required>
                    </div>
                    <div class="mb-5">
                        <textarea name="message" class="form-control form-line" rows="5"
                            placeholder="{{ __('contact.placeholder_message') }}"
                            required>{{ $message_par_defaut }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-5">{{ __('contact.submit_btn') }}</button>
                </form>
            </div>

            {{-- COLONNE DROITE : INFOS --}}
            <div class="col-lg-5 ps-lg-5">
                <div class="p-4 bg-light rounded shadow-sm">
                    <h4 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('contact.coordinates_title') }}
                    </h4>

                    {{-- Adresse --}}
                    <div class="d-flex mb-4">
                        <i class="fas fa-map-marker-alt fa-2x text-warning me-3"></i>
                        <div>
                            <h6 class="fw-bold">{{ __('contact.address_label') }}</h6>
                            <p class="text-muted mb-0">{!! __('contact.address_text') !!}</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="d-flex mb-4">
                        <i class="fas fa-envelope fa-2x text-warning me-3"></i>
                        <div>
                            <h6 class="fw-bold">{{ __('contact.email_label') }}</h6>
                            <p class="text-muted mb-0">{{ $settings['site_email'] ?? 'admin@vipgpi.ca' }}</p>
                        </div>
                    </div>

                    {{-- Note : Vous pourrez ajouter Téléphone ici plus tard en suivant le même modèle --}}
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')