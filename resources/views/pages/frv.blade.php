@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('frv.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('frv.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('frv.btn_convert') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('frv.btn_contact') }}</a>
                    <a href="https://wwwa.retraitequebec.gouv.qc.ca/Transactionnel/RR1I911_EstmrFRV/RR1SEstmrFRV.aspx" target="_blank" class="btn btn-secondary rounded-pill px-4 shadow-sm text-white">{{ __('frv.btn_calc') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/A-cote-texte-FRV.jpg') }}" alt="FRV Retraite" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('frv.challenges_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @php
            $challenges = [
            ['icon' => 'lending_2856892.png', 'key' => 'c1'],
            ['icon' => 'alert_14356955.png', 'key' => 'c2'],
            ['icon' => 'delete_11502976.png', 'key' => 'c3'],
            ['icon' => 'growth_2910299.png', 'key' => 'c4']
            ];
            @endphp
            @foreach($challenges as $c)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/' . $c['icon']) }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3">{{ __('frv.challenges.' . $c['key'] . '_title') }}</h5>
                    <p class="text-muted small">{{ __('frv.challenges.' . $c['key'] . '_desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @php
            $features = [
            ['icon' => 'business_13389610.png', 'key' => 'f1'],
            ['icon' => 'friendship_7959236.png', 'key' => 'f2'],
            ['icon' => 'limited-time_9449615.png', 'key' => 'f3']
            ];
            @endphp
            @foreach($features as $f)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/' . $f['icon']) }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3">{{ __('frv.features.' . $f['key'] . '_title') }}</h5>
                    <p class="text-muted small">{{ __('frv.features.' . $f['key'] . '_desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5 text-center px-lg-5">
            <p class="text-muted fst-italic fs-5">"{{ __('frv.disclaimer') }}"</p>
            <a href="{{ url('/contact') }}" class="btn btn-outline-primary rounded-pill px-4 mt-3">{{ __('frv.cta_contact') }}</a>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="d-flex align-items-start p-4 bg-white rounded shadow-sm">
                    <div class="flex-shrink-0 me-4"><i class="fas fa-info-circle fa-3x text-warning"></i></div>
                    <div>
                        <p class="text-dark fs-5 mb-3">{{ __('frv.info_text') }}</p>
                        <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-4 text-white">{{ __('frv.cta_contact') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('frv.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-chart-line fa-3x"></i></div>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('frv.read_more') }}</a>
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