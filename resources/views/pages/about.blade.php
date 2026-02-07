@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">

        {{-- SECTION 1 : À PROPOS --}}
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="mb-4 fw-bold" style="color: var(--primary-color);">
                    {{ __('about.title') }}
                </h2>

                <div class="text-muted text-justify" style="line-height: 1.8;">
                    <p class="fw-bold text-dark">
                        {{ __('about.intro_bold') }}
                    </p>

                    <p>{{ __('about.intro_p1') }}</p>

                    <p>{{ __('about.intro_p2') }}</p>

                    <p class="fst-italic text-dark border-start border-4 border-warning ps-3 my-4">
                        "{{ __('about.quote') }}"
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/A-coteTexte-a-propos.jpg') }}" alt="{{ __('about.title') }}"
                    class="section-img shadow rounded">
            </div>
        </div>

        {{-- SECTION 2 : NOTRE APPROCHE --}}
        <div class="row align-items-center mt-5 pt-lg-4">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0 ps-lg-5">
                <h2 class="mb-4 fw-bold" style="color: var(--primary-color);">
                    {{ __('about.approach_title') }}
                </h2>

                <div class="text-muted text-justify" style="line-height: 1.8;">
                    <p>{{ __('about.approach_p1') }}</p>

                    <p>{{ __('about.approach_p2') }}</p>

                    <p>{{ __('about.approach_p3') }}</p>

                    <a href="{{ url('/contact') }}" class="btn btn-primary mt-3 shadow-sm">
                        {{ __('about.cta_button') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('assets/img/006-Edited.jpg') }}" alt="{{ __('about.approach_title') }}"
                    class="section-img shadow rounded">
            </div>
        </div>

    </div>
</section>

@include('partials.footer')