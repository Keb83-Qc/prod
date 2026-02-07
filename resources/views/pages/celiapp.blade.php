@include('partials.header')

{{-- SECTION 1 : INTRO HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-primary text-white mb-2">Immobilier & Épargne</span>
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('celiapp.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('celiapp.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('celiapp.intro_p1') }}</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('celiapp.intro_list_1') }}</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> {{ __('celiapp.intro_list_2') }}</li>
                    </ul>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('celiapp.btn_open') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('celiapp.btn_contact') }}
                    </a>
                    <a href="https://celiappcalculateur.ca/simulation" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">
                        <i class="fas fa-calculator me-2"></i> {{ __('celiapp.btn_calc') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Quest-ce-que-le-CELIAPP.jpg') }}" alt="CÉLIAPP" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : À QUOI ÇA SERT & ADMISSIBILITÉ --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">
            {{-- Colonne Gauche : Utilité --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('celiapp.usage_title') }}</h3>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 d-flex"><i class="fas fa-arrow-right text-warning me-3 mt-1"></i> {{ __('celiapp.usage_1') }}</li>
                    <li class="mb-3 d-flex"><i class="fas fa-arrow-right text-warning me-3 mt-1"></i> {{ __('celiapp.usage_2') }}</li>
                    <li class="mb-3 d-flex"><i class="fas fa-arrow-right text-warning me-3 mt-1"></i> {{ __('celiapp.usage_3') }}</li>
                    <li class="mb-3 d-flex"><i class="fas fa-arrow-right text-warning me-3 mt-1"></i> {{ __('celiapp.usage_4') }}</li>
                </ul>

                <div class="p-3 bg-white rounded shadow-sm border-start border-4 border-success">
                    <h6 class="fw-bold text-success">{{ __('celiapp.usage_example_title') }}</h6>
                    <p class="small text-muted mb-0">{{ __('celiapp.usage_example_text') }}</p>
                </div>
            </div>

            {{-- Colonne Droite : Admissibilité & Cotisation --}}
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <h4 class="fw-bold mb-3">{{ __('celiapp.rules_title') }}</h4>

                    <h6 class="fw-bold text-primary mt-2">{{ __('celiapp.eligibility_title') }}</h6>
                    <ul class="list-unstyled small text-muted mb-4">
                        <li><i class="fas fa-user-check me-2"></i> {{ __('celiapp.elig_1') }}</li>
                        <li><i class="fas fa-calendar me-2"></i> {{ __('celiapp.elig_2') }}</li>
                        <li><i class="fas fa-home me-2"></i> {{ __('celiapp.elig_3') }}</li>
                    </ul>

                    <h6 class="fw-bold text-primary">{{ __('celiapp.contrib_title') }}</h6>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li><i class="fas fa-coins me-2"></i> {{ __('celiapp.contrib_1') }}</li>
                        <li><i class="fas fa-piggy-bank me-2"></i> {{ __('celiapp.contrib_2') }}</li>
                        <li><i class="fas fa-hourglass-start me-2"></i> {{ __('celiapp.contrib_3') }}</li>
                        <li><i class="fas fa-history me-2"></i> {{ __('celiapp.contrib_4') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : TABLEAU COMPARATIF (CÉLIAPP vs CÉLI vs REER) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('celiapp.features_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('celiapp.feat_subtitle') }}</p>
        </div>

        <div class="table-responsive shadow-lg rounded">
            <table class="table table-hover mb-0 text-center align-middle">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 text-start ps-4">{{ __('celiapp.table_col_feature') }}</th>
                        <th class="py-3 bg-primary text-white" style="width: 25%;">{{ __('celiapp.table_col_celiapp') }}</th>
                        <th class="py-3" style="width: 25%;">{{ __('celiapp.table_col_celi') }}</th>
                        <th class="py-3" style="width: 25%;">{{ __('celiapp.table_col_reer') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start ps-4 fw-bold">{{ __('celiapp.row_obj') }}</td>
                        <td class="fw-bold text-primary bg-light">{{ __('celiapp.row_obj_celiapp') }}</td>
                        <td>{{ __('celiapp.row_obj_celi') }}</td>
                        <td>{{ __('celiapp.row_obj_reer') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('celiapp.row_deduct') }}</td>
                        <td class="fw-bold text-success bg-light">{{ __('celiapp.val_yes') }}</td>
                        <td class="text-muted">{{ __('celiapp.val_no') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_yes') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('celiapp.row_withdraw') }}</td>
                        <td class="fw-bold text-success bg-light">{{ __('celiapp.val_yes_buy') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_yes') }}</td>
                        <td class="text-muted">{{ __('celiapp.val_no') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('celiapp.row_growth') }}</td>
                        <td class="fw-bold text-success bg-light">{{ __('celiapp.val_yes') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_yes') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_yes') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('celiapp.row_refund') }}</td>
                        <td class="fw-bold text-success bg-light">{{ __('celiapp.val_no') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_no') }}</td>
                        <td class="text-warning">{{ __('celiapp.val_if_rap') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- SECTION 4 : STRATÉGIES & FAQ --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-start">
            {{-- Stratégies --}}
            <div class="col-lg-5 mb-5 mb-lg-0">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('celiapp.strat_title') }}</h3>

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-layer-group fa-2x text-info me-3"></i>
                            <h5 class="fw-bold mb-0">{{ __('celiapp.rap_title') }}</h5>
                        </div>
                        <p class="small text-muted mb-0">{{ __('celiapp.rap_text') }}</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-sync-alt fa-2x text-warning me-3"></i>
                            <h5 class="fw-bold mb-0">{{ __('celiapp.no_buy_title') }}</h5>
                        </div>
                        <p class="small text-muted mb-0">{{ __('celiapp.no_buy_text') }}</p>
                    </div>
                </div>

                {{-- CTA Box --}}
                <div class="mt-4 p-4 bg-dark text-white rounded text-center">
                    <h5 class="fw-bold mb-2">{{ __('celiapp.cta_title') }}</h5>
                    <p class="small opacity-75 mb-3">{{ __('celiapp.cta_text') }}</p>
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-warning rounded-pill fw-bold text-dark w-100 hover-scale">
                        {{ __('celiapp.cta_btn') }}
                    </a>
                </div>
            </div>

            {{-- FAQ --}}
            <div class="col-lg-7">
                <h3 class="fw-bold mb-4 text-primary">{{ __('celiapp.faq_title') }}</h3>
                <div class="accordion shadow-sm" id="faqAccordion">
                    @foreach(range(1, 4) as $i)
                    <div class="accordion-item mb-2 border-0 rounded overflow-hidden">
                        <h2 class="accordion-header" id="heading{{$i}}">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}">
                                {{ __('celiapp.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white text-muted small">
                                {{ __('celiapp.faq_a' . $i) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 : ZONE CONSEILS --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('celiapp.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('celiapp.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-home fa-3x"></i></div>
                <p class="text-muted">{{ __('celiapp.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('celiapp.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .hover-scale:hover {
        transform: scale(1.02);
        transition: transform 0.3s;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: var(--primary-color);
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.1);
    }
</style>

@include('partials.footer')