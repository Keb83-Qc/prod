@include('partials.header')

{{-- SECTION 1 --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('assurance-commerciale.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('assurance-commerciale.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('assurance-commerciale.btn_quote') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('assurance-commerciale.btn_contact') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/AdobeStock_663298839.jpg') }}" alt="Assurance commerciale" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-warning"><i class="fas fa-shield-alt fa-3x"></i></div>
                    <h6 class="fw-bold text-dark">{{ __('assurance-commerciale.pillars.p1_title') }}</h6>
                    <p class="text-muted small mb-0">{{ __('assurance-commerciale.pillars.p1_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-warning"><i class="fas fa-handshake fa-3x"></i></div>
                    <h6 class="fw-bold text-dark">{{ __('assurance-commerciale.pillars.p2_title') }}</h6>
                    <p class="text-muted small mb-0">{{ __('assurance-commerciale.pillars.p2_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-warning"><i class="fas fa-file-contract fa-3x"></i></div>
                    <h6 class="fw-bold text-dark">{{ __('assurance-commerciale.pillars.p3_title') }}</h6>
                    <p class="text-muted small mb-0">{{ __('assurance-commerciale.pillars.p3_desc') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-warning"><i class="fas fa-users-cog fa-3x"></i></div>
                    <h6 class="fw-bold text-dark">{{ __('assurance-commerciale.pillars.p4_title') }}</h6>
                    <p class="text-muted small mb-0">{{ __('assurance-commerciale.pillars.p4_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 --}}
<section class="pt-5 pb-4 bg-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-0" style="color: var(--primary-color);">{{ __('assurance-commerciale.cost_title') }}</h2>
    </div>
</section>
<section class="py-5 d-flex align-items-center" style="background-image: url('{{ asset('assets/img/assurance-commerciale-cout.jpg') }}'); background-size: cover; background-position: center; min-height: 500px;">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-5 col-md-8">
                <div class="bg-white p-4 p-md-5 rounded shadow-lg text-center">
                    <p class="text-dark mb-0" style="line-height: 1.8;">{{ __('assurance-commerciale.cost_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 --}}
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-commerciale.types_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-md-5">
                <div class="d-flex align-items-start bg-white p-4 rounded shadow-sm h-100 hover-lift">
                    <img src="{{ asset('assets/img/risk-management_7392790.png') }}" width="70" class="me-4 flex-shrink-0" alt="Tous risques">
                    <div>
                        <h4 class="fw-bold text-dark mb-2">{{ __('assurance-commerciale.type_1_title') }}</h4>
                        <p class="text-muted mb-0">{{ __('assurance-commerciale.type_1_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="d-flex align-items-start bg-white p-4 rounded shadow-sm h-100 hover-lift">
                    <img src="{{ asset('assets/img/risk-assessment_14105612.png') }}" width="70" class="me-4 flex-shrink-0" alt="Risques désignés">
                    <div>
                        <h4 class="fw-bold text-dark mb-2">{{ __('assurance-commerciale.type_2_title') }}</h4>
                        <p class="text-muted mb-0">{{ __('assurance-commerciale.type_2_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-5 shadow-sm mt-3 text-white fw-bold">{{ __('assurance-commerciale.read_more') }}</a>
        </div>
    </div>
</section>

{{-- SECTION 5 --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance-commerciale.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-building fa-3x"></i></div>
                <p class="text-muted">Aucun article disponible.</p>
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
                        <h5 class="card-title fw-bold mb-3 text-dark">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('assurance-commerciale.read_more') }}</a>
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
</style>

@include('partials.footer')