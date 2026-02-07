@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="mb-4 fw-bold" style="color: var(--primary-color);">{{ __('assurance.intro_title') }}</h2>
                <div class="text-muted text-justify" style="line-height: 1.8;">
                    {{-- On utilise {!! !!} pour interpréter le HTML et nl2br() pour les sauts de ligne --}}
                    <p>{!! nl2br(e(__('assurance.intro_text'))) !!}</p>
                </div>
                <a href="{{ url('/contact') }}" class="btn btn-outline-dark mt-3 rounded-pill px-4">{{ __('assurance.btn_advisor') }}</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/Assurances-.jpg') }}" alt="Assurance VIP GPI" class="section-img">
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--primary-color);">{{ __('assurance.products_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4">
            @php
            $services = [
            ['titre' => __('assurance.services.vie'), 'link' => 'assurance-vie', 'image' => 'Onglet-Assurance-vie-.jpg'],
            ['titre' => __('assurance.services.maladie'), 'link' => 'assurance-maladie-grave', 'image' => 'Onglet-assurance-Maladies-Graves.jpg'],
            ['titre' => __('assurance.services.invalidite'), 'link' => 'assurance-invalidite', 'image' => 'oglet-Assurance-invalidite.jpg'],
            ['titre' => __('assurance.services.complementaire'), 'link' => 'assurance-complementaire-dentaire', 'image' => 'Onglet-assurance-dentaire.jpg'],
            ['titre' => __('assurance.services.dommage'), 'link' => 'assurance-dommage-2', 'image' => 'Assurance-dommage.png'],
            ['titre' => __('assurance.services.voyage'), 'link' => 'assurance-voyage', 'image' => 'Onglet-assurance-voyage-.jpg'],
            ['titre' => __('assurance.services.hypotheque'), 'link' => 'assurance-vie-hypothecaire', 'image' => 'Onglet-assurance-vie-hypothecaire-scaled.jpg'],
            ];
            @endphp

            @foreach ($services as $svc)
            <div class="col-md-4 col-sm-6">
                <a href="{{ url('/' . $svc['link']) }}" class="service-grid-card"
                    style="background-image: url('{{ asset('assets/img/' . $svc['image']) }}');">
                    <div class="service-grid-content">
                        <h3>{{ $svc['titre'] }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('assurance.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted">{{ __('assurance.blog_no_article') }}</p>
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
                        <h5 class="card-title fw-bold mb-3">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2">{{ __('assurance.read_more') }}</a>
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
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }
</style>

@include('partials.footer')