@include('partials.header')

{{--
   NOTE : Le HERO est géré par le Header.
   Le contenu commence ici.
--}}

{{-- SECTION 1 : MISSION & VISION --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('assets/img/carrieres2.jpg') }}" alt="Équipe VIP" class="img-fluid rounded-4 shadow-lg img-constrained">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h3 class="fw-bold mb-4 text-primary">Notre Mission</h3>
                <p class="fs-5 text-dark fw-bold mb-3">{{ __('carrieres.mission_intro') }}</p>
                <p class="text-muted mb-4">{{ __('carrieres.mission_text') }}</p>
                <div class="p-3 bg-light border-start border-4 border-warning rounded-end">
                    <p class="mb-0 fw-bold text-dark">{{ __('carrieres.mission_bold') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : LES 3 PILIERS --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase text-primary fw-bold small ls-2">{{ __('carrieres.pillars_subtitle') }}</span>
            <h2 class="fw-bold display-6 mt-2">{{ __('carrieres.pillars_title') }}</h2>
            <p class="text-muted w-75 mx-auto">{{ __('carrieres.pillars_intro') }}</p>
        </div>

        <div class="row g-4">
            {{-- Pilier 1 --}}
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-card p-3">
                    <div class="card-body">
                        <div class="icon-box mb-4 text-warning text-center"><i class="fas fa-crown fa-3x"></i></div>
                        <h4 class="fw-bold text-center">{{ __('carrieres.p1_title') }}</h4>
                        <p class="text-center text-primary fw-bold small text-uppercase mb-3">{{ __('carrieres.p1_tag') }}</p>
                        <p class="text-muted text-center small mb-3">{{ __('carrieres.p1_desc') }}</p>
                        <ul class="small ps-3 text-muted">
                            @foreach(__('carrieres.p1_list') as $item)
                            <li class="mb-2">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Pilier 2 --}}
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-card p-3">
                    <div class="card-body">
                        <div class="icon-box mb-4 text-warning text-center"><i class="fas fa-graduation-cap fa-3x"></i></div>
                        <h4 class="fw-bold text-center">{{ __('carrieres.p2_title') }}</h4>
                        <p class="text-center text-primary fw-bold small text-uppercase mb-3">{{ __('carrieres.p2_tag') }}</p>
                        <p class="text-muted text-center small mb-3">{{ __('carrieres.p2_desc') }}</p>
                        <ul class="small ps-3 text-muted">
                            @foreach(__('carrieres.p2_list') as $item)
                            <li class="mb-2">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Pilier 3 --}}
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-card p-3">
                    <div class="card-body">
                        <div class="icon-box mb-4 text-warning text-center"><i class="fas fa-handshake fa-3x"></i></div>
                        <h4 class="fw-bold text-center">{{ __('carrieres.p3_title') }}</h4>
                        <p class="text-center text-primary fw-bold small text-uppercase mb-3">{{ __('carrieres.p3_tag') }}</p>

                        <div class="bg-light p-2 rounded mb-3 small">
                            <strong>{{ __('carrieres.p3_partners_intro') }}</strong><br>
                            <span class="text-success"><i class="fas fa-check me-1"></i> {{ __('carrieres.p3_insurers') }}</span><br>
                            <span class="text-info"><i class="fas fa-check me-1"></i> {{ __('carrieres.p3_banks') }}</span>
                        </div>
                        <p class="small text-muted fst-italic">{{ __('carrieres.p3_result') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : ÉCOSYSTÈME --}}
<section class="section-padding text-white"
    style="background: linear-gradient(rgba(14, 16, 48, 0.95), rgba(14, 16, 48, 0.9)), url('{{ asset('assets/img/carrieres3.jpg') }}'); background-size: cover; background-attachment: fixed;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('carrieres.eco_title') }}</h2>
            <h4 class="text-warning">{{ __('carrieres.eco_subtitle') }}</h4>
            <p class="opacity-75">{{ __('carrieres.eco_intro') }}</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="border border-warning rounded p-4 h-100 bg-black-50">
                    <h5 class="text-warning mb-3"><i class="fas fa-user-shield me-2"></i> {{ __('carrieres.eco_direct_title') }}</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach(__('carrieres.eco_direct_list') as $item)
                        <li class="mb-2 py-1 border-bottom border-secondary"><i class="fas fa-check text-success me-2"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="border border-light rounded p-4 h-100 bg-black-50">
                    <h5 class="text-white mb-3"><i class="fas fa-users me-2"></i> {{ __('carrieres.eco_indirect_title') }}</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach(__('carrieres.eco_indirect_list') as $item)
                        <li class="mb-2 py-1 border-bottom border-secondary"><i class="fas fa-plus text-info me-2"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p class="lead fw-bold text-warning"><i class="fas fa-star me-2"></i> {{ __('carrieres.eco_benefit') }}</p>
        </div>
    </div>
