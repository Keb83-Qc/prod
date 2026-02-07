<x-page-layout>

    <section class="section-padding bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('epargne.title') }}</h2>
                    <div class="text-muted text-justify" style="line-height: 1.8;">
                        <p>{{ __('epargne.intro_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/img/epargne-intro.jpg') }}" class="section-img rounded shadow" alt="Épargne">
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('epargne.solutions_title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            </div>

            <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-1">{{ __('epargne.tab_1_title') }}</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-2">{{ __('epargne.tab_2_title') }}</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-3">{{ __('epargne.tab_3_title') }}</button></li>
            </ul>

            <div class="tab-content bg-white p-5 rounded shadow-sm" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-1">
                    <h4 class="fw-bold mb-3" style="color:var(--primary-color);">{{ __('epargne.tab_1_h4') }}</h4>
                    <p>{{ __('epargne.tab_1_p') }}</p>
                </div>
                <div class="tab-pane fade" id="pills-2">
                    <h4 class="fw-bold mb-3" style="color:var(--primary-color);">{{ __('epargne.tab_2_h4') }}</h4>
                    <p>{{ __('epargne.tab_2_p') }}</p>
                </div>
                <div class="tab-pane fade" id="pills-3">
                    <h4 class="fw-bold mb-3" style="color:var(--primary-color);">{{ __('epargne.tab_3_h4') }}</h4>
                    <p>{{ __('epargne.tab_3_p') }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5 border-top">
        <div class="mb-5">
            <h3 class="text-center mb-4 fw-bold" style="color:var(--primary-color);">{{ __('epargne.prog_epargne_title') }}</h3>
            <div class="row g-4 justify-content-center">
                @php
                // MODIFICATION ICI : On utilise __('epargne.clé')
                $epargne = [
                ['t'=> __('epargne.reer'), 'l'=>'/reer', 'i'=>'epargne-reer.jpg'],
                ['t'=> __('epargne.celi'), 'l'=>'/celi', 'i'=>'epargne-celi.jpg'],
                ['t'=> __('epargne.celiapp'), 'l'=>'/celiapp', 'i'=>'epargne-celiapp.jpg'],
                ['t'=> __('epargne.reei'), 'l'=>'/reei', 'i'=>'reei.jpg'],
                ['t'=> __('epargne.non_reg'), 'l'=>'/regime-depargne-non-enregistre', 'i'=>'epargne-non-enreg.jpg']
                ];
                @endphp
                @foreach($epargne as $item)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ $item['l'] }}" class="service-grid-card small-card d-block position-relative rounded overflow-hidden shadow-sm hover-lift"
                        style="height: 200px; background-image: url('{{ asset('assets/img/'.$item['i']) }}'); background-size: cover; background-position: center;">
                        <div style="background: rgba(0,0,0,0.4); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                            <h3 class="text-white fw-bold m-0 text-uppercase" style="letter-spacing: 1px;">{{ $item['t'] }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5">
            <h3 class="text-center mb-4 fw-bold" style="color:var(--primary-color);">{{ __('epargne.prog_revenu_title') }}</h3>
            <div class="row g-4 justify-content-center">
                @php
                // MODIFICATION ICI AUSSI
                $revenu = [
                ['t'=> __('epargne.cri'), 'l'=>'/cri-2', 'i'=>'epargne-cri.jpg'],
                ['t'=> __('epargne.frv'), 'l'=>'/frv-2', 'i'=>'epargne-frv.jpg'],
                ['t'=> __('epargne.ferr'), 'l'=>'/ferr', 'i'=>'epargne-ferr.jpg']
                ];
                @endphp
                @foreach($revenu as $item)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ $item['l'] }}" class="service-grid-card small-card d-block position-relative rounded overflow-hidden shadow-sm hover-lift"
                        style="height: 200px; background-image: url('{{ asset('assets/img/'.$item['i']) }}'); background-size: cover; background-position: center;">
                        <div style="background: rgba(0,0,0,0.4); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                            <h3 class="text-white fw-bold m-0 text-uppercase">{{ $item['t'] }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5">
            <h3 class="text-center mb-4 fw-bold" style="color:var(--primary-color);">{{ __('epargne.prog_etudes_title') }}</h3>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="/reee" class="service-grid-card small-card d-block position-relative rounded overflow-hidden shadow-sm hover-lift"
                        style="height: 200px; background-image: url('{{ asset('assets/img/epargne-reee.jpg') }}'); background-size: cover; background-position: center;">
                        <div style="background: rgba(0,0,0,0.4); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                            {{-- MODIFICATION ICI : Utilisation de la clé reee --}}
                            <h3 class="text-white fw-bold m-0 text-uppercase">{{ __('epargne.reee') }}</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION BLOG SPÉCIFIQUE --}}
    <x-slot:blog>
        <x-blog-section
            :title="__('epargne.blog_title')"
            category="Épargne" />
    </x-slot:blog>

    <style>
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }
    </style>

</x-page-layout>