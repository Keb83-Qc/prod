@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('pret-hypothecaire.title') }}</h2>
                <div style="width: 60px; height: 3px; background: var(--secondary-color); margin-bottom: 20px;"></div>
                <div class="text-dark text-justify mb-4" style="line-height: 1.8;">
                    <p>{{ __('pret-hypothecaire.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('pret-hypothecaire.btn_rate') }}</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('pret-hypothecaire.btn_contact') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/quest-ce-quun-pret-hypothecaire.jpg') }}" alt="Prêt hypothécaire" class="section-img rounded shadow hover-lift w-100 object-fit-cover">
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-hypothecaire.aspects_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @php
            $aspects = [
            ['icon' => 'loan_1999308.png', 'key' => 'a1'],
            ['icon' => 'tax_10165334.png', 'key' => 'a2'],
            ['icon' => 'budget_11732641.png', 'key' => 'a3'],
            ['icon' => 'loan_3529249.png', 'key' => 'a4'],
            ['icon' => 'electricity-bill_8564295.png', 'key' => 'a5'],
            ['icon' => 'loan_1936178.png', 'key' => 'a6']
            ];
            @endphp
            @foreach($aspects as $a)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3"><img src="{{ asset('assets/img/' . $a['icon']) }}" width="64" alt="Icone"></div>
                    <h5 class="fw-bold mb-3 text-dark">{{ __('pret-hypothecaire.aspects.' . $a['key'] . '_title') }}</h5>
                    <p class="text-muted small mb-0">{{ __('pret-hypothecaire.aspects.' . $a['key'] . '_desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                <img src="{{ asset('assets/img/AdobeStock_536174812.png') }}" alt="Calcul prêt" class="img-fluid" style="max-height: 400px;">
            </div>
            <div class="col-lg-7">
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 me-3"><i class="fas fa-info-circle fa-2x text-warning"></i></div>
                    <div>
                        <p class="text-muted mb-0">{{ __('pret-hypothecaire.info_text_1') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3"><i class="fas fa-user-shield fa-2x text-warning"></i></div>
                    <div>
                        <p class="text-muted mb-0">
                            {{ __('pret-hypothecaire.info_text_2') }}
                            <br><small class="text-muted fst-italic">{{ __('pret-hypothecaire.disclaimer') }}</small>
                        </p>
                    </div>
                </div>
                <div class="mt-4 text-center text-lg-start">
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('pret-hypothecaire.cta_btn') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret-hypothecaire.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-home fa-3x"></i></div>
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
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2 text-white">{{ __('pret-hypothecaire.read_more') }}</a>
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