</section>

{{-- SECTION 4 : ENVIRONNEMENT, TECH & CULTURE --}}
<section class="section-padding bg-white">
    <div class="container">
        {{-- Partie Environnement (Vidéo 1) --}}
        <div class="row mb-5 pb-5 border-bottom align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                @php $videoEnv = $careerSettings->video_env ?? null; @endphp

                @if(!empty($videoEnv))
                {{-- CAS 1 : La vidéo existe --}}
                <div class="ratio ratio-16x9 rounded-4 shadow-lg overflow-hidden">
                    <iframe src="{{ $videoEnv }}" title="Environnement VIP" allowfullscreen></iframe>
                </div>
                @else
                {{-- CAS 2 : Pas de vidéo (Placeholder "Coming Soon") --}}
                <div class="ratio ratio-16x9 bg-light rounded-4 shadow border border-2 d-flex align-items-center justify-content-center text-muted">
                    <div class="text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-video-slash fa-3x opacity-25"></i>
                        </div>
                        <h5 class="fw-bold text-uppercase ls-1 opacity-50">{{ __('carrieres.env_video_label') }}</h5>
                        <span class="badge bg-secondary text-white mt-2 px-3 py-2 rounded-pill">
                            <i class="fas fa-hourglass-half me-2"></i> {{ __('carrieres.video_coming_soon') }}
                        </span>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-6 ps-lg-5">
                <h3 class="fw-bold mb-3">{{ __('carrieres.env_title') }}</h3>
                <p class="text-muted">{{ __('carrieres.env_intro') }}</p>
                <ul class="list-unstyled">
                    @foreach(__('carrieres.env_features') as $feature)
                    <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Partie Culture & Tech (Vidéo 2) --}}
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="bg-light p-4 rounded-4 h-100 d-flex flex-column">
                    <h4 class="fw-bold mb-3"><i class="fas fa-users text-primary me-2"></i> {{ __('carrieres.culture_title') }}</h4>
                    <p class="text-muted mb-4">{{ __('carrieres.culture_text') }}</p>

                    <div class="mt-auto">
                        @php $videoCult = $careerSettings->video_culture ?? null; @endphp

                        @if(!empty($videoCult))
                        {{-- CAS 1 : La vidéo existe --}}
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm">
                            <iframe src="{{ $videoCult }}" title="Culture VIP" allowfullscreen></iframe>
                        </div>
                        @else
                        {{-- CAS 2 : Pas de vidéo (Placeholder "Coming Soon") --}}
                        <div class="ratio ratio-16x9 bg-white rounded-3 border border-dashed d-flex align-items-center justify-content-center text-muted">
                            <div class="text-center">
                                <i class="fas fa-film fa-2x mb-2 opacity-25"></i><br>
                                <small class="fw-bold text-uppercase opacity-50">{{ __('carrieres.culture_video_label') }}</small><br>
                                <small class="text-warning fw-bold"><i class="fas fa-clock me-1"></i> {{ __('carrieres.video_coming_soon') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-light p-4 rounded-4 h-100">
                    <h4 class="fw-bold mb-3"><i class="fas fa-rocket text-primary me-2"></i> {{ __('carrieres.tech_title') }}</h4>
                    <p class="text-muted">{{ __('carrieres.tech_desc') }}</p>
                    <ul class="list-unstyled mt-3">
                        @foreach(__('carrieres.tech_list') as $tech)
                        <li class="mb-2"><i class="fas fa-angle-right text-warning me-2 fw-bold"></i> {{ $tech }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : PIPELINES (4 Chemins) --}}
<section id="pipelines" class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">{{ __('carrieres.pipe_main_title') }}</h2>
            <p class="lead text-muted">{{ __('carrieres.pipe_intro') }}</p>
        </div>

        <div class="row g-4">
            {{-- PIPELINE 1 : CONSEILLER --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow pipeline-card overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 bg-dark position-relative">
                            <img src="{{ asset('assets/img/carrieres2.jpg') }}" class="w-100 h-100 object-fit-cover opacity-75">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white fw-bold">1. Conseillers</div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <h5 class="fw-bold">{{ __('carrieres.pipe1_title') }}</h5>
                                <p class="small text-muted mb-3">{{ __('carrieres.pipe1_target') }}</p>
                                <ul class="small ps-3 mb-3 text-secondary">
                                    @foreach(__('carrieres.pipe1_list') as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <p class="small fw-bold text-dark mt-auto mb-3">{{ __('carrieres.pipe1_next') }}</p>

                                {{-- LOGIQUE BOUTON PRO --}}
                                @php $link1 = $careerSettings->link_advisor_licensed ?? null; @endphp
                                @if(!empty($link1))
                                <a href="{{ $link1 }}" class="btn btn-primary w-100 shadow-sm">{{ __('carrieres.pipe1_btn') }}</a>
                                @else
                                <button class="btn btn-secondary w-100 opacity-50" disabled style="cursor: not-allowed;">
                                    <i class="fas fa-clock me-2"></i> {{ __('carrieres.btn_coming_soon') }}
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PIPELINE 3 : CABINETS --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow pipeline-card overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 bg-dark position-relative">
                            <img src="{{ asset('assets/img/carrieres4.jpg') }}" class="w-100 h-100 object-fit-cover opacity-75">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white fw-bold">3. Cabinets</div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <h5 class="fw-bold">{{ __('carrieres.pipe3_title') }}</h5>
                                <p class="small text-muted mb-3">{{ __('carrieres.pipe3_target') }}</p>
                                <ul class="small ps-3 mb-3 text-secondary">
                                    @foreach(__('carrieres.pipe3_list') as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <p class="small fw-bold text-dark mt-auto mb-3">{{ __('carrieres.pipe3_next') }}</p>

                                {{-- LOGIQUE BOUTON PRO --}}
                                @php $link3 = $careerSettings->link_agency ?? null; @endphp
                                @if(!empty($link3))
                                <a href="{{ $link3 }}" class="btn btn-dark w-100 shadow-sm">{{ __('carrieres.pipe3_btn') }}</a>
                                @else
                                <button class="btn btn-secondary w-100 opacity-50" disabled style="cursor: not-allowed;">
                                    <i class="fas fa-clock me-2"></i> {{ __('carrieres.btn_coming_soon') }}
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PIPELINE 4 : LEADERS --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow pipeline-card overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 bg-dark position-relative">
                            <img src="{{ asset('assets/img/carrieres1.jpg') }}" class="w-100 h-100 object-fit-cover opacity-75">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white fw-bold">4. Leaders</div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <h5 class="fw-bold">{{ __('carrieres.pipe4_title') }}</h5>
                                <p class="small text-muted mb-3">{{ __('carrieres.pipe4_target') }}</p>
                                <ul class="small ps-3 mb-3 text-secondary">
                                    @foreach(__('carrieres.pipe4_list') as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <p class="small fw-bold text-dark mt-auto mb-3">{{ __('carrieres.pipe4_next') }}</p>

                                {{-- LOGIQUE BOUTON PRO --}}
                                @php $link4 = $careerSettings->link_team_leader ?? null; @endphp
                                @if(!empty($link4))
                                <a href="{{ $link4 }}" class="btn btn-outline-primary w-100 shadow-sm">{{ __('carrieres.pipe4_btn') }}</a>
                                @else
                                <button class="btn btn-secondary w-100 opacity-50" disabled style="cursor: not-allowed;">
                                    <i class="fas fa-clock me-2"></i> {{ __('carrieres.btn_coming_soon') }}
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PIPELINE 2 : FUTURS (Débutants) --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow pipeline-card overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 bg-dark position-relative">
                            <img src="{{ asset('assets/img/carrieres6.jpg') }}" class="w-100 h-100 object-fit-cover opacity-75">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white fw-bold">2. Futurs Conseillers</div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <h5 class="fw-bold">{{ __('carrieres.pipe2_title') }}</h5>
                                <p class="small text-muted mb-3">{{ __('carrieres.pipe2_target') }}</p>
                                <ul class="small ps-3 mb-3 text-secondary">
                                    @foreach(__('carrieres.pipe2_list') as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <p class="small fw-bold text-dark mt-auto mb-3">{{ __('carrieres.pipe2_next') }}</p>

                                {{-- LOGIQUE BOUTON PRO --}}
                                @php $link2 = $careerSettings->link_future_advisor ?? null; @endphp
                                @if(!empty($link2))
                                <a href="{{ $link2 }}" class="btn btn-outline-dark w-100 shadow-sm">{{ __('carrieres.pipe2_btn') }}</a>
                                @else
                                <button class="btn btn-secondary w-100 opacity-50" disabled style="cursor: not-allowed;">
                                    <i class="fas fa-clock me-2"></i> {{ __('carrieres.btn_coming_soon') }}
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .img-constrained {
        max-height: 380px;
        width: 100%;
        object-fit: cover;
    }

    .bg-black-50 {
        background: rgba(0, 0, 0, 0.5);
    }

    .hover-card {
        transition: transform 0.3s;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
    }

    @media (max-width: 768px) {
        .pipeline-card .col-md-5 {
            min-height: 200px;
        }
    }
</style>

@include('partials.footer')