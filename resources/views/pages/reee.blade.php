@include('partials.header')

{{-- SECTION 1 : INTRO HERO --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-info text-white mb-2">Études & Avenir</span>
                <h1 class="fw-bold mb-3" style="color: var(--primary-color);">{{ __('reee.title') }}</h1>
                <h4 class="text-muted mb-4">{{ __('reee.subtitle') }}</h4>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>

                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('reee.intro_p1') }}</p>
                    <p>{{ __('reee.intro_p2') }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">
                        {{ __('reee.btn_quote') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        {{ __('reee.btn_contact') }}
                    </a>
                    <a href="https://financialservices.equisoft.com/resp/EducationNeeds.aspx?language={{ app()->getLocale() == 'en' ? 'en-CA' : 'fr-CA' }}" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">
                        <i class="fas fa-calculator me-2"></i> {{ __('reee.btn_calc') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/AdobeStock_552918635.png') }}" alt="REEE" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 : QU'EST-CE QUE C'EST (3 BÉNÉFICES) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--primary-color);">{{ __('reee.what_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted w-75 mx-auto">{{ __('reee.what_intro') }}</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 hover-lift text-center">
                    <div class="mb-3 text-success"><i class="fas fa-chart-line fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('reee.benefit_1_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('reee.benefit_1_desc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 hover-lift text-center border-top border-4 border-warning">
                    <div class="mb-3 text-warning"><i class="fas fa-gift fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('reee.benefit_2_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('reee.benefit_2_desc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 hover-lift text-center">
                    <div class="mb-3 text-info"><i class="fas fa-file-invoice-dollar fa-3x"></i></div>
                    <h5 class="fw-bold">{{ __('reee.benefit_3_title') }}</h5>
                    <p class="small text-muted mb-0">{{ __('reee.benefit_3_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 : LES SUBVENTIONS (TABLEAU) --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('reee.grants_title') }}</h3>
                <p>{{ __('reee.grants_intro') }}</p>

                <div class="alert alert-success border-0 shadow-sm d-flex align-items-start mt-4">
                    <i class="fas fa-lightbulb mt-1 me-3 fa-lg"></i>
                    <p class="small mb-0 fst-italic">{{ __('reee.grant_example') }}</p>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="py-3 ps-4">Subvention</th>
                                <th class="py-3">Taux / Montant</th>
                                <th class="py-3">Plafond / Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold ps-4 text-primary">{{ __('reee.grant_scee_name') }}</td>
                                <td>{{ __('reee.grant_scee_rate') }}</td>
                                <td>{{ __('reee.grant_scee_limit') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold ps-4 text-primary">{{ __('reee.grant_iqee_name') }}</td>
                                <td>{{ __('reee.grant_iqee_rate') }}</td>
                                <td>{{ __('reee.grant_iqee_limit') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold ps-4 text-success">{{ __('reee.grant_bec_name') }}</td>
                                <td>{{ __('reee.grant_bec_rate') }}</td>
                                <td>{{ __('reee.grant_bec_limit') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 : COMPARAISON (REEE vs CELI vs REER) --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold" style="color:var(--primary-color);">{{ __('reee.compare_title') }}</h3>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="table-responsive shadow-lg rounded">
            <table class="table table-hover mb-0 text-center align-middle bg-white">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th class="py-3 text-start ps-4">{{ __('reee.col_feature') }}</th>
                        <th class="py-3 bg-primary text-white" style="width: 28%;">{{ __('reee.col_reee') }}</th>
                        <th class="py-3" style="width: 25%;">{{ __('reee.col_celi') }}</th>
                        <th class="py-3" style="width: 25%;">{{ __('reee.col_reer') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start ps-4 fw-bold">{{ __('reee.row_obj') }}</td>
                        <td class="fw-bold text-primary bg-light">{{ __('reee.val_obj_reee') }}</td>
                        <td>{{ __('reee.val_obj_celi') }}</td>
                        <td>{{ __('reee.val_obj_reer') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('reee.row_deduct') }}</td>
                        <td class="fw-bold text-danger bg-light">{{ __('celiapp.val_no') }}</td>
                        <td class="text-danger">{{ __('celiapp.val_no') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_yes') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('reee.row_tax_withdrawal') }}</td>
                        <td class="fw-bold text-warning bg-light">{{ __('reee.val_tax_student') }}</td>
                        <td class="fw-bold text-success">{{ __('celiapp.val_no') }}</td>
                        <td class="text-danger">{{ __('reee.val_tax_contributor') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('reee.row_grants') }}</td>
                        <td class="fw-bold text-success bg-light">{{ __('reee.val_grants_yes') }}</td>
                        <td class="text-muted">{{ __('celiapp.val_no') }}</td>
                        <td class="text-muted">{{ __('celiapp.val_no') }}</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4">{{ __('reee.row_limit') }}</td>
                        <td class="fw-bold text-dark bg-light">{{ __('reee.val_limit_reee') }}</td>
                        <td>{{ __('reee.val_limit_celi') }}</td>
                        <td>{{ __('reee.val_limit_reer') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- SECTION 5 : FAQ & CTA --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <h3 class="fw-bold mb-4 text-primary">{{ __('reee.faq_title') }}</h3>
                <div class="accordion shadow-sm" id="faqAccordion">
                    @foreach(range(1, 4) as $i)
                    <div class="accordion-item mb-2 border-0 rounded overflow-hidden">
                        <h2 class="accordion-header" id="heading{{$i}}">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}">
                                {{ __('reee.faq_q' . $i) }}
                            </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white text-muted small">
                                {{ __('reee.faq_a' . $i) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-lg h-100 bg-dark text-white p-4 text-center">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="mb-4 text-warning"><i class="fas fa-graduation-cap fa-3x"></i></div>
                        <h3 class="fw-bold mb-3">{{ __('reee.cta_title') }}</h3>
                        <p class="mb-4 opacity-75">{{ __('reee.cta_text') }}</p>
                        <a href="{{ url('/rendez-vous') }}" class="btn btn-warning rounded-pill px-5 fw-bold text-dark hover-scale">
                            {{ __('reee.cta_btn') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 : ZONE CONSEILS --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('reee.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
            <p class="text-muted">{{ __('reee.blog_subtitle') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-book-reader fa-3x"></i></div>
                <p class="text-muted">{{ __('reee.blog_no_article') }}</p>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('reee.read_more') }}</a>
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
        transform: scale(1.05);
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