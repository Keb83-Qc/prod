@include('partials.header')

{{-- SECTION 1 : INTRO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-info text-white mb-2">Voyage & Santé</span>
                <h1 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-voyage.title') }}</h1>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p class="lead">{{ __('assurance-voyage.intro_p1') }}</p>
                    <p>{{ __('assurance-voyage.intro_p2') }}</p>
                </div>

                {{-- Boutons d'action --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('assurance-voyage.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('assurance-voyage.btn_contact') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/coup-moyen-famille-heureuse-aeroport.jpg') }}" alt="Famille aéroport" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : QU'EST-CE QUE C'EST & POURQUOI (Coûts) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">
            {{-- Colonne Gauche : Définition --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('assurance-voyage.what_title') }}</h3>
                <p class="text-muted">{{ __('assurance-voyage.what_text') }}</p>

                <div class="alert alert-warning border-0 shadow-sm d-flex align-items-start mt-3">
                    <i class="fas fa-exclamation-triangle mt-1 me-3"></i>
                    <div>
                        <strong>Attention :</strong> {{ __('assurance-voyage.ramq_note') }}
                    </div>
                </div>

                <h4 class="fw-bold mt-4 mb-3">{{ __('assurance-voyage.purpose_title') }}</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-voyage.purpose_1') }}</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-voyage.purpose_2') }}</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-voyage.purpose_3') }}</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('assurance-voyage.purpose_4') }}</li>
                </ul>
            </div>

            {{-- Colonne Droite : Coûts réels (Pourquoi) --}}
            <div class="col-lg-6">
                <div class="p-4 bg-white rounded shadow-sm border-top border-4 border-danger h-100">
                    <h3 class="fw-bold mb-2 text-danger">{{ __('assurance-voyage.why_title') }}</h3>
                    <p class="text-muted small mb-4">{{ __('assurance-voyage.why_subtitle') }}</p>

                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                        <i class="fas fa-hospital fa-2x text-danger me-3"></i>
                        <div>
                            <small class="d-block text-uppercase fw-bold text-muted">Hospitalisation (USA)</small>
                            <span class="fw-bold">{{ __('assurance-voyage.cost_ex_1') }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                        <i class="fas fa-ambulance fa-2x text-danger me-3"></i>
                        <div>
                            <small class="d-block text-uppercase fw-bold text-muted">Transport d'urgence</small>
                            <span class="fw-bold">{{ __('assurance-voyage.cost_ex_2') }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                        <i class="fas fa-plane-slash fa-2x text-warning me-3"></i>
                        <div>
                            <small class="d-block text-uppercase fw-bold text-muted">Annulation</small>
                            <span class="fw-bold">{{ __('assurance-voyage.cost_ex_3') }}</span>
                        </div>
                    </div>

                    <p class="mt-4 fw-bold text-center fst-italic">"{{ __('assurance-voyage.why_conclusion') }}"</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : TYPES DE COUVERTURES (GRID) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-voyage.types_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Type 1 : Médical --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/vaccination_3382495.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold">{{ __('assurance-voyage.type_1_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-voyage.type_1_desc') }}</p>
                </div>
            </div>
            {{-- Type 2 : Annulation --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/no-travelling_4310444.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold">{{ __('assurance-voyage.type_2_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-voyage.type_2_desc') }}</p>
                </div>
            </div>
            {{-- Type 3 : Interruption --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/quarantine_2746245.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold">{{ __('assurance-voyage.type_3_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-voyage.type_3_desc') }}</p>
                </div>
            </div>
            {{-- Type 4 : Bagages --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/unable-travel_11354603.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold">{{ __('assurance-voyage.type_4_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-voyage.type_4_desc') }}</p>
                </div>
            </div>
            {{-- Type 5 : Annuelle --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/csr_11152667.png') }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold">{{ __('assurance-voyage.type_5_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('assurance-voyage.type_5_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : CIBLE & FAQ --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            {{-- Colonne Gauche : Cible --}}
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-voyage.target_title') }}</h3>
                <ul class="list-group shadow-sm border-0">
                    @foreach(range(1, 5) as $i)
                    <li class="list-group-item border-0 p-3 d-flex align-items-center">
                        <i class="fas fa-user-check text-primary me-3"></i>
                        {{ __('assurance-voyage.target_' . $i) }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Colonne Droite : FAQ --}}
            <div class="col-lg-8">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-voyage.faq_title') }}</h3>
                <div class="accordion" id="faqAccordion">
                    @foreach(range(1, 6) as $i)
                    <div class="accordion-item mb-2 border-0 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{$i}}">
                                {{ __('assurance-voyage.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="faq{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ __('assurance-voyage.faq_a' . $i) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : PARTENAIRES & CTA --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-voyage.partners_title') }}</h2>
                <div class="text-muted text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('assurance-voyage.partners_text') }}</p>
                </div>
                <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-5 shadow-sm text-white fw-bold">
                    {{ __('assurance-voyage.btn_contact') }}
                </a>
            </div>

            <div class="col-lg-7">
                {{-- Carousel des logos partenaires --}}
                <div class="row g-3 justify-content-center align-items-center">
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-24.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-24mm.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-24t.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-243.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-243r.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-243t2.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-24des.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                    <div class="col-6 col-sm-4 col-md-3"><img src="{{ asset('assets/img/image-24a.png') }}" class="img-fluid opacity-75 hover-opacity-100" alt="Partenaire"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 : ZONE CONSEILS --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-voyage.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('assurance-voyage.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-plane fa-3x"></i></div>
                <p class="text-muted">{{ __('assurance-voyage.blog_no_article') }}</p>
            </div>
            @elseif(isset($conseils))
            @foreach($conseils as $post)
            @php
            $lang = app()->getLocale();
            $title = ($lang == 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
            $rawContent = ($lang == 'en' && !empty($post->content_en)) ? $post->content_en : $post->content;
            $desc = Str::limit(strip_tags(html_entity_decode($rawContent)), 100, '...');
            $imgSrc = !empty($post->image) ? asset($post->image) : asset('assets/img/default.jpg');
            $link = url('/article/' . $post->id);
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div style="height: 200px; background-color: #ddd; background-image: url('{{ $imgSrc }}'); background-size: cover; background-position: center;"></div>
                    <div class="card-body text-center p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small text-uppercase">
                            <i class="far fa-calendar-alt text-warning me-1"></i> {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('assurance-voyage.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

{{-- Style CSS --}}
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .hover-opacity-100:hover {
        opacity: 1 !important;
        transition: opacity 0.3s;
    }
</style>

@include('partials.footer')