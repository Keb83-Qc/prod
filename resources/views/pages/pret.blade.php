@include('partials.header')

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">{{ __('pret.title') }}</h2>
                <div class="text-muted text-justify mb-4" style="line-height: 1.8;">
                    <p class="fs-5">{{ __('pret.intro_text') }}</p>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-4 shadow-sm text-white fw-bold">{{ __('pret.btn_contact') }}</a>
                    <a href="{{ url('/rendez-vous') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">{{ __('pret.btn_request') }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/A-droite-texte-Prets.jpg') }}" alt="Solutions de prêts" class="section-img rounded shadow hover-lift w-100">
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret.solutions_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @php
            $services = [
            ['t' => __('pret.sol_reer'), 'l' => '/pret/reer', 'i' => 'service-pret.png'],
            ['t' => __('pret.sol_reee'), 'l' => '/pret/reee', 'i' => 'epargne-reee.jpg'],
            ['t' => __('pret.sol_invest'), 'l' => '/pret/investissement', 'i' => 'service-pret.png'],
            ['t' => __('pret.sol_credit'), 'l' => '/carte-de-credit', 'i' => 'carte-neo.webp']
            ];
            @endphp
            @foreach($services as $item)
            <div class="col-md-6 col-lg-3">
                <a href="{{ url($item['l']) }}" class="service-grid-card small-card d-block position-relative rounded overflow-hidden shadow-sm hover-lift"
                    style="height: 250px; background-image: url('{{ asset('assets/img/'.$item['i']) }}'); background-size: cover; background-position: center;">
                    <div style="background: rgba(14, 16, 48, 0.6); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; transition: background 0.3s;">
                        <h3 class="text-white fw-bold m-0 text-uppercase text-center px-3" style="letter-spacing: 1px;">{{ $item['t'] }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:var(--primary-color);">{{ __('pret.blog_title') }}</h2>
            <div style="width: 60px; height: 3px; background: var(--secondary-color); margin: 15px auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @if(isset($conseils) && $conseils->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="mb-3 text-muted opacity-25"><i class="fas fa-book-reader fa-3x"></i></div>
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
                        <h5 class="card-title fw-bold mb-3">{{ $title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $desc }}</p>
                        <div class="mt-3">
                            <a href="{{ $link }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2">{{ __('pret.read_more') }}</a>
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

    .service-grid-card:hover div {
        background: rgba(201, 160, 80, 0.85) !important;
    }
</style>

@include('partials.footer